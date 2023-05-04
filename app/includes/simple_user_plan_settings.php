<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

$features = [
    'custom_url',
    'deep_links',
    'removable_branding',
];

if(settings()->links->biolinks_is_enabled) {
    $features = array_merge($features, [
        'custom_backgrounds',
        'custom_branding',
        'dofollow_is_enabled',
        'leap_link',
        'seo',
        'fonts',
        'custom_css_is_enabled',
        'custom_js_is_enabled',
    ]);
}

$features = array_merge($features, [
    'statistics',
    'temporary_url_is_enabled',
    'utm',
    'password',
    'sensitive_content',
    'no_ads',
    'api_is_enabled',
]);

return $features;

