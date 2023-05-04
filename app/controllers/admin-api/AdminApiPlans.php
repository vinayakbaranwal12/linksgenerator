<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum\Controllers;

use Altum\Response;
use Altum\Traits\Apiable;

class AdminApiPlans extends Controller {
    use Apiable;

    public function index() {

        $this->verify_request(true);

        /* Decide what to continue with */
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':

                /* Detect if we only need an object, or the whole list */
                if(isset($this->params[0])) {
                    $this->get();
                } else {
                    $this->get_all();
                }

                break;
        }

        $this->return_404();

    }

    private function get_all() {

        /* Get the data */
        $data = [];

        foreach(['free', 'custom', 'guest'] as $plan) {
            $data[] = [
                'id' => settings()->{'plan_' . $plan}->plan_id,
                'name' => settings()->{'plan_' . $plan}->name,
                'description' => settings()->{'plan_' . $plan}->description,
                'price' => settings()->{'plan_' . $plan}->price,
                'color' => settings()->{'plan_' . $plan}->color,
                'status' => settings()->{'plan_' . $plan}->status,
                'settings' => settings()->{'plan_' . $plan}->settings,
            ];
        }

        $data_result = database()->query("SELECT * FROM `plans`");
        while($row = $data_result->fetch_object()) {

            /* Prepare the data */
            $row = [
                'id' => (int) $row->plan_id,
                'name' => $row->name,
                'description' => $row->description,
                'monthly_price' => (float) $row->monthly_price,
                'annual_price' => (float) $row->annual_price,
                'lifetime_price' => (float) $row->lifetime_price,
                'trial_days' => (int) $row->trial_days,
                'settings' => json_decode($row->settings),
                'codes_ids' => json_decode($row->codes_ids),
                'taxes_ids' => json_decode($row->taxes_ids),
                'color' => $row->color,
                'status' => (int) $row->status,
                'order' => (int) $row->order,
                'datetime' => $row->datetime,
            ];

            $data[] = $row;
        }

        Response::jsonapi_success($data);
    }

    private function get() {

        $plan_id = isset($this->params[0]) ? $this->params[0] : null;

        /* Try to get details about the resource id */
        switch($plan_id) {
            case 'guest':
            case 'free':
            case 'custom':
                $plan = settings()->{'plan_' . $plan_id};
                break;

            default:
                $plan = db()->where('plan_id', $plan_id)->getOne('plans');
                break;
        }

        /* We haven't found the resource */
        if(!$plan) {
            $this->return_404();
        }

        /* Prepare the data */
        if(in_array($plan->plan_id, ['guest', 'free', 'custom'])) {
            $data[] = [
                'id' => settings()->{'plan_' . $plan->plan_id}->plan_id,
                'name' => settings()->{'plan_' . $plan->plan_id}->name,
                'description' => settings()->{'plan_' . $plan->plan_id}->description,
                'price' => settings()->{'plan_' . $plan->plan_id}->price,
                'color' => settings()->{'plan_' . $plan->plan_id}->color,
                'status' => settings()->{'plan_' . $plan->plan_id}->status,
                'settings' => settings()->{'plan_' . $plan->plan_id}->settings,
            ];
        } else {
            $data = [
                'id' => (int) $plan->plan_id,
                'name' => $plan->name,
                'description' => $plan->description,
                'monthly_price' => (float) $plan->monthly_price,
                'annual_price' => (float) $plan->annual_price,
                'lifetime_price' => (float) $plan->lifetime_price,
                'trial_days' => (int) $plan->trial_days,
                'settings' => json_decode($plan->settings),
                'codes_ids' => json_decode($plan->codes_ids),
                'taxes_ids' => json_decode($plan->taxes_ids),
                'color' => $plan->color,
                'status' => (int) $plan->status,
                'order' => (int) $plan->order,
                'datetime' => $plan->datetime,
            ];
        }

        Response::jsonapi_success($data);

    }

}
