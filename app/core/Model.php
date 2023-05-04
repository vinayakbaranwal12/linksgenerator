<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Models;

use Altum\Traits\Paramsable;

class Model {
    use Paramsable;

    public $model;

    public function __construct(Array $params = []) {

        $this->add_params($params);

    }

}
