<?php
return [

    'title' => 'Peoples',
    'single' => 'people',
    'model' => 'App\Peoples',
    'columns' => [
        'id',
        'name',
        'surname',
        'birthday',
        'profession',
        'slug',
        'server',
        'virtual1',
        'virtual2',
        'actual',
        'action',
        'character',
        'comments',


    ],
    'edit_fields' => [
        'name' => [
            'type' => 'text',
            'title' => 'Name',
        ],
        'surname' => [
            'type' => 'text',
            'title' => 'Surname',
        ],
        'birthday'  => [
            'type' => 'date',
            'title' => 'Birthday',
            'date_format' => 'yy-mm-dd',
        ],
        'profession'  => [
            'type' => 'text',
            'title' => 'Profession',
        ],
        'skype' => [
            'type' => 'text',
            'title' => 'Skype',
        ],
        'mail' => [
            'type' => 'text',
            'title' => 'Email',
        ],
        'mail_work' => [
            'type' => 'text',
            'title' => 'Email work',
        ],
        'phone' => [
            'type' => 'text',
            'title' => 'Phone number(+380112233445)',
        ],
        'server' => [
            'type' => 'text',
            'title' => 'Server IP',
        ],
        'server_vnc' => [
            'type' => 'text',
            'title' => 'Server VNC password',
        ],
        'server_rdp' => [
            'type' => 'text',
            'title' => 'Server Admin Login:Pass',
        ],
        'virtual1' => [
            'type' => 'text',
            'title' => 'Virtual1. Login:Pass',
        ],
        'virtual2' => [
            'type' => 'text',
            'title' => 'Virtual2. Login:Pass',
        ],
        'actual' => [
            'type' => 'number',
            'title' => 'Priority',
        ],
        'action' => [
            'type' => 'bool',
            'title' => 'Action',
        ],
        'login_otrs' => [
            'type' => 'text',
            'title' => 'OTRS',
        ],
        'character'=> [
            'type' => 'text',
            'title' => 'About him',
        ],
        'comments'=> [
            'type' => 'textarea',
            'title' => 'Comments about him',
        ],
        'slug' => [
            'type' => 'text',
            'title' => 'URL',
        ],
    ],
];
