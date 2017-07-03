<?php
return [
    'title' => 'Press',
    'single' => 'record',
    'model' => 'App\Press',
    'columns' => [
        'id',
        'active',
        'title',
        'published_at'
    ],
    'edit_fields' => [
        'active' => [
            'type' => 'bool',
        ],
        'title' => [
            'type' => 'text',
        ],
        'slug' => [
            'type' => 'text',
        ],
        'body' => [
            'type' => 'wysiwyg',
        ],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/press/original/',
            'sizes' => [
                [500, 500, 'auto', public_path().'/uploads/press/medium/', 100],
                [100, 100, 'auto', public_path().'/uploads/press/small/', 100],
            ],
        ],

    ],
    'form_width' => 800,
];