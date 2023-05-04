<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum;

/* Simple wrapper for phpFastCache */

class Cache {
    public static $adapter;

    public static function initialize($force_enable = false) {

        $driver = $force_enable ? 'Files' : (CACHE ? 'Files' : 'Devnull');

        /* Cache adapter for phpFastCache */
        if($driver == 'Files') {
            $config = new \Phpfastcache\Drivers\Files\Config([
                'securityKey' => PRODUCT_KEY,
                'path' => UPLOADS_PATH . 'cache',
                'preventCacheSlams' => true,
                'cacheSlamsTimeout' => 20,
                'secureFileManipulation' => true
            ]);
        } else {
            $config = new \Phpfastcache\Config\Config([
                'path' => UPLOADS_PATH . 'cache',
            ]);
        }

        \Phpfastcache\CacheManager::setDefaultConfig($config);

        self::$adapter = \Phpfastcache\CacheManager::getInstance($driver);
    }

}
