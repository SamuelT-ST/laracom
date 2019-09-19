<?php

return [
    'attributes'=>[
        'actions' => [
            'index' => 'Atribúty',
            'create' => 'Nový atribút'
        ],
        'columns'=> [
            'name' => 'Názov'
        ],
    ],
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
            'groups' => "Zákazník",
            'phone' => "Telefón",
            'countries' => "Krajina",
            'status' => "Aktiívny",
        ],
    ],
    'order' => [
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
            'billing_address_1' => "Adresa 1",
            'billing_address_id' => "Adresa",
            'billing_address_2' => "Adresa 2",
            'billing_city' => "Mesto",
            'billing_phone' => "Telefón",
            'billing_zip' => "PSČ",
            'same_address' => "Fakturačná adresa je rovnaká ako adresa doručenia",
            'shipping_address_1' => "Adresa 1",
            'shipping_address_id' => "Adresa",
            'shipping_address_2' => "Adresa 2",
            'shipping_city' => "Mesto",
            'shipping_phone' => "Telefón",
            'shipping_zip' => "PSČ",
            'countries' => "Krajina",
            'is_company' => "Objednávka na firmu",
            'customer_name' => "Meno",
            'customer_email' => "Email",
            'customer_company' => "Firma",
            'customer_ico' => "IČO",
            'customer_dic' => "DIČ",
        ],
    ],
    'order-statuses' => [
        'title' => 'Stavy objednávok',

        'actions' => [
            'index' => 'Stavy objednávok',
            'create' => 'Nový stav',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'name' => "Názov",
            'color' => "Farba",
        ],
    ],
    'products' => [
        'title' => 'Produkty',

        'actions' => [
            'index' => 'Produkty',
            'create' => 'Nový produkt',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Meno",
            'email' => "Email",
            'width' => "Śírka",
            'height' => "Výška",
            'length' => "Hĺbka",
            'status' => "Aktívny",
            'groups' => "Zákaznícke skupiny",
            'enabled' => "Enabled",
            'password' => "Heslo",
            'password_repeat' => "Zopakuj heslo",
            'select_groups' => "Vyberte skupiny"

        ],
    ],
    'attributes' => [
        'title' => 'Atribúty',

        'actions' => [
            'index' => 'Atribúty',
            'create' => 'Nový atribút',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'name' => "Meno"
        ],
    ],

    'category' => [
        'title' => 'Kategórie',

        'actions' => [
            'index' => 'Kategórie',
            'create' => 'Nová kategória',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Meno",
            'slug' => "Slug",
            'description' => "Popis",
            'parent' => "Rodičovská kategória",
            'status' => "Aktívna",

        ],
    ],

    'couriers' => [
        'title' => 'Spôsoby doručenia',

        'actions' => [
            'index' => 'Spôsoby doručenia',
            'create' => 'Nový spôsob doručenia',
            'edit' => 'Upraviť :name',
        ],

        'columns' => [
            'name' => "Meno",
            'description' => "Popis",
            'url' => "Url",
            'is_free' => "Zadarmo",
            'cost' => "Cena",
            'status' => "Aktívny"

        ],
    ],
];