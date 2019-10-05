<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\PaymentMethod;
use App\Shop\Addresses\Address;
use App\Shop\Cities\City;
use App\Shop\Couriers\Courier;
use App\Shop\Customers\Customer;
use App\Shop\Orders\Order;
use App\Shop\OrderStatuses\OrderStatus;

$factory->define(/**
 * @param \Faker\Generator $faker
 * @return array
 */
    Order::class, function (Faker\Generator $faker) {

    $courier = Courier::query()->inRandomOrder()->first();
    $customer = Customer::query()->inRandomOrder()->first();

    $address = factory(Address::class)->create([
        'country_id' => 1,
        'city' => 'Bratislava',
        'customer_id' => $customer->id
    ]);

    $paymentMethod = PaymentMethod::query()->inRandomOrder()->first();

    $os = OrderStatus::query()->inRandomOrder()->first();

    return [
        'reference' => $faker->uuid,
        'courier_id' => $courier->id,
        'customer_id' => $customer->id,
        'billing_address_id' => $address->id,
        'shipping_address_id' => $address->id,
        'order_status_id' => $os->id,
        'payment_method_id' => $paymentMethod->id,
        'discounts' => $faker->randomFloat(2, 10, 999),
        'total_products' => $faker->randomFloat(2, 10, 5555),
        'tax' => $faker->randomFloat(2, 10, 9999),
        'total' => $faker->randomFloat(2, 10, 9999),
        'total_paid' => $faker->randomFloat(2, 10, 9999),
        'invoice' => null,
        'customer_name' => $customer->name,
        'customer_email' => $customer->email,
        'customer_phone' => $address->phone,
        'customer_company' => $customer->company,
        'customer_ico' => $customer->ico,
        'customer_dic' => $customer->dic,
        'billing_address_1' => $address->address_1,
        'billing_address_2' => $address->address_2,
        'billing_zip' => $address->zip,
        'billing_city' => $address->city,
        'billing_country' => 1,
        'billing_phone' => $address->phone,
        'shipping_address_1' => $address->address_1,
        'shipping_address_2' => $address->address_2,
        'shipping_zip' => $address->zip,
        'shipping_city' => $address->city,
        'shipping_country' => 1,
        'shipping_phone' => $address->phone,
        'shipping_customer_name' => $customer->name,
        'shipping_customer_email' => $customer->email,
        'shipping_customer_company' => $customer->company,
        'shipping_customer_ico' => $customer->ico,
        'shipping_customer_dic' => $customer->dic,
        'same_addresses' => 1
    ];
});
