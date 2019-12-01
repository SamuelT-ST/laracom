<?php

namespace App\Shop\Features\Transformations;


use App\Shop\Products\Product;
use Illuminate\Support\Collection;

class FeatureValueTransformable
{
    public function prepareFeaturesForEdit(Product $product) : Collection{

        return collect($product->featureValues()->with('feature', 'feature.featureValues')->get())->map(function($featureValue){
            return [
                'availableValues' => $featureValue->feature->featureValues,
                'chosenValue' => $featureValue,
                'feature' => $featureValue->feature
            ];
        });

    }

}