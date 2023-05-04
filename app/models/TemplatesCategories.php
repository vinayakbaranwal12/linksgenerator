<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Models;

class TemplatesCategories extends Model {

    public function get_templates_categories() {

        /* Get the user projects */
        $templates_categories = [];

        /* Try to check if the user posts exists via the cache */
        $cache_instance = \Altum\Cache::$adapter->getItem('templates_categories');

        /* Set cache if not existing */
        if(is_null($cache_instance->get())) {

            /* Get data from the database */
            $templates_categories_result = database()->query("SELECT * FROM `templates_categories`  WHERE `is_enabled` = 1 ORDER BY `order`");
            while($row = $templates_categories_result->fetch_object()) {
                $row->settings = json_decode($row->settings);
                $templates_categories[$row->template_category_id] = $row;
            }

            \Altum\Cache::$adapter->save(
                $cache_instance->set($templates_categories)->expiresAfter(CACHE_DEFAULT_SECONDS)
            );

        } else {

            /* Get cache */
            $templates_categories = $cache_instance->get();

        }

        return $templates_categories;

    }

}
