<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum;

class ThemeStyle {
    public static $themes = [
        'light' => [
            'ltr' => 'bootstrap.min.css',
            'rtl' => 'bootstrap-rtl.min.css'
        ],
        'dark' => [
            'ltr' => 'bootstrap-dark.min.css',
            'rtl' => 'bootstrap-dark-rtl.min.css'
        ],
    ];
    public static $theme = 'light';

    public static function get() {
        if(isset($_COOKIE['theme_style']) && array_key_exists($_COOKIE['theme_style'], self::$themes)) {
            self::$theme = input_clean($_COOKIE['theme_style']);
        }

        return self::$theme;
    }

    public static function get_file() {
        return self::$themes[self::get()][l('direction')];
    }

    public static function set_default($theme) {
        self::$theme = $theme;
    }

}
