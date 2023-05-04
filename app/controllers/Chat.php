<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Controllers;

use Altum\Alerts;
use Altum\Date;
use Altum\Response;
use Altum\Title;

class Chat extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->chats_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('update.chats')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('dashboard');
        }

        $chat_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        /* Get chat details */
        if(!$chat = db()->where('chat_id', $chat_id)->where('user_id', $this->user->user_id)->getOne('chats')) {
            redirect();
        }

        $chat->settings = json_decode($chat->settings ?? '');

        $chat_messages = db()->where('chat_id', $chat->chat_id)->get('chats_messages');

        /* Set a custom title */
        Title::set(sprintf(l('chat.title'), $chat->name));

        /* Main View */
        $data = [
            'chat' => $chat,
            'chat_messages' => $chat_messages,
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/chat/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));
    }

    public function create_ajax() {
        //CODE:DEMO if(DEMO) if($this->user->user_id == 1) Response::json('Please create an account on the demo to test out this function.', 'error');

        if(empty($_POST)) {
            redirect();
        }

        set_time_limit(0);

        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->chats_is_enabled) {
            redirect('dashboard');
        }

        $_POST['chat_id'] = (int) $_POST['chat_id'];

        /* Get chat details */
        if(!$chat = db()->where('chat_id', $_POST['chat_id'])->where('user_id', $this->user->user_id)->getOne('chats')) {
            redirect();
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('create.chats')) {
            Response::json(l('global.info_message.team_no_access'), 'error');
        }

        $this->user->plan_settings->chats_model = $this->user->plan_settings->chats_model ?? 'gpt-3.5-turbo';

        /* */
        $_POST['content'] = input_clean($_POST['content'], 1024);

        /* Check for any errors */
        $required_fields = ['content'];
        foreach($required_fields as $field) {
            if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                Response::json(l('global.error_message.empty_fields'), 'error');
            }
        }

        if(!\Altum\Csrf::check('global_token')) {
            Response::json(l('global.error_message.invalid_csrf_token'), 'error');
        }

        /* Check for timeouts */
        if(settings()->aix->input_moderation_is_enabled) {
            $cache_instance = \Altum\Cache::$adapter->getItem('user?flagged=' . $this->user->user_id);
            if (!is_null($cache_instance->get())) {
                Response::json(l('chats.error_message.timed_out'), 'error');
            }
        }

        /* Get all the existing chat messages */
        $chat_messages = db()->where('chat_id', $chat->chat_id)->get('chats_messages');

        /* Check for the plan limit */
        $sent_chat_messages = 0;
        foreach($chat_messages as $chat_message) {
            if($chat_message->role == 'user') $sent_chat_messages++;
        }

        if($this->user->plan_settings->chat_messages_per_chat_limit != -1 && $sent_chat_messages >= $this->user->plan_settings->chat_messages_per_chat_limit) {
            Response::json(l('global.info_message.plan_feature_limit'), 'error');
        }

        /* Check for moderation */
        if(settings()->aix->input_moderation_is_enabled) {
            try {
                $response = \Unirest\Request::post(
                    'https://api.openai.com/v1/moderations',
                    [
                        'Authorization' => 'Bearer ' . settings()->aix->openai_api_key,
                        'Content-Type' => 'application/json',
                    ],
                    \Unirest\Request\Body::json([
                        'input' => $_POST['content'],
                    ])
                );

                if($response->code >= 400) {
                    Response::json($response->body->error->message, 'error');
                }

                if($response->body->results[0]->flagged ?? null) {
                    /* Time out the user for a few minutes */
                    \Altum\Cache::$adapter->save(
                        $cache_instance->set('true')->expiresAfter(3 * 60)->addTag('users')->addTag('user_id=' . $this->user->user_id)
                    );

                    /* Return the error */
                    Response::json(l('chats.error_message.flagged'), 'error');
                }

            } catch (\Exception $exception) {
                Response::json($exception->getMessage(), 'error');
            }
        }


        /* Prepare the main API request */
        $api_endpoint_url = 'https://api.openai.com/v1/chat/completions';

        /* Build the messages array */
        $messages = [];

        foreach($chat_messages as $chat_message) {
            $messages[] = [
                'role' => $chat_message->role,
                'content' => $chat_message->content,
            ];
        }

        $messages[] = [
            'role' => 'user',
            'content' => $_POST['content'],
        ];

        $body = [
            'model' => $this->user->plan_settings->chats_model,
            'messages' => $messages,
            'user' => 'user_id:' . $this->user->user_id,
        ];

        try {
            $response = \Unirest\Request::post(
                $api_endpoint_url,
                [
                    'Authorization' => 'Bearer ' . settings()->aix->openai_api_key,
                    'Content-Type' => 'application/json',
                ],
                \Unirest\Request\Body::json($body)
            );

            if($response->code >= 400) {
                Response::json($response->body->error->message, 'error');
            }

        } catch (\Exception $exception) {
            Response::json($exception->getMessage(), 'error');
        }

        /* Get info after the request */
        $info = \Unirest\Request::getInfo();

        /* Some needed variables */
        $api_response_time = $info['total_time'] * 1000;

        $content = trim($response->body->choices[0]->message->content);
        $role = trim($response->body->choices[0]->message->role);

        /* Prepare the statement and execute query */
        db()->insert('chats_messages', [
            'user_id' => $this->user->user_id,
            'chat_id' => $chat->chat_id,
            'role' => 'user',
            'content' => $_POST['content'],
            'model' => $response->body->model,
            'api_response_time' => 0,
            'datetime' => \Altum\Date::$date,
        ]);

        /* Prepare the statement and execute query */
        db()->insert('chats_messages', [
            'user_id' => $this->user->user_id,
            'chat_id' => $chat->chat_id,
            'role' => $role,
            'content' => $content,
            'model' => $response->body->model,
            'api_response_time' => $api_response_time,
            'datetime' => \Altum\Date::$date,
        ]);

        /* Prepare the statement and execute query */
        db()->where('chat_id', $chat->chat_id)->update('chats', [
            'total_messages' => db()->inc(2),
            'used_tokens' => db()->inc($response->body->usage->total_tokens)
        ]);

        /* Set a nice success message */
        Response::json(l('global.success_message.create2'), 'success', ['role' => $role, 'content' => $content]);

    }

}
