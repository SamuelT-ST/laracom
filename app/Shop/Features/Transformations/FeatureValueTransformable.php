<?php
/**
 * Created by PhpStorm.
 * User: samueltrstensky
 * Date: 2019-08-07
 * Time: 00:17
 */

namespace App\Shop\Features\Transformations;


use App\Shop\Products\Product;
use Illuminate\Support\Collection;

class FeatureValueTransformable
{
//featureValues:Array[1]
//  0:Object
//      availableValues:Array[7]
//      chosenValue:Object
//      feature:Object


    public function prepareFeaturesForEdit(Product $product) : Collection{

        return collect($product->featureValues()->with('feature', 'feature.featureValues')->get())->map(function($featureValue){
            return [
                'availableValues' => $featureValue->feature->first()->featureValues,
                'chosenValue' => $featureValue,
                'feature' => $featureValue->feature->first()
            ];
        });

    }

}