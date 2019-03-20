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
    'address' => [
        'title' => 'Adresy',

        'actions' => [
            'index' => 'Adresy',
            'create' => 'Nová adresa',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'alias' => "Alias",
            'address_1' => "Adresa",
            'address_2' => "Adresa",
            'zip' => "Zip",
            'city' => "Mesto",
            'customer' => "Zákazník",
            'groups' => "Zákaznícke skupiny",
            'phone' => "Telefón",
            'countries' => "Krajina",
        ],
    ],
    'orders' => [
        'title' => 'Objednávky',

        'actions' => [
            'index' => 'Objednávky',
            'create' => 'Nová objednávka',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'date' => "Dátum",
            'courier' => "Spôsob dodania",
            'total' => "Cena celkom",
            'status' => "Stav objednávky",
            'customer' => "Zákazník",
        ],
    ],
    'order-statuses' => [
        'title' => 'Stavy objednávok',

        'actions' => [
            'index' => 'Stavy objednávok',
            'create' => 'Nová stav',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'name' => "Názov",
            'color' => "Farba",
        ],
    ],
];