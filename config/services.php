<?php

return [

    /*
    |--------------------------------------------------------------------------
    | Third Party Services
    |--------------------------------------------------------------------------
    |
    | This file is for storing the credentials for third party services such
    | as Stripe, Mailgun, SparkPost and others. This file provides a sane
    | default location for this type of information, allowing packages
    | to have a conventional place to find your various credentials.
    |
    */

    'mailgun' => [
        'domain' => env('MAILGUN_DOMAIN'),
        'secret' => env('MAILGUN_SECRET'),
    ],

    'ses' => [
        'key' => env('SES_KEY'),
        'secret' => env('SES_SECRET'),
        'region' => 'us-east-1',
    ],

    'sparkpost' => [
        'secret' => env('SPARKPOST_SECRET'),
    ],

    'stripe' => [
        'model' => App\User::class,
        'key' => env('STRIPE_KEY'),
        'secret' => env('STRIPE_SECRET'),
    ],
    'google' => [
    
        'client_id' => '639064512843-vace0loc6534l0vpnhoq1kvpg5k0odms.apps.googleusercontent.com',
        'client_secret' => '3mkaL7j8uribnN9Ke3A8TPaR',
        'redirect' => 'http://www.tdev.com.ar/callback/google',
    ],
     'facebook' => [

        'client_id' => '1858603317756528',
        'client_secret' => '7ed07131c2c732bc4c9cba9a3a54bd38',
        'redirect' => 'http://www.tdev.com.ar/callback/facebook',
    ],
    

];
