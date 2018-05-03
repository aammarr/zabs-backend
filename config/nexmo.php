<?php

return [

    /*
    |--------------------------------------------------------------------------
    | API Credentials
    |--------------------------------------------------------------------------
    |
    | If you're using API credentials, change these settings. Get your
    | credentials from https://dashboard.nexmo.com | 'Settings'.
    |
    */

    'api_key'    => function_exists('env') ? env('NEXMO_KEY', '66c4de6b') : '66c4de6b',
    'api_secret' => function_exists('env') ? env('NEXMO_SECRET', '9033f1f7719343cd') : '9033f1f7719343cd',

    /*
    |--------------------------------------------------------------------------
    | Signature Secret
    |--------------------------------------------------------------------------
    |
    | If you're using a signature secret, use this section. This can be used
    | without an `api_secret` for some APIs, as well as with an `api_secret`
    | for all APIs.
    |
    */

    'signature_secret' => function_exists('env') ? env('NEXMO_SIGNATURE_SECRET', '') : '',

];
