<?php

return [

    /*
      |--------------------------------------------------------------------------
      | Third Party Services
      |--------------------------------------------------------------------------
      |
      | This file is for storing the credentials for third party services such
      | as Stripe, Mailgun, Mandrill, and others. This file provides a sane
      | default location for this type of information, allowing packages
      | to have a conventional place to find your various credentials.
      |
     */

    'mailgun' => [
        'domain' => '',
        'secret' => '',
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
        'model' => 'App\User',
        'key' => '',
        'secret' => '',
    ],
    'facebook' => [
        'client_id' => '1374445972820863',
        'client_secret' => 'aca6db182a986d6050e6f10c35c969d6',
        'redirect' => 'http://lara.shop/account/facebook',
    ],
    'twitter' => [
        'client_id' => 'Baoon51vIAKso7kQlsA',
        'client_secret' => 'LfEkusgXpUwj6xiSlbulysnZED8qaggNIs2VNO8w',
        'redirect' => 'http://lara.shop/account/twitter',
    ],
];
