<?php

return [
    'products'=>[
        'actions' =>[
            'createAttribute' => 'Create Combination',
            'create' => 'Create/edit Product',
            'combinations' => 'Combinations',
            'categories' => 'Categories'
        ],
        'columns' => [
            'sku' => 'SKU',
            'name' => 'Name',
            'description' => 'Description',
            'quantity' => 'Quantity',
            'price' => 'Price',
            'status' => 'Is active',
            'feature' => 'Feature',
            'value' => 'Value',
            'salePrice' => 'Discount',
            'wholesale_price' => 'Wholesale price',
            'defaultPrice' => 'Default Variant'
        ],
    ],
    'address'=>[
        'columns'=>[
            'address_1'=>'Address 1',
            'address_2'=>'Address 2',
            'countries'=>'Countries',
            'city'=>'City',
            'phone'=>'Phone',
            'zip'=>'Zip',
        ]
    ],
    'discount' => [
        'title' => 'Discounts',

        'actions' => [
            'index' => 'Discounts',
            'create' => 'New Discount',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'name' => "Name",
            'description' => "Description",
            'percentage' => "Percentage",
            'from_margin' => "From margin",
            'customer_groups' => "Customer Groups",

        ],
    ],

    'admin-user' => [
        'title' => 'Users',

        'actions' => [
            'index' => 'Users',
            'create' => 'New User',
            'edit' => 'Edit :name',
            'edit_profile' => 'Edit Profile',
            'edit_password' => 'Edit Password',
        ],

        'columns' => [
            'id' => "ID",
            'first_name' => "First name",
            'last_name' => "Last name",
            'email' => "Email",
            'password' => "Password",
            'password_repeat' => "Password Confirmation",
            'activated' => "Activated",
            'forbidden' => "Forbidden",
            'language' => "Language",
                
            //Belongs to many relations
            'roles' => "Roles",
                
        ],
    ],

    'order' => [
        'title' => 'Orders',

        'actions' => [
            'index' => 'Orders',
            'create' => 'New Order',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'reference' => "Reference",
            'courier_id' => "Courier",
            'customer_id' => "Customer",
            'address_id' => "Address",
            'order_status_id' => "Order status",
            'payment' => "Payment",
            'discounts' => "Discounts",
            'total_products' => "Total products",
            'tax' => "Tax",
            'total' => "Total",
            'total_paid' => "Total paid",
            'invoice' => "Invoice",
            'courier' => "Courier",
            'label_url' => "Label url",
            'tracking_number' => "Tracking number",
            'total_shipping' => "Total shipping",
            
        ],
    ],

    'payment-method' => [
        'title' => 'Payment Methods',

        'actions' => [
            'index' => 'Payment Methods',
            'create' => 'New Payment Method',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'title' => "Title",
            'description' => "Description",
            'price' => "Price",
            
        ],
    ],

    'setting' => [
        'title' => 'Settings',

        'actions' => [
            'index' => 'Settings',
            'create' => 'New Setting',
            'edit' => 'Edit :name',
        ],

        'columns' => [
            'id' => "ID",
            'option' => "Option",
            'value' => "Value",
            
        ],
    ],

    // Do not delete me :) I'm used for auto-generation
];