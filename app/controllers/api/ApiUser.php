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

class ApiUser extends Controller {
    use Apiable;

    public function index() {

        $this->verify_request();

        /* Decide what to continue with */
        switch($_SERVER['REQUEST_METHOD']) {
            case 'GET':
                $this->get();
                break;
        }

        $this->return_404();
    }

    public function get() {

        /* Prepare the data */
        $data = [
            'id' => (int) $this->api_user->user_id,
            'name' => $this->api_user->name,
            'email' => $this->api_user->email,
            'language' => $this->api_user->language,
            'timezone' => $this->api_user->timezone,
            'anti_phishing_code' => (bool) $this->api_user->anti_phishing_code,
            'is_newsletter_subscribed' => (bool) $this->api_user->is_newsletter_subscribed,
            'billing' => json_decode($this->api_user->billing),
            'status' => (bool) $this->api_user->status,
            'plan_id' => $this->api_user->plan_id,
            'plan_expiration_date' => $this->api_user->plan_expiration_date,
            'plan_settings' => json_decode($this->api_user->plan_settings),
            'plan_trial_done' => (bool) $this->api_user->plan_trial_done,
            'payment_processor' => $this->api_user->payment_processor,
            'payment_total_amount' => $this->api_user->payment_total_amount,
            'payment_currency' => $this->api_user->payment_currency,
            'payment_subscription_id' => $this->api_user->payment_subscription_id,
            'source' => $this->api_user->source,
            'ip' => $this->api_user->ip,
            'continent_code' => $this->api_user->continent_code,
            'country' => $this->api_user->country,
            'city_name' => $this->api_user->city_name,
            'api_key' => $this->api_user->api_key,
            'referral_key' => $this->api_user->referral_key,
            'referred_by' => $this->api_user->referred_by,
            'last_activity' => $this->api_user->last_activity,
            'last_user_agent' => $this->api_user->last_user_agent,
            'total_logins' => (int) $this->api_user->total_logins,
            'datetime' => $this->api_user->datetime,
        ];

        Response::jsonapi_success($data);
    }
}
