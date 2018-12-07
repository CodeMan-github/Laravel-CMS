<?php

return [

    'mailgun' => [
        'domain' => 'sandbox06379c1b93d244f1aad1b398131b3ecb.mailgun.org',
        'secret' => 'key-e07b8d6a7900c14899c305c9db40c907',
    ],

    'mandrill' => [
        'secret' => '',
    ],

    'ses' => [
        'key' => '',
        'secret' => '',
        'region' => 'us-east-1',
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => '',
        'secret' => '',
    ],

];
