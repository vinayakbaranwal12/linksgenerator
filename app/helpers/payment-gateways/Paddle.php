<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\PaymentGateways;

/* Helper class for Paddle */
class Paddle {
    static public $sandbox_api_url = 'https://sandbox-vendors.paddle.com/api/';
    static public $live_api_url = 'https://vendors.paddle.com/api/';

    public static function get_api_url() {
        return settings()->paddle->mode == 'live' ? self::$live_api_url : self::$sandbox_api_url;
    }

}
