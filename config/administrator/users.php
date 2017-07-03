<?php
return [

    'title' => 'Users',
    'single' => 'user',
    'model' => 'App\User',
    'columns' => [
        'id',
        'email',
        'actual',
    ],
    'edit_fields' => [
        'email' => [
            'type' => 'text',
        ],
        'actual' => [
            'type' => 'text',
        ],
    ],
];
