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
use Altum\Title;

class DocumentUpdate extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->documents_is_enabled) {
            redirect('dashboard');
        }

        /* Team checks */
        if(\Altum\Teams::is_delegated() && !\Altum\Teams::has_access('update.documents')) {
            Alerts::add_info(l('global.info_message.team_no_access'));
            redirect('dashboard');
        }

        $document_id = isset($this->params[0]) ? (int) $this->params[0] : null;

        /* Get document details */
        if(!$document = db()->where('document_id', $document_id)->where('user_id', $this->user->user_id)->getOne('documents')) {
            redirect();
        }

        $document->settings = json_decode($document->settings ?? '');
        $document->input = json_decode($document->input ?? '');

        /* Get available projects */
        $projects = (new \Altum\Models\Projects())->get_projects_by_user_id($this->user->user_id);

        /* Get available templates categories */
        $templates_categories = (new \Altum\Models\TemplatesCategories())->get_templates_categories();

        /* Templates */
        $templates = (new \Altum\Models\Templates())->get_templates();

        if(!empty($_POST)) {
            $purifier = new \HTMLPurifier(\HTMLPurifier_Config::createDefault());
            $_POST['content'] = $purifier->purify($_POST['content']);
            $_POST['name'] = input_clean($_POST['name'], 64);
            $_POST['project_id'] = !empty($_POST['project_id']) && array_key_exists($_POST['project_id'], $projects) ? (int) $_POST['project_id'] : null;

            //CODE:DEMO if(DEMO) if($this->user->user_id == 1) Alerts::add_error('Please create an account on the demo to test out this function.');

            /* Check for any errors */
            $required_fields = ['name', 'content'];
            foreach($required_fields as $field) {
                if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                    Alerts::add_field_error($field, l('global.error_message.empty_field'));
                }
            }

            if(!\Altum\Csrf::check()) {
                Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            }

            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                /* Database query */
                db()->where('document_id', $document->document_id)->update('documents', [
                    'project_id' => $_POST['project_id'],
                    'name' => $_POST['name'],
                    'content' => $_POST['content'],
                    'last_datetime' => \Altum\Date::$date,
                ]);

                /* Set a nice success message */
                Alerts::add_success(sprintf(l('global.success_message.update1'), '<strong>' . $_POST['name'] . '</strong>'));

                redirect('document-update/' . $document->document_id);
            }
        }

        /* Set a custom title */
        Title::set(sprintf(l('document_update.title'), $document->name));

        /* Main View */
        $data = [
            'document' => $document,
            'projects' => $projects ?? [],
            'templates' => $templates,
            'templates_categories' => $templates_categories,
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/document-update/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));
    }

}
