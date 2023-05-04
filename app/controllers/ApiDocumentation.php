<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Controllers;

use Altum\Title;

class ApiDocumentation extends Controller {

    public function index() {

        $endpoint = isset($this->params[0]) ? query_clean(str_replace('-', '_', $this->params[0])) : null;

        if($endpoint) {
            if(!file_exists(THEME_PATH . 'views/api-documentation/' . $endpoint . '.php')) {
                redirect();
            }

            Title::set(l('api_documentation.' . $endpoint . '.title'));

            /* Prepare the View */
            $view = new \Altum\View('api-documentation/' . $endpoint, (array) $this);
        } else {
            /* Prepare the View */
            $view = new \Altum\View('api-documentation/index', (array) $this);
        }

        $this->add_view_content('content', $view->run());

    }
}


