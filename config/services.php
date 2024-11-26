<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Mailgun, Postmark, AWS and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'token' => env('POSTMARK_TOKEN'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'resend' => [
        'key' => env('RESEND_KEY'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],
    'stripe' => [
        'public' => env('pk_test_51QOf1G2exCUWf2NA3Kw88PDlgo3XLGZXushA2bCGUzvz7tXpeeVGjWRj6c8luCfAg11zDbAz9jlSVc63lcum1JeX00apKdU13p'),
        'secret' => env('sk_test_51QOf1G2exCUWf2NAGpo896ytc9VKBVGfAFbLFIp08zvDDUImxDYJgfOR6IUZXb3YvB651fIvItqfF6wB0gUmoHP300cTQQqYBA'),
],

];
