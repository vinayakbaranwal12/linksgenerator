<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\controllers;

class Templates extends Controller {

    public function index() {
        \Altum\Authentication::guard();

        if(!\Altum\Plugin::is_active('aix') || !settings()->aix->documents_is_enabled) {
            redirect('dashboard');
        }

        /* Get available templates categories */
        $templates_categories = (new \Altum\Models\TemplatesCategories())->get_templates_categories();

        /* Templates */
        $templates = (new \Altum\Models\Templates())->get_templates();

        /* Prepare the View */
        $data = [
            'templates' => $templates,
            'templates_categories' => $templates_categories,
        ];

        $view = new \Altum\View(\Altum\Plugin::get('aix')->path . 'views/templates/index', (array) $this, true);

        $this->add_view_content('content', $view->run($data));
    }

}
