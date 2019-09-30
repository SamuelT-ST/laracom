<?php

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Discount::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->sentence,
        'percentage' => $faker->randomNumber(5),
        'from_margin' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(Brackets\AdminAuth\Models\AdminUser::class, function (Faker\Generator $faker) {
    return [
        'first_name' => $faker->firstName,
        'last_name' => $faker->lastName,
        'email' => $faker->email,
        'password' => bcrypt($faker->password),
        'remember_token' => null,
        'activated' => true,
        'forbidden' => $faker->boolean(),
        'language' => 'en',
        'deleted_at' => null,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
    ];
});/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Order::class, function (Faker\Generator $faker) {
    return [
        'reference' => $faker->sentence,
        'courier_id' => $faker->randomNumber(5),
        'customer_id' => $faker->randomNumber(5),
        'address_id' => $faker->randomNumber(5),
        'order_status_id' => $faker->randomNumber(5),
        'payment' => $faker->sentence,
        'discounts' => $faker->randomNumber(5),
        'total_products' => $faker->randomNumber(5),
        'tax' => $faker->randomNumber(5),
        'total' => $faker->randomNumber(5),
        'total_paid' => $faker->randomNumber(5),
        'invoice' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        'courier' => $faker->sentence,
        'label_url' => $faker->sentence,
        'tracking_number' => $faker->sentence,
        'total_shipping' => $faker->randomNumber(5),
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\PaymentMethod::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'description' => $faker->sentence,
        'price' => $faker->randomNumber(5),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Setting::class, function (Faker\Generator $faker) {
    return [
        'option' => $faker->sentence,
        'value' => $faker->sentence,
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\Courier::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text(),
        'from_width' => $faker->randomNumber(5),
        'from_height' => $faker->randomNumber(5),
        'from_length' => $faker->randomNumber(5),
        'url' => $faker->sentence,
        'price' => $faker->randomNumber(5),
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

/** @var  \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\Models\ProductGroup::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->firstName,
        'description' => $faker->text(),
        'discount' => $faker->sentence,
        'status' => $faker->boolean(),
        'created_at' => $faker->dateTime,
        'updated_at' => $faker->dateTime,
        
        
    ];
});

