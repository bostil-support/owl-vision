<?php

return [
    'basketlist' => [
        'cacheKey' => sprintf('%s_ecommerce_basketlist', \Illuminate\Support\Str::snake(env('APP_NAME'))),
        'enabled' => true,
        'guards' => ['web', 'customer'],
        'models' => [
            \App\Models\Product::class
        ]
    ],
    'comparelist' => [
        'cacheKey' => sprintf('%s_ecommerce_comparelist', \Illuminate\Support\Str::snake(env('APP_NAME'))),
        'enabled' => false,
        'guards' => ['web', 'customer'],
        'models' => [
            \App\Models\Product::class
        ]
    ],
    'wishlist' => [
        'cacheKey' => sprintf('%s_ecommerce_wishlist', \Illuminate\Support\Str::snake(env('APP_NAME'))),
        'enabled' => true,
        'guards' => ['web', 'customer'],
        'models' => [
            \App\Models\Product::class,
        ]
    ]
];