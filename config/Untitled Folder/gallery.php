<?php
return [
    'title' => 'Gallery',
    'single' => 'image',
    'model' => 'App\Gallery',
    'columns' => [
        'id',
        'active',
        'title',
        'alt',
        'image' => [
            'output' => '<img src="/uploads/images/small/(:value)" />'
        ],
    ],
    'edit_fields' => [
        'project' => [
            'type' => 'relationship',
            'name_field' => 'title',
        ],
        'active' => [
            'type' => 'bool',
        ],
        'weight' => [
            'type' => 'number',
        ],
        'title' => [
            'type' => 'text',
        ],
        'alt' => [
            'type' => 'text',
        ],
        'image' => [
    'type' => 'image',
    'location' => public_path().'/uploads/images/original/',
    'sizes' => [
        [100, 100, 'auto', public_path().'/uploads/images/small/', 100],
        [500, 500, 'auto', public_path().'/uploads/images/medium/', 100],
        [1000, 800, 'auto', public_path().'/uploads/images/large/', 100],
    ],
],

    ],

];