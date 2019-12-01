<?php
/**
 * Created by PhpStorm.
 * User: samueltrstensky
 * Date: 2019-08-04
 * Time: 12:26
 */

namespace App\Shop\OrderProduct\Transformations;


use App\Shop\OrderProduct\OrderProduct;
use App\Shop\Orders\Order;
use App\Shop\ProductAttributes\ProductAttribute;

class OrderProductTransformation
{

    public function prepareOrderForUpdate(Order $order){

        return $order->orderProduct()->get()->map(function (OrderProduct $product){
            return [
                'orderProductId' => $product['id'],
                'id'=>$product['product_id'],
                'sku'=>$product['product_sku'],
                'description'=>$product['product_description'],
                'chosenQuantity' => $product['quantity'],
                'chosenDiscount' => $product['product_discount'],
                'name' => $product['product_name'],
                'price' => $product['product_price'],
                'attributes' => $product->product()->first()->attributes()->with('attributesValues', 'attributesValues.attribute')->get(),
                'chosenAttributes' =>
                    $product->productAttributes()->get()->map(function (ProductAttribute $productAttribute){
                       return [
                           'attributes_values' => $productAttribute->attributesValues()->with('attribute')->get(),
                           'chosenDiscount' => $productAttribute->pivot['discount'],
                           'default'=>$productAttribute['default'],
                           'price'=>$productAttribute->pivot['price'],
                           'id'=>$productAttribute['id'],
                           'product_id'=>$productAttribute['product_id'],
                           'quantity'=>$productAttribute['quantity'],
                       ];
                    })
            ];
        });


    }

}