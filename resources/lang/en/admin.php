<?php

return [
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

    // Do not delete me :) I'm used for auto-generation
];