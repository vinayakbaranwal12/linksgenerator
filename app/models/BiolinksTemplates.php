<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\models;

class BiolinksTemplates extends Model {

    public function get_biolinks_templates() {

        /* Get the user pixels */
        $biolinks_templates = [];

        /* Try to check if the user exists via the cache */
        $cache_instance = \Altum\Cache::$adapter->getItem('biolinks_templates');

        /* Set cache if not existing */
        if(is_null($cache_instance->get())) {

            /* Get data from the database */
            $biolinks_templates_result = database()->query("SELECT * FROM `biolinks_templates` WHERE `is_enabled` = 1 ORDER BY `order`");
            while($row = $biolinks_templates_result->fetch_object()) {
                $row->settings = json_decode($row->settings);
                $biolinks_templates[$row->biolink_template_id] = $row;
            }

            \Altum\Cache::$adapter->save(
                $cache_instance->set($biolinks_templates)->expiresAfter(CACHE_DEFAULT_SECONDS)
            );

        } else {

            /* Get cache */
            $biolinks_templates = $cache_instance->get();

        }

        return $biolinks_templates;

    }

}
