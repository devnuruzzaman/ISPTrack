<?php

return [
    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
        'endpoint' => env('MAILGUN_ENDPOINT', 'api.mailgun.net'),
        'scheme' => 'https',
    ],

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    // SMS Configuration
    'sms' => [
        'driver' => env('SMS_DRIVER', 'bulk_sms_bd'), // example: bulk_sms_bd or other provider
        'bulk_sms_bd' => [
            'api_url' => env('BULK_SMS_API_URL', 'http://bulksmsbd.net/api/smsapi'),
            'api_key' => env('BULK_SMS_API_KEY'),
            'sender_id' => env('BULK_SMS_SENDER_ID'),
        ],
        'generic' => [
            'api_key' => env('SMS_API_KEY'),
            'sender_id' => env('SMS_SENDER_ID'),
            'base_url' => env('SMS_BASE_URL'),
        ],
    ],
];
