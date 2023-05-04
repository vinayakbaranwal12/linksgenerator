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
use Altum\Response;
use Altum\Uploads;

class ChatCreate extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->chats_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('create.chats')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('chats');
        }

        /* Check for the plan limit */
        $chats_current_month = db()->where('user_id', $this->user->user_id)->getValue('users', '`aix_chats_current_month`');
        if($this->user->plan_settings->chats_per_month_limit != -1 && $chats_current_month >= $this->user->plan_settings->chats_per_month_limit) {
            Alerts::add_info(l('global.info_message.plan_feature_limit'));
            redirect('chats');
        }

        $values = [
            'name' => $_GET['name'] ?? $_POST['name'] ?? '',
        ];

        /* Prepare the View */
        $data = [
            'values' => $values,
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/chat-create/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));

    }

    public function create_ajax() {
        //CODE:DEMO if(DEMO) if($this->user->user_id == 1) Response::json('Please create an account on the demo to test out this function.', 'error');

        if(empty($_POST)) {
            redirect();
        }

        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->chats_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('create.chats')) {
            Response::json(l('global.info_message.team_no_access'), 'error');
        }

        /* Check for the plan limit */
        $chats_current_month = db()->where('user_id', $this->user->user_id)->getValue('users', '`aix_chats_current_month`');
        if($this->user->plan_settings->chats_per_month_limit != -1 && $chats_current_month >= $this->user->plan_settings->chats_per_month_limit) {
            Response::json(l('global.info_message.plan_feature_limit'), 'error');
        }

        $_POST['name'] = input_clean($_POST['name'], 64);

        /* Check for any errors */
        $required_fields = ['name'];
        foreach($required_fields as $field) {
            if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                Response::json(l('global.error_message.empty_fields'), 'error');
            }
        }

        if(!\Altum\Csrf::check('global_token')) {
            Response::json(l('global.error_message.invalid_csrf_token'), 'error');
        }

        $settings = json_encode([
        ]);

        /* Prepare a custom name if needed */
        $name = $_POST['name'];

        /* Prepare the statement and execute query */
        $chat_id = db()->insert('chats', [
            'user_id' => $this->user->user_id,
            'name' => $name,
            'settings' => $settings,
            'datetime' => \Altum\Date::$date,
        ]);

        /* Prepare the statement and execute query */
        db()->where('user_id', $this->user->user_id)->update('users', [
            'aix_chats_current_month' => db()->inc()
        ]);

        /* Set a nice success message */
        Response::json(sprintf(l('global.success_message.create1'), '<strong>' . $_POST['name'] . '</strong>'), 'success', ['url' => url('chat/' . $chat_id)]);

    }

}
