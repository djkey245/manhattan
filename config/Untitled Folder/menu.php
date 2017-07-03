<?php
return [

    'title' => 'Menu',
    'single' => 'item',
    'model' => 'App\Menu',
    'columns' => [
        'id',
        'title',
        'active',
        'position',
        'weight',

    ],
    'edit_fields' => [
        'title' => [
            'type' => 'text',
        ],
        'active' => [
            'type' => 'bool',
        ],
        'position' => [
            'type' => 'enum',
            'options' => [
                'left',
                'right',
            ],
        ],
        'url' => [
            'type' => 'text',
        ],
        'weight' => [
            'type' => 'number',
        ],
    ],
    'filter' => [
        'active' => [
            'type' => 'bool',
        ],
        'title' => [
            'type' => 'text',
        ],
        'position' => [
            'type' => 'enum',
            'options' => [
                'left',
                'right',
            ],
        ],
    ],
];