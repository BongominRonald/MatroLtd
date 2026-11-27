<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Resend, Postmark, AWS, and more. This file provides the de facto
    | location for this type of information, allowing packages to have
    | a conventional file to locate the various service credentials.
    |
    */

    'postmark' => [
        'key' => env('POSTMARK_API_KEY'),
    ],

    'resend' => [
        'key' => env('RESEND_API_KEY'),
    ],

    'ses' => [
        'key' => env('AWS_ACCESS_KEY_ID'),
        'secret' => env('AWS_SECRET_ACCESS_KEY'),
        'region' => env('AWS_DEFAULT_REGION', 'us-east-1'),
    ],

    'slack' => [
        'notifications' => [
            'bot_user_oauth_token' => env('SLACK_BOT_USER_OAUTH_TOKEN'),
            'channel' => env('SLACK_BOT_USER_DEFAULT_CHANNEL'),
        ],
    ],

    'google' => [
        'client_id' => env('GOOGLE_CLIENT_ID'),
        'client_secret' => env('GOOGLE_CLIENT_SECRET'),
        'redirect' => env('GOOGLE_REDIRECT_URI', env('APP_URL', 'http://localhost') . '/auth/google/callback'),
        'site_verification' => env('GOOGLE_SITE_VERIFICATION', '3cxhqQ5SqG9YYE-tJcZo9FSWTRymvtjtsf038n0zXQk'),
    ],

    'company' => [
        'name' => env('COMPANY_NAME', 'BRX AGRO GLOBAL IMPORTAÇÃO E EXPORTAÇÃO LTDA'),
        'trade_desk_email' => env('COMPANY_TRADE_DESK_EMAIL', 'brxagroglobal@gmail.com'),
        'notification_emails' => env('COMPANY_NOTIFICATION_EMAIL', 'brxagroglobal@gmail.com'),
        'phone' => env('COMPANY_PHONE', '+55 11 95835-3433'),
        'whatsapp' => env('COMPANY_WHATSAPP', '+55 11 95835-3433'),
        'whatsapp_raw' => env('COMPANY_WHATSAPP_RAW', '5511958353433'),
        'callmebot_api_key' => env('CALLMEBOT_API_KEY'),
        'callmebot_phone' => env('CALLMEBOT_PHONE'),
        'whatsapp_cloud_token' => env('WHATSAPP_CLOUD_TOKEN'),
        'whatsapp_phone_number_id' => env('WHATSAPP_PHONE_NUMBER_ID', env('WHATSAPP_PHONE_ID')),
        'twilio_sid' => env('TWILIO_SID', env('TWILIO_ACCOUNT_SID')),
        'twilio_auth_token' => env('TWILIO_AUTH_TOKEN', env('TWILIO_TOKEN')),
        'twilio_whatsapp_from' => env('TWILIO_WHATSAPP_FROM', '+14155238886'),
        'whatsapp_api_url' => env('WHATSAPP_API_URL'),
        'whatsapp_api_token' => env('WHATSAPP_API_TOKEN'),
        'disable_trade_desk_dispatch' => env('DISABLE_TRADE_DESK_DISPATCH', false),
        'disable_live_dispatch' => env('DISABLE_LIVE_DISPATCH', false),
        'notification_webhook' => env('ORDER_NOTIFICATION_WEBHOOK_URL'),
    ],

    'adsense' => [
        'client_id' => env('GOOGLE_ADSENSE_CLIENT_ID', 'ca-pub-2252067205687343'),
        'enabled' => env('GOOGLE_ADSENSE_ENABLED', true),
        'slot_top' => env('GOOGLE_ADSENSE_SLOT_TOP'),
        'slot_mid' => env('GOOGLE_ADSENSE_SLOT_MID'),
        'slot_footer' => env('GOOGLE_ADSENSE_SLOT_FOOTER'),
    ],

];
