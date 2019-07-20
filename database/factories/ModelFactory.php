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

