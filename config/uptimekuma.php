<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Uptimekuma Settings
    |--------------------------------------------------------------------------
    |
    |
    */

    'active' => env('KUMA_ACTIVE', 1),

    'user_id' => env('KUMA_USER_ID', 1),

    'interval' => env('KUMA_INTERVAL', 60),

    'retry_interval' => env('KUMA_RETRY_INTERVAL', 60),

    'timeout' => env('KUMA_TIMEOUT', 48),

    'token' => env('KUMA_API_TOKEN', ''),

    'notifications' => explode(',', env('KUMA_NOTIFICATIONS', '')),
];
