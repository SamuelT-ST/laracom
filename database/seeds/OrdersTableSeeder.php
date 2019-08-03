<?php


use App\Shop\Orders\Order;
use Illuminate\Database\Seeder;

class OrdersTableSeeder extends Seeder
{
    public function run()
    {
        factory(Order::class)->create();
    }
}