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

class AdminTemplateCategoryCreate extends Controller {

    public function index() {

        if(!\Altum\Plugin::is_active('aix')) {
            redirect('dashboard');
        }

        if(!empty($_POST)) {
            /* Filter some the variables */
            $_POST['name'] = input_clean($_POST['name'], 64);
            $_POST['icon'] = input_clean($_POST['icon'], 64);
            $_POST['emoji'] = input_clean($_POST['emoji'], 64);
            $_POST['color'] = !preg_match('/#([A-Fa-f0-9]{3,4}){1,2}\b/i', $_POST['color']) ? '#fff' : $_POST['color'];
            $_POST['background'] = !preg_match('/#([A-Fa-f0-9]{3,4}){1,2}\b/i', $_POST['background']) ? '#000' : $_POST['background'];
            $_POST['order'] = (int) $_POST['order'] ?? 0;
            $_POST['is_enabled'] = (int) isset($_POST['is_enabled']);

            foreach($_POST['translations'] as $language_name => $array) {
                foreach($array as $key => $value) {
                    $_POST['translations'][$language_name][$key] = input_clean($value);
                }
                if(!array_key_exists($language_name, \Altum\Language::$active_languages)) {
                    unset($_POST['translations'][$language_name]);
                }
            }

            $settings = json_encode(['translations' => $_POST['translations']]);

            //CODE:DEMO if(DEMO) Alerts::add_error('This command is blocked on the demo.');

            if(!\Altum\Csrf::check()) {
                Alerts::add_error(l('global.error_message.invalid_csrf_token'));
            }

            if(!Alerts::has_field_errors() && !Alerts::has_errors()) {

                /* Database query */
                db()->insert('templates_categories', [
                    'name' => $_POST['name'],
                    'settings' => $settings,
                    'icon' => $_POST['icon'],
                    'emoji' => $_POST['emoji'],
                    'color' => $_POST['color'],
                    'background' => $_POST['background'],
                    'order' => $_POST['order'],
                    'is_enabled' => $_POST['is_enabled'],
                    'datetime' => \Altum\Date::$date,
                ]);

                /* Clear the cache */
                \Altum\Cache::$adapter->deleteItem('templates_categories');

                /* Set a nice success message */
                Alerts::add_success(sprintf(l('global.success_message.create1'), '<strong>' . $_POST['name'] . '</strong>'));

                redirect('admin/templates-categories');
            }
        }

        /* Main View */
        $data = [];

        $view = new \Altum\View('admin/template-category-create/index', (array) $this);

        $this->add_view_content('content', $view->run($data));

    }

}
