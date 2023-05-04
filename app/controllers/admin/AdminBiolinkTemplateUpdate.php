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
use Altum\Uploads;

class AdminBiolinkTemplateUpdate extends Controller {

    public function index() {

        $biolink_template_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        if(!$biolink_template = db()->where('biolink_template_id', $biolink_template_id)->getOne('biolinks_templates')) {
            redirect('admin/biolinks-templates');
        }
        $biolink_template->settings = json_decode($biolink_template->settings);


        if(!empty($_POST)) {
            /* Filter some the variables */
            $_POST['link_id'] = (int) $_POST['link_id'];
            $_POST['name'] = input_clean($_POST['name']);
            $_POST['url'] = input_clean($_POST['url']);
            $_POST['order'] = (int) $_POST['order'] ?? 0;
            $_POST['is_enabled'] = (int) isset($_POST['is_enabled']);

            //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

            if(!\Altum\Csrf::check()) {
                Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            }

            /* Check for errors & process  potential uploads */
            $biolink_template->image = \Altum\Uploads::process_upload($biolink_template->image, 'biolinks_templates', 'image', 'image_remove', null);

            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                $settings = json_encode([]);

                /* Database query */
                db()->where('biolink_template_id', $biolink_template_id)->update('biolinks_templates', [
                    'link_id' => $_POST['link_id'],
                    'name' => $_POST['name'],
                    'url' => $_POST['url'],
                    'image' => $biolink_template->image,
                    'settings' => $settings,
                    'is_enabled' => $_POST['is_enabled'],
                    'order' => $_POST['order'],
                    'last_datetime' => \Altum\Date::$date,
                ]);

                /* Set a nice success message */
                Alerts::add_success(sprintf(l('global.success_message.update1'), '<strong>' . $_POST['name'] . '</strong>'));

                /* Clear the cache */
                \Altum\Cache::$adapter->deleteItem('biolinks_templates');

                /* Refresh the page */
                redirect('admin/biolink-template-update/' . $biolink_template_id);

            }

        }

        /* Main View */
        $data = [
            'biolink_template' => $biolink_template,
        ];

        $view = new \Altum\View('admin/biolink-template-update/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
