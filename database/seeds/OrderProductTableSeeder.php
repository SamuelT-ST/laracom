<?php

use App\Shop\Orders\Order;
use App\Shop\Products\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

/**
 * Created by PhpStorm.
 * User: samueltrstensky
 * Date: 2019-07-26
 * Time: 23:37
 */

class OrderProductTableSeeder extends Seeder
{

    public function run(){

        $order = Order::first();
        $product = Product::first();

        DB::table('order_product')->insert([
            'order_id' => $order->id,
            'product_id' => $product->id,
            'quantity' => 1,
            'product_name' => $product->name,
            'product_sku' => $product->sku,
            'product_description' => $product->description,
            'product_price' => $product->price * 10,
            'product_discount' => 10,
            'size' => 10
        ]);
    }

}