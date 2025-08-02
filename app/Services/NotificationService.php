<?php

namespace App\Services;

use Firebase\JWT\JWT;

class NotificationService
{
    public function sendIOSNotification($deviceToken, $title, $subtitle, $body, $deep_link = null, $badge = 0, $sandbox=false) {

        // IMPORTANT, THE FOLLOWING VARIABLES WILL BE PUT IN DATABASE
        $apple_store_api_key_id = "MQ4FU84SQY";
        $apple_store_team_id = "FPUNC48548";

        $jwt_issue_time = time();
        $key_id = $apple_store_api_key_id;
        $jwt_claim = [
            'iss' => $apple_store_team_id,
            'iat' => $jwt_issue_time
        ];
        $headers = [
            "alg" => "ES256",
            "kid" => $key_id
        ];
        $private_key = file_get_contents(storage_path('private/AuthKey_MQ4FU84SQY.p8'));
        $jwt_token = JWT::encode($jwt_claim, $private_key, 'ES256', null, $headers);

        if($sandbox)
            $url = "https://api.development.push.apple.com:443/3/device/$deviceToken";
        else
            $url = "https://api.push.apple.com:443/3/device/$deviceToken";

        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
            "Authorization: bearer $jwt_token",
            "apns-topic: com.codecrane.training-day"
        ));
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode([
            "aps" => [
                "alert" => [
                    "title" => $title,
                    "subtitle" => $subtitle,
                    "body" => $body
                ],
                "badge" => $badge,
            ],
            "deep_link" => $deep_link
        ]));
        curl_setopt($ch, CURLOPT_HTTP_VERSION, CURL_HTTP_VERSION_2_0);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        $result = curl_exec($ch);
        curl_close($ch);
    }
}