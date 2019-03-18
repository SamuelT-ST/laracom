<?php

return [
    'customers' => [
        'title' => 'Zákazníci',

        'actions' => [
            'index' => 'Zákazníci',
            'create' => 'Nový zákazník',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Meno",
            'email' => "Email",
            'status' => "Aktívny",
            'groups' => "Zákaznícke skupiny",
            'enabled' => "Enabled",
            'password' => "Heslo",
            'password_repeat' => "Zopakuj heslo",
            'select_groups' => "Vyberte skupiny"

        ],
    ],
    'customerGroups' => [
        'title' => 'Zákaznícke skupiny',

        'actions' => [
            'index' => 'Zákaznícke skupiny',
            'create' => 'Nová skupina',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'title' => "Názov skupiny",
        ],
    ],
];