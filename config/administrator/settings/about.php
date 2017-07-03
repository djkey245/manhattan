<?php
return [
    'title' => 'About',
    'edit_fields' => [
        'content' => [
            'type' => 'textarea',
        ],
        'image' => [
            'type' => 'image',
            'location' => public_path().'/uploads/',
        ],
    ],
];