<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Controllers;

class Affiliate extends Controller {

    public function index() {

        if(!\Altum\Plugin::is_active('affiliate') || (\Altum\Plugin::is_active('affiliate') && !settings()->affiliate->is_enabled)) {
            redirect();
        }

        /* Prepare the View */
        $view = new \Altum\View('affiliate/index', (array) $this);

        $this->add_view_content('content', $view->run());

    }

}


