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

class AdminBiolinksTemplates extends Controller {

    public function index() {

        /* Prepare the filtering system */
        $filters = (new \Altum\Filters(['is_enabled'], ['name'], ['datetime', 'last_datetime', 'name', 'order', 'total_usage']));
        $filters->set_default_order_by('biolink_template_id', settings()->main->default_order_type);
        $filters->set_default_results_per_page(settings()->main->default_results_per_page);

        /* Prepare the paginator */
        $total_rows = database()->query("SELECT COUNT(*) AS `total` FROM `biolinks_templates` WHERE 1 = 1 {$filters->get_sql_where()}")->fetch_object()->total ?? 0;
        $paginator = (new \Altum\Paginator($total_rows, $filters->get_results_per_page(), $_GET['page'] ?? 1, url('admin/biolinks-templates?' . $filters->get_get() . '&page=%d')));

        /* Get the data */
        $biolinks_templates = [];
        $biolinks_templates_result = database()->query("
            SELECT
                `biolinks_templates`.*
            FROM
                `biolinks_templates`
            WHERE
                1 = 1
                {$filters->get_sql_where()}
                {$filters->get_sql_order_by()}

            {$paginator->get_sql_limit()}
        ");
        while($row = $biolinks_templates_result->fetch_object()) {
            $biolinks_templates[] = $row;
        }

        /* Export handler */
        process_export_csv($biolinks_templates, 'include', ['biolink_template_id', 'name', 'is_enabled', 'total_usage', 'last_datetime', 'datetime'], sprintf(l('admin_biolinks_templates.title')));
        process_export_json($biolinks_templates, 'include', ['biolink_template_id', 'name', 'settings', 'is_enabled', 'total_usage', 'last_datetime', 'datetime'], sprintf(l('admin_biolinks_templates.title')));

        /* Prepare the pagination view */
        $pagination = (new \Altum\View('partials/admin_pagination', (array) $this))->run(['paginator' => $paginator]);

        /* Main View */
        $data = [
            'biolinks_templates' => $biolinks_templates,
            'filters' => $filters,
            'pagination' => $pagination
        ];

        $view = new \Altum\View('admin/biolinks-templates/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

    public function bulk() {

        //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        /* Check for any errors */
        if(empty($_POST)) {
            redirect('admin/biolinks-templates');
        }

        if(empty($_POST['selected'])) {
            redirect('admin/biolinks-templates');
        }

        if(!isset($_POST['type']) || (isset($_POST['type']) && !in_array($_POST['type'], ['delete']))) {
            redirect('admin/biolinks-templates');
        }

        if(!\Altum\Csrf::check()) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            switch($_POST['type']) {
                case 'delete':

                    foreach($_POST['selected'] as $biolink_template_id) {
                        $biolink_template = db()->where('biolink_template_id', $biolink_template_id)->getOne('biolinks_templates');

                        if(!$biolink_template) {
                            continue;
                        }

                        \Altum\Uploads::delete_uploaded_file($biolink_template->image, 'biolinks_templates');

                        /* Delete the project */
                        db()->where('biolink_template_id', $biolink_template_id)->delete('biolinks_templates');
                    }

                    /* Clear the cache */
                    \Altum\Cache::$adapter->deleteItem('biolinks_templates');

                    break;
            }

            /* Set a nice success message */
            Alerts::add_success(l('admin_bulk_delete_modal.success_message'));

        }

        redirect('admin/biolinks-templates');
    }

    public function delete() {

        $biolink_template_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

        if(!\Altum\Csrf::check('global_token')) {
            Alerts::add_error(l('global.error_message.invalid_csrf_token'));
        }

        if(!$biolink_template = db()->where('biolink_template_id', $biolink_template_id)->getOne('biolinks_templates')) {
            redirect('admin/biolinks-templates');
        }

        $biolink_template->settings = json_decode($biolink_template->settings);

        if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

            /* Offload deleting */
            if(\Altum\Plugin::is_active('offload') && settings()->offload->uploads_url) {
                $s3 = new \Aws\S3\S3Client(get_aws_s3_config());

                if(!empty($biolink_template->image)) {
                    $s3->deleteObject([
                        'Bucket' => settings()->offload->storage_name,
                        'Key' => 'uploads/biolinks_templates/' . $biolink_template->image,
                    ]);
                }

                if(!empty($biolink_template->settings->biolink->background) && file_exists(UPLOADS_PATH . 'backgrounds' . '/' . $biolink_template->settings->biolink->background)) {
                    $s3->deleteObject([
                        'Bucket' => settings()->offload->storage_name,
                        'Key' => 'uploads/backgrounds/' . $biolink_template->settings->biolink->background,
                    ]);
                }
            }

            /* Local deleting */
            else {
                if(!empty($biolink_template->image) && file_exists(UPLOADS_PATH . 'biolinks_templates/' . $biolink_template->image)) {
                    unlink(UPLOADS_PATH . 'biolinks_templates/' . $biolink_template->image);
                }
                if(!empty($biolink_template->settings->biolink->background) && file_exists(UPLOADS_PATH . 'backgrounds/' . $biolink_template->settings->biolink->background)) {
                    unlink(UPLOADS_PATH . 'backgrounds/' . $biolink_template->settings->biolink->background);
                }
            }

            /* Delete the project */
            db()->where('biolink_template_id', $biolink_template->biolink_template_id)->delete('biolinks_templates');

            /* Clear the cache */
            \Altum\Cache::$adapter->deleteItem('biolinks_templates');

            /* Set a nice success message */
            Alerts::add_success(sprintf(l('global.success_message.delete1'), '<strong>' . $biolink_template->name . '</strong>'));

        }

        redirect('admin/biolinks-templates');
    }

}
