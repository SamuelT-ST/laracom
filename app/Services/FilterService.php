<?php

namespace App\Services;
use App\Shop\Filters\Filter;
use Illuminate\Database\Eloquent\Builder;


class FilterService
{

    public function filterStringCheckbox(Builder $q, Filter $filter, string $value) : Builder{
        return $q->whereHas('featureValues', function (Builder $query) use ($filter, $value){
            $query->whereHas('feature', function (Builder $query) use ($filter){
                $query->where('id', $filter->feature_id);
            })->where('value_string', $value);
        });
    }

    public function filterNumberCheckbox(Builder $q, Filter $filter, int $value) : Builder{
        return $q->whereHas('featureValues', function (Builder $query) use ($filter, $value){
            $query->whereHas('feature', function (Builder $query) use ($filter){
                $query->where('id', $filter->feature_id);
            })->where('value_integer', $value);
        });
    }

    public function filterRange(Builder $q, Filter $filter, array $values) : Builder{
        return $q->whereHas('featureValues', function (Builder $query) use ($filter, $values){
            $query->whereHas('feature', function (Builder $query) use ($filter){
                $query->where('id', $filter->feature_id);
            })->whereBetween('value_integer', [$values[0], $values[1]]);
        });
    }

    public function filterPrice(Builder $q, array $values){
        return $q->where(function(Builder $q) use ($values) {
                    $q->where('products.price', '>=', $values[0])
                    ->orHaving('products.price', '>=', $values[0]);
                })
                ->where('products.price', '<=', $values[1]);
    }

}