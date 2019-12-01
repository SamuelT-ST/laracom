<?php
/**
 * Created by PhpStorm.
 * User: samueltrstensky
 * Date: 2019-07-28
 * Time: 20:38
 */

namespace App\Shop\OrderProduct\Repositories;


use App\Shop\OrderProduct\OrderProduct;
use App\Shop\Orders\Order;
use App\Shop\ProductAttributes\ProductAttribute;
use App\Shop\Products\Product;

class OrderProductRepository
{

    public function createOrderProduct(array $products, Order $order) : void {

//        dd($products);

        collect($products)->each(function ($product) use ($order){
            $orderProduct = OrderProduct::create([
                'order_id' => $order->id,
                'product_id' => $product['id'],
                'quantity' => $product['chosenQuantity'],
                'product_name' => $product['name'],
                'product_sku' => $product['sku'],
                'product_description' => $product['description'],
                'product_price' => $product['price'],
                'product_discount' => $product['chosenDiscount']
            ]);

            $orderedProduct = Product::find($product['id']);
            $orderedProduct->quantity -= $product['chosenQuantity'];
            $orderedProduct->save();

            $attributes = collect($product['chosenAttributes'])->mapWithKeys(function ($attribute) use ($product){

                $changedPrice = $attribute['price'];
                $changedDiscount = $attribute['chosenDiscount'];

                $attribute = ProductAttribute::find($attribute['id']);
                $attribute->quantity -= $product['chosenQuantity'];
                $attribute->save();

                return [$attribute['id'] => [
                    'price' => (int) $changedPrice,
                    'discount' => (int) $changedDiscount
                    ]
                ];
            });

            $orderProduct->productAttributes()->sync($attributes);
        });
    }

    public function updateOrderProduct(array $products, Order $order) : void {

        $order->orderProduct()->each(function ($orderProduct){
            $orderedProduct = Product::find($orderProduct['product_id']);
            $orderedProduct->quantity += $orderProduct['quantity'];
            $orderedProduct->save();

            collect($orderProduct->productAttributes)->each(function($productAttribute) use ($orderProduct){
                $productAttribute->quantity += $orderProduct['quantity'];
                $productAttribute->save();
            });

            $orderProduct->productAttributes()->sync([]);
        });

        $order->orderProduct()->delete();

        $this->createOrderProduct($products, $order);
    }

}