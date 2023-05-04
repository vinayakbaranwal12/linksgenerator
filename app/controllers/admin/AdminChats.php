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

class AdminChats extends Controller {

    public function index() {

        if(!\Altum\Plugin::is_active('aix')) {
            redirect('dashboard');
        }

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['user_id'], ['name'], ['last_datetime', 'datetime', 'name', 'total_comments', 'used_tokens']));
        $filters->set_default_order_by('chat_id', settings()->main->default_order_type);
        $filters->set_default_results_per_page(settings()->main->default_results_per_page);

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `chats` WHERE 1 = 1 {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('admin/chats?' . $filters->get_get() . '&page=%d')));

        /* Get the data */
        $chats = [];
        $chats_result = database()->query("
            SELECT
                `chats`.*, `users`.`name` AS `user_name`, `users`.`email` AS `user_email`
            FROM
                `chats`
            LEFT JOIN
                `users` ON `chats`.`user_id` = `users`.`user_id`
            WHERE
                1 = 1
                {$filters->get_sql_where('chats')}
                {$filters->get_sql_order_by('chats')}

            {$paginator->get_sql_limit()}
        ");
        while($row = $chats_result->fetch_object()) {
            $row->settings = json_decode($row->settings);
            $chats[] = $row;
        }

        /* Export handler */
        process_export_csv($chats, 'include', ['chat_id', 'user_id', 'name', 'total_messages', 'used_tokens', 'datetime', 'last_datetime'], sprintf(l('chats.title')));
        process_export_json($chats, 'include', ['chat_id', 'user_id', 'name', 'total_messages', 'used_tokens', 'settings', 'datetime', 'last_datetime'], sprintf(l('chats.title')));

        /* Prepare the pagination view */
        $pagination = (new \Altum\View('partials/admin_pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Main View */
        $data = [
            'chats' => $chats,
            'filters' => $filters,
            'pagination' => $pagination,
        ];

        $view = new \Altum\View('admin/chats/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function bulk() {

        /* Check for any errors */
        if(empty($_POST)) {
            redirect('admin/chats');
        }

        if(empty($_POST['selected'])) {
            redirect('admin/chats');
        }

        if(!isset($_POST['type']) || (isset($_POST['type']) && !in_array($_POST['type'], ['delete']))) {
            redirect('admin/chats');
        }

        //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            switch($_POST['type']) {
                case 'delete':

                    foreach($_POST['selected'] as $chat_id) {

                        $chat = db()->where('chat_id', $chat_id)->getOne('chats', ['user_id']);

                        /* Delete the resource */
                        db()->where('chat_id', $chat->chat_id)->delete('chats');

                    }

                    break;
            }

            /* Set a nice success message */
            Alerts::add_success(l('admin_bulk_delete_modal.success_message'));

        }

        redirect('admin/chats');
    }

    public function delete() {

        $chat_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check('global_token')) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$chat = db()->where('chat_id', $chat_id)->getOne('chats', ['chat_id', 'user_id', 'name'])) {
            redirect('admin/chats');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Delete the resource */
            db()->where('chat_id', $chat->chat_id)->delete('chats');

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $chat->name . '</strong>'));

        }

        redirect('admin/chats');
    }

}
