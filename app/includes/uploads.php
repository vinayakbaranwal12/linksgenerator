<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

return [
    /* Main */
    'logo_light' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'],
        'path' => 'main/',
    ],
    'logo_dark' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'],
        'path' => 'main/',
    ],
    'logo_email' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'gif'],
        'path' => 'main/',
    ],
    'favicon' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'ico', 'svg', 'gif', 'webp'],
        'path' => 'main/',
    ],
    'opengraph' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'],
        'path' => 'main/',
    ],

    /* Blog featured images */
    'blog' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'],
        'path' => 'blog/',
    ],

    /* Payment proofs for offline payments */
    'offline_payment_proofs' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'pdf'],
        'path' => 'offline_payment_proofs/',
    ],

    /* QR codes */
    'qr_code' => [],

    'qr_code_logo' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'gif']
    ],

    /* Biolinks themes preview thumbnail */
    'biolinks_themes' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp']
    ],

    /* Biolinks templates preview thumbnail */
    'biolinks_templates' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'webp']
    ],

    /* File upload links */
    'files' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'gif', 'pdf', 'zip']
    ],

    /* Vcard avatars */
    'vcards_avatars' => [
        'whitelisted_file_extensions' => ['png', 'jpg', 'jpeg'],
        'path' => 'avatars/',
    ],

    /* Biolink */
    'biolink_seo_image' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'],
        'path' => 'block_images/',
    ],

    'biolink_favicon' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'ico', 'svg', 'gif', 'webp'],
        'path' => 'favicons/',
    ],

    'biolink_background' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp', 'mp4'],
        'path' => 'backgrounds/',
    ],

    /* AIX */
    'images' => [
        'whitelisted_file_extensions' => ['png'],
        'path' => 'images/',
    ],

    'transcriptions' => [
        'whitelisted_file_extensions' => ['mp3', 'mp4', 'mpeg', 'mpga', 'm4a', 'wav', 'webm'],
        'path' => 'cache/',
    ],

    'chats_avatar' => [
        'whitelisted_file_extensions' => ['jpg', 'jpeg', 'png', 'svg', 'gif', 'webp'],
        'path' => 'main/',
    ],
];
