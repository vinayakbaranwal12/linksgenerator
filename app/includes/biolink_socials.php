<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

return [
    'email' => [
        'format' => 'mailto:%s',
        'input_group' => null,
        'max_length' => 320,
        'icon' => 'fa fa-envelope'
    ],
    'tel'=> [
        'format' => 'tel: %s',
        'input_group' => null,
        'max_length' => 32,
        'icon' => 'fa fa-phone-square-alt'
    ],
    'telegram'=> [
        'format' => 'https://t.me/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-telegram'
    ],
    'whatsapp'=> [
        'format' => 'https://wa.me/%s',
        'input_group' => null,
        'max_length' => 32,
        'icon' => 'fab fa-whatsapp'
    ],
    'facebook'=> [
        'format' => 'https://facebook.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-facebook'
    ],
    'facebook-messenger'=> [
        'format' => 'https://m.me/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-facebook-messenger'
    ],
    'instagram'=> [
        'format' => 'https://instagram.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-instagram'
    ],
    'twitter'=> [
        'format' => 'https://twitter.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-twitter'
    ],
    'tiktok'=> [
        'format' => 'https://tiktok.com/@%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-tiktok'
    ],
    'youtube'=> [
        'format' => 'https://youtube.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-youtube'
    ],
    'soundcloud'=> [
        'format' => 'https://soundcloud.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-soundcloud'
    ],
    'linkedin'=> [
        'format' => 'https://linkedin.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-linkedin'
    ],
    'spotify' => [
        'format' => 'https://open.spotify.com/artist/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-spotify'
    ],
    'pinterest' => [
        'format' => 'https://pinterest.com/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-pinterest'
    ],
    'snapchat' => [
        'format' => 'https://snapchat.com/add/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-snapchat'
    ],
    'twitch' => [
        'format' => 'https://twitch.tv/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-twitch'
    ],
    'discord' => [
        'format' => 'https://discord.gg/%s',
        'input_group' => true,
        'max_length' => 128,
        'icon' => 'fab fa-discord'
    ],
    'address' => [
        'format' => 'https://maps.google.com/maps?q=%s',
        'input_group' => false,
        'max_length' => 64,
        'icon' => 'fa fa-map-marker-alt'
    ],
];
