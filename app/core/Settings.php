<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum;

class Settings {
    public static $settings = null;

    public static function initialize($settings) {

        self::$settings = $settings;

    }

    public static function get() {
        return self::$settings;
    }
}
