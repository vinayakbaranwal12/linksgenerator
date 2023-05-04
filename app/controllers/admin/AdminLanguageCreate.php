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
use Altum\Language;

class AdminLanguageCreate extends Controller {

    public function index() {

        /* Make sure to load up in memory the main language */
        Language::get(Language::$main_name);

        /* Default variables */
        $values = [];

        if(!empty($_POST)) {
            /* Clean some posted variables */
            $_POST['language_name'] = input_clean($_POST['language_name']);
            $_POST['language_code'] = mb_strtolower(input_clean($_POST['language_code']));
            $_POST['status'] = isset($_POST['status']) && in_array($_POST['status'], ['active', 'disabled']) ? $_POST['status'] : 'active';

            $language_content = function($language_strings) {
                return <<<ALTUM
<?php

return [
{$language_strings}
];
ALTUM;
            };

            //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

            /* Check for any errors */
            $required_fields = ['language_name', 'language_code'];
            foreach($required_fields as $field) {
                if(!isset($_POST[$field]) || (isset($_POST[$field]) && empty($_POST[$field]) && $_POST[$field] != '0')) {
                    Alerts::add_field_error($field, l('global.error_message.empty_field'));
                }
            }

            if(!\Altum\Csrf::check()) {
                Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            }

            if(!is_writable(Language::$path)) {
                Alerts::add_error(sprintf(l('global.error_message.directory_not_writable'), Language::$path));
            }

            if(!is_writable(Language::$path . 'admin/')) {
                Alerts::add_error(sprintf(l('global.error_message.directory_not_writable'), Language::$path . 'admin/'));
            }

            if(in_array($_POST['language_name'], Language::$languages)) {
                Alerts::add_error(sprintf(l('admin_languages.error_message.language_exists'), $_POST['language_name'], $_POST['language_code']));
            }

            foreach(Language::$languages as $lang) {
                if($lang['code'] == $_POST['language_code']) {
                    Alerts::add_error(sprintf(l('admin_languages.error_message.language_exists'), $_POST['language_name'], $_POST['language_code']));
                    break;
                }
            }

            /* If there are no errors, continue */
            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                file_put_contents(Language::$path . $_POST['language_name'] . '#' . $_POST['language_code'] . '#' . $_POST['status'] . '.php', $language_content("\t'direction' => 'ltr',"));
                file_put_contents(Language::$path . 'admin/' . $_POST['language_name'] . '#' . $_POST['language_code'] . '#' . $_POST['status'] . '.php', $language_content(''));

                chmod(Language::$path . $_POST['language_name'] . '#' . $_POST['language_code'] . '#' . $_POST['status'] . '.php', 0777);
                chmod(Language::$path . 'admin/' . $_POST['language_name'] . '#' . $_POST['language_code'] . '#' . $_POST['status'] . '.php', 0777);

                /* Set a nice success message */
                Alerts::add_success(sprintf(l('global.success_message.create1'), '<strong>' . $_POST['language_name'] . '</strong>'));

                /* Redirect */
                redirect('admin/language-update/' . $_POST['language_name']);
            }

        }

        /* Default variables */
        $values['language_name'] = $_POST['language_name'] ?? null;
        $values['language_code'] = $_POST['language_code'] ?? null;
        $values['status'] = $_POST['status'] ?? 'active';

        /* Main View */
        $data = [
            'values' => $values
        ];

        $view = new \Altum\View('admin/language-create/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}