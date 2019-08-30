<?php

return [
    'attributes'=>[
        'actions' => [
            'index' => 'Attributes',
            'create' => 'Create'
        ],
        'columns'=> [
            'name' => 'Name'
        ],
    ],
    'order-statuses' => [
        'columns' => [
            'name' => 'Názov',
            'color' => 'Farba'
        ],
        'actions' => [
            'create' => 'Vytvoriť nový stav objednávky'
        ]
    ],
    'customers' => [
        'columns' => [
            'name' => 'Meno',
            'email' => 'Email',
            'groups' => 'Skupina',
            'status' => 'Status',
            'password' => 'Heslo',
            'password_repeat' => 'Heslo znovu'
        ],
        'actions' => [
            'create' => 'Vytvoriť nového zákazníka'
        ]
    ],
    'category' => [
        'actions' => [
            'create' => 'Vytvoriť kategóriu'
        ],
        'columns' => [
            'parent' => 'Rodičovská kategória',
            'name' => 'Názov',
            'description' => 'Popis',
            'status' => 'Aktívna'
        ]
    ],
    'products'=>[
        'actions' =>[
            'index' => 'Produkty',
            'createAttribute' => 'Vytvoriť kombináciu',
            'create' => 'Vytvoriť produkt',
            'combinations' => 'Kombinácie',
            'categories' => 'Kategórie'
        ],
        'columns' => [
            'sku' => 'SKU',
            'width' => "Śírka",
            'height' => "Výška",
            'length' => "Hĺbka",
            'name' => 'Názov',
            'description' => 'Popis',
            'quantity' => 'Množstvo',
            'price' => 'Cena',
            'status' => 'Aktívny',
            'feature' => 'Vlastnosť',
            'value' => 'Hodnota',
            'salePrice' => 'Zľava',
            'wholesale_price' => 'Nákupná cena',
            'defaultPrice' => 'Základný variant'
        ],
    ],
    'address'=>[
        'columns'=>[
            'address_1'=>'Adresa 1',
            'address_2'=>'Adresa 2',
            'countries'=>'Krajina',
            'city'=>'Mesto',
            'phone'=>'Telefón',
            'zip'=>'PSČ',
        ]
    ],
    'discount' => [
        'title' => 'Zľavy',

        'actions' => [
            'index' => 'Zľavy',
            'create' => 'Nová Zľava',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Meno",
            'description' => "Popis",
            'percentage' => "Zľava v percentách",
            'from_margin' => "Z pridanej hodnoty",
            'customer_groups' => "Zálaznícke skupiny",

        ],
    ],

    'admin-user' => [
        'title' => 'Užívatelia',

        'actions' => [
            'index' => 'Užívatelia',
            'create' => 'Nový Užívateľ',
            'edit' => 'Upraviť :name',
            'edit_profile' => 'Upraviť Profil',
            'edit_password' => 'Upraviť Heslo',
        ],

        'columns' => [
            'id' => "ID",
            'first_name' => "Meno",
            'last_name' => "Priezvisko",
            'email' => "Email",
            'password' => "Heslo",
            'password_repeat' => "Zopakuj heslo",
            'activated' => "Aktivovaný",
            'forbidden' => "Blokovaný",
            'language' => "Jazyk",

            //Belongs to many relations
            'roles' => "Role",

        ],
    ],

    'order' => [
        'title' => 'Objednávky',

        'actions' => [
            'index' => 'Objednávky',
            'create' => 'Nová Objednávka',
            'edit' => 'Uprav :name',
            'new_customer' => 'Pridať nového zákazníka'
        ],

        'columns' => [
            'id' => "ID",
            'reference' => "Referenčné číslo",
            'courier_id' => "Doručenie",
            'customer_id' => "Zákazník",
            'address_id' => "Adresa",
            'order_status_id' => "Stav objednávky",
            'payment' => "Platba",
            'discounts' => "Zľava",
            'total_products' => "Produkty celkom",
            'tax' => "Daň",
            'total' => "Celkom",
            'total_paid' => "Celkom zaplatené",
            'invoice' => "Faktúra",
            'courier' => "Doručenie",
            'label_url' => "Label url",
            'tracking_number' => "Číslo zásielky",
            'total_shipping' => "Celkom doručenie",

        ],
    ],

    'payment-method' => [
        'title' => 'Platobné metódy',

        'actions' => [
            'index' => 'Platobné metódy',
            'create' => 'Nová platobná metóda',
            'edit' => 'Uprav :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Názov",
            'description' => "Popis",
            'price' => "Cena",

        ],
    ],

    'setting' => [
        'title' => 'Nastavenia',

        'actions' => [
            'index' => 'Nastavenia',
            'create' => 'Nové Nastavenie',
            'edit' => 'Uprav :name',
        ],

        'columns' => [
            'id' => "ID",
            'option' => "Nastavenie",
            'value' => "Hodnota",

        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];