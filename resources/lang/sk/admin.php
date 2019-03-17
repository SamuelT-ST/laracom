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
            'status' => "Status",
            'groups' => "Zákaznícke skupiny",
            'enabled' => "Enabled",

        ],
    ],
];