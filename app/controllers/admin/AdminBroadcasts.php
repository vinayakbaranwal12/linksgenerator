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

class AdminBroadcasts extends Controller {

    public function index() {

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['status', 'segment'], ['name', 'content'], ['name', 'datetime', 'total_emails', 'sent_emails']));
        $filters->set_default_order_by('broadcast_id', settings()->main->default_order_type);
        $filters->set_default_results_per_page(settings()->main->default_results_per_page);

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `broadcasts` WHERE 1 = 1 {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('admin/broadcasts?' . $filters->get_get() . '&page=%d')));

        /* Get the data */
        $broadcasts = [];
        $broadcasts_result = database()->query("
            SELECT
                *
            FROM
                `broadcasts`
            WHERE
                1 = 1
                {$filters->get_sql_where()}
                {$filters->get_sql_order_by()}
                  
            {$paginator->get_sql_limit()}
        ");
        while($row = $broadcasts_result->fetch_object()) {
            $row->content_text = input_clean($row->content);
            $broadcasts[] = $row;
        }

        /* Export handler */
        process_export_json($broadcasts, 'include', ['broadcast_id', 'name', 'subject', 'content', 'content_text', 'segment', 'users_ids', 'sent_emails', 'total_emails', 'status', 'last_sent_email_datetime', 'datetime', 'last_datetime']);
        process_export_csv($broadcasts, 'include', ['broadcast_id', 'name', 'subject', 'content_text', 'segment', 'users_ids', 'sent_emails', 'total_emails', 'status', 'last_sent_email_datetime', 'datetime', 'last_datetime']);

        /* Prepare the pagination view */
        $pagination = (new \Altum\View('partials/admin_pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Main View */
        $data = [
            'broadcasts' => $broadcasts,
            'paginator' => $paginator,
            'pagination' => $pagination,
            'filters' => $filters
        ];

        $view = new \Altum\View('admin/broadcasts/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function bulk() {

        /* Check for any errors */
        if(empty($_POST)) {
            redirect('admin/broadcasts');
        }

        if(empty($_POST['selected'])) {
            redirect('admin/broadcasts');
        }

        if(!isset($_POST['type']) || (isset($_POST['type']) && !in_array($_POST['type'], ['delete']))) {
            redirect('admin/broadcasts');
        }

        //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            switch($_POST['type']) {
                case 'delete':

                    foreach($_POST['selected'] as $id) {
                        db()->where('broadcast_id', $id)->delete('broadcasts');
                    }
                    break;
            }

            /* Set a nice success message */
            Alerts::add_success(l('admin_bulk_delete_modal.success_message'));

        }

        redirect('admin/broadcasts');
    }

    public function delete() {

        $broadcast_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check('global_token')) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$broadcast = db()->where('broadcast_id', $broadcast_id)->getOne('broadcasts', ['broadcast_id'])) {
            redirect('admin/broadcasts');
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Delete the broadcast */
            db()->where('broadcast_id', $broadcast_id)->delete('broadcasts');

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $broadcast->broadcast . '</strong>'));

        }

        redirect('admin/broadcasts');
    }

}
