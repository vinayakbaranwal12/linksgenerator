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
use Altum\Logger;

class AdminBroadcastCreate extends Controller {

    public function index() {

        /* Get segments data */
        $segment_all = db()->getValue('users', 'COUNT(*)');
        $segment_subscribers = db()->where('is_newsletter_subscribed', 1)->getValue('users', 'COUNT(*)');

        if(!empty($_POST)) {
            /* Filter some the variables */
            $_POST['name'] = input_clean($_POST['name'], 64);
            $_POST['subject'] = input_clean($_POST['subject'], 128);
            $_POST['segment'] = in_array($_POST['segment'], ['all', 'subscribers', 'custom']) ? input_clean($_POST['segment']) : 'subscribers';

            $_POST['users_ids'] = trim($_POST['users_ids'] ?? '');
            if($_POST['users_ids']) {
                $_POST['users_ids'] = explode(',', $_POST['users_ids'] ?? '');
                if (count($_POST['users_ids'])) {
                    $_POST['users_ids'] = array_map(function ($user_id) {
                        return (int) $user_id;
                    }, $_POST['users_ids']);
                    $_POST['users_ids'] = array_unique($_POST['users_ids']);
                }
            }

            //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

            if(!\Altum\Csrf::check()) {
                Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            }

            /* Preview email */
            if(isset($_POST['preview'])) {
                $_POST['preview_email'] = mb_substr(filter_var($_POST['preview_email'], FILTER_SANITIZE_EMAIL), 0, 320);

                $required_fields = ['subject', 'content', 'preview_email'];
                foreach($required_fields as $field) {
                    if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                        Alerts::add_field_error($field, l('global.error_message.empty_field'));
                    }
                }

                if(filter_var($_POST['preview_email'], FILTER_VALIDATE_EMAIL) == false) {
                    Alerts::add_field_error('preview_email', l('global.error_message.invalid_email'));
                }
            }

            /* Save draft or send */
            else {
                $required_fields = ['name', 'subject', 'content'];
                foreach($required_fields as $field) {
                    if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                        Alerts::add_field_error($field, l('global.error_message.empty_field'));
                    }
                }
            }

            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                /* Preview email */
                if(isset($_POST['preview'])) {
                    $email_template = get_email_template(
                        [
                            '{{NAME}}' => $this->user->name,
                            '{{EMAIL}}' => $this->user->email,
                        ],
                        $_POST['subject'],
                        [
                            '{{NAME}}' => $this->user->name,
                            '{{EMAIL}}' => $this->user->email,
                        ],
                        $_POST['content']
                    );

                    send_mail($_POST['preview_email'], $email_template->subject, $email_template->body, ['is_broadcast' => true], $_POST['preview_email']);

                    /* Set a nice success message */
                    Alerts::add_success(sprintf(l('admin_broadcast_create.success_message.preview'), '<strong>' . $_POST['preview_email'] . '</strong>'));
                }

                if(isset($_POST['save']) || isset($_POST['send'])) {

                    /* Get all the users needed */
                    switch($_POST['segment']) {
                        case 'all':
                            $users = db()->get('users', null, ['user_id', 'email', 'name']);
                        break;

                        case 'subscribers':
                            $users = db()->where('is_newsletter_subscribed', 1)->get('users', null, ['user_id', 'email', 'name']);
                        break;

                        case 'custom':
                            $users = db()->where('user_id', $_POST['users_ids'], 'IN')->get('users', null, ['user_id', 'email', 'name']);
                            break;
                    }

                    $users_ids = [];
                    foreach($users as $user) {
                        $users_ids[] = $user->user_id;
                    }

                    /* Database query */
                    $broadcast_id = db()->insert('broadcasts', [
                        'name' => $_POST['name'],
                        'subject' => $_POST['subject'],
                        'content' => $_POST['content'],
                        'segment' => $_POST['segment'],
                        'users_ids' => json_encode($users_ids),
                        'sent_users_ids' => '[]',
                        'total_emails' => count($users_ids),
                        'status' => isset($_POST['save']) ? 'draft' : 'processing',
                        'datetime' => \Altum\Date::$date,
                    ]);

                    if(isset($_POST['save'])) {
                        /* Set a nice success message */
                        Alerts::add_success(sprintf(l('admin_broadcast_create.success_message.save'), '<strong>' . $_POST['name'] . '</strong>'));
                    } else {
                        /* Set a nice success message */
                        Alerts::add_success(sprintf(l('admin_broadcast_create.success_message.send'), '<strong>' . $_POST['name'] . '</strong>'));
                    }

                    redirect('admin/broadcasts');
                }

            }
        }

        $values = [
            'name' => $_POST['name'] ?? null,
            'subject' => $_POST['subject'] ?? null,
            'segment' => $_POST['segment'] ?? 'all',
            'users_ids' => $_POST['users_ids'] ?? null,
            'content' => $_POST['content'] ?? null,
            'preview_email' => $_POST['preview_email'] ?? $this->user->email,
        ];

        /* Main View */
        $data = [
            'values' => $values,
            'segment_all' => $segment_all,
            'segment_subscribers' => $segment_subscribers,
        ];

        $view = new \Altum\View('admin/broadcast-create/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
