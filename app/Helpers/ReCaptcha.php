<?php

namespace App\Helpers;

class ReCaptcha
{
    public static function validateCaptcha($captchaResponse)
    {
        $client = new \GuzzleHttp\Client();
        $response = $client->post(
            'https://www.google.com/recaptcha/api/siteverify',
            [
                'form_params' => [
                    'secret' => env('RECAPTCHA_SECRET_KEY'),
                    'response' => $captchaResponse
                ]
            ]
        );
        
        $body = json_decode((string)$response->getBody());
        return $body->success;
    }
}
