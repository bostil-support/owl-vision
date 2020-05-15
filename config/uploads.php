<?php

return [
    'images' => [
        'disk' => 'images',

        'models' => [
            'default'    => [
//                'method' => 'fit',
                'method' => 'resize',
                'width'  => 800,
                'height' => 600,
            ],
            'products'   => [
                'method' => 'resize',
                'width'  => 800,
                'height' => 600,
            ],
            'categories' => [
                'method' => 'resize',
                'width'  => 600,
                'height' => 600,
            ],
        ],
    ],
];