<?php

use App\Shop\OrderStatuses\OrderStatus;
use Illuminate\Database\Seeder;

class OrderStatusTableSeeder extends Seeder
{
    public function run()
    {
        factory(OrderStatus::class)->create([
            'name' => 'zaplatená',
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'prijatá',
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'zrušená',
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'na ceste',
        ]);

        factory(OrderStatus::class)->create([
            'name' => 'objednané',
        ]);
    }
}