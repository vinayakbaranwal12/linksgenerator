<?php
/*
 * @copyright Copyright (c) 2023 Hypweb Solutions (https://hypweb.in/)
 *
 * This software is exclusively built by https://hypweb.in/ by Vinayak Baranwal.
 * Downloading this product from any other sources and running it without a proper license is illegal,
 *  except the official ones linked from https://hypweb.in/.
 */

namespace Altum;

class Response {

    public static function json($message, $status = 'success', $details = []) {
        if(!is_array($message) && $message) $message = [$message];

        echo json_encode(
            [
                'message' 	=> $message,
                'status' 	=> $status,
                'details'	=> $details,
            ]
        );


        die();
    }

    /* jsonapi.org */
    public static function jsonapi_success($data, $meta = null, $response_code = 200, $others = null) {
        http_response_code($response_code);

        $response = [
            'data' => $data
        ];

        if($meta) {
            $response['meta'] = $meta;
        };

        if($others) {
            $response = array_merge($response, $others);
        }

        echo json_encode($response);

        die();
    }

    public static function jsonapi_error($errors, $meta = null, $response_code = 400) {
        http_response_code($response_code);

        $response = [
            'errors' => $errors
        ];

        if($meta) {
            $response['meta'] = $meta;
        };

        echo json_encode($response);

        die();
    }


    public static function simple_json($response) {

        echo json_encode($response);

        die();

    }

}