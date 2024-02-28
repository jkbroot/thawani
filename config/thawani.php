<?php
return [
    'mode' => env('THAWANI_MODE', 'test'),
    'test' => [
        'base_url' => 'https://uatcheckout.thawani.om/api/v1',
        'checkout_base_url' => 'https://uatcheckout.thawani.om/pay',
        'secret_key' => env('THAWANI_TEST_SECRET_KEY', 'rRQ26GcsZzoEhbrP2HZvLYDbn9C9et'),
        'publishable_key' => env('THAWANI_TEST_PUBLISHABLE_KEY', 'HGvTMLDssJghr9tlN9gr4DVYt0qyBy'),
    ],
    'live' => [
        'base_url' => 'https://checkout.thawani.om/api/v1',
        'checkout_base_url' => 'https://checkout.thawani.om/pay',
        'secret_key' => env('THAWANI_LIVE_SECRET_KEY'),
        'publishable_key' => env('THAWANI_LIVE_PUBLISHABLE_KEY'),
    ],

];
