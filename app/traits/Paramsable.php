<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Traits;

trait Paramsable {

    /* Function used by the base model, controller and view */
    public function add_params(Array $params = []) {

        /* Make the params available to the Controller */
        foreach($params as $key => $value) {
            $this->{$key} = $value;
        }

    }

}
