<?php

namespace App\Http\Controllers\Admin\Features;


use App\Shop\Features\Feature;
use App\Shop\Features\Requests\CreateFeatureRequest;
use App\Shop\Features\Requests\CreateValueRequest;
use App\Http\Controllers\Controller;

class FeaturesController extends Controller
{
    public function create(CreateFeatureRequest $request){

        $sanitized = $request->validated();

        return Feature::create($sanitized);
    }

    public function loadFeatureValues(Feature $feature){
        return $feature->featureValues;
    }

    public function createValue(CreateValueRequest $request){

        $sanitized = $request->validated();

        $feature = Feature::find($sanitized['featureId']);

        $value = $feature->is_number ? 'value_integer' : 'value_string';

        $createdValue = $feature->featureValues()->create([$value => $sanitized['value']]);

        return [
            'id' => $createdValue->id,
            'value' => $createdValue->$value
        ];
    }
}
