<?php

use App\Models\PaymentMethod;
use App\Shop\Couriers\Courier;
use Illuminate\Database\Seeder;

class CourierTableSeeder extends Seeder
{
    public function run()
    {
        $courier = factory(Courier::class)->create([
            'name' => 'Doručenie zadarmo',
            'description' => 'Doručenie zadarmo',
            'price' => '0',
        ]);

        $courier->paymentMethods()->insert(factory(PaymentMethod::class, 2)->raw());

        $courier2 = factory(Courier::class)->create([
            'name' => 'Slovenská pošta',
            'description' => 'Doručenie prostredníctvom slovenskej pošty',
            'price' => '3.5',
        ]);

        $courier2->paymentMethods()->insert(factory(PaymentMethod::class, 2)->raw());

        factory(Courier::class)->create([
            'name' => 'GLS',
            'description' => 'Doručenie pomocou GLS',
            'price' => '5.5',
        ]);
    }
}