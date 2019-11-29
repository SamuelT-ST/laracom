<?php

namespace App\Http\Controllers\Front;

use App\Services\CategoriesWithDiscount;
use App\Services\FilterService;
use App\Services\FrontListing;
use App\Shop\Categories\Category;
use App\Http\Controllers\Controller;
use App\Shop\Filters\Filter;
use App\Shop\Products\Requests\IndexProduct;

class CategoryController extends Controller
{

    public function getCategory(String $hierarchy, IndexProduct $request, FilterService $filterService)
    {
        $slugs = explode('/', $hierarchy);

        $category = Category::whereSlug(last($slugs))->first();

        // create and AdminListing instance for a specific model and
        $data = app(FrontListing::class)
            ->attachQuery(app(CategoriesWithDiscount::class)->getForCategory($category->id)->getBuilder())
            ->attachPagination($request->input('page', 1), $request->input('per_page', $request->cookie('per_page', 3)));

        if ($request->has('orderBy')){
            $data = $data->attachOrdering($request->get('orderBy'), $request->get('orderDirection'));
        }

        $availableFilters = Filter::whereHas('categories', function ($query) use ($category){
            $query->where('id', $category->id);
        })->get();

        $sanitized = $request->validated();

        if (!empty($sanitized['filters'])) {

            $decodedFilters =  json_decode($sanitized['filters']);
            $data = $data->modifyQuery(function($q) use ($category, $availableFilters, $decodedFilters, $filterService) {

                foreach ($decodedFilters as $filterId => $values){

                    if ($filterId === 'price'){
                        $filterService->filterPrice($q, $values);
                        continue;
                    }

                    $filter = Filter::find($filterId);

                    if ($filter->filter_type === Filter::CHECKBOX_STRING || $filter->filter_type === Filter::CHECKBOX_NUMBER){
                        foreach ($values as $value){

                            if ($filter->filter_type === Filter::CHECKBOX_STRING){
                                $q = $filterService->filterStringCheckbox($q, $filter, $value);
                            }

                            if ($filter->filter_type === Filter::CHECKBOX_NUMBER){
                                $q = $filterService->filterNumberCheckbox($q, $filter, $value);
                            }
                        }
                    }

                    if ($filter->filter_type === Filter::RANGE_NUMBER_INPUTS || $filter->filter_type === Filter::RANGE_NUMBER_DRAG){
                        $q = $filterService->filterRange($q, $filter, $values);
                    }

                }

            });
        }

        $data = $data->getResults();


        if ($request->ajax()) {
            return ['data' => $data];
        }

        $maxPrice = app(CategoriesWithDiscount::class)->getForCategory($category->id)->getMaxPrice();
        $minPrice = app(CategoriesWithDiscount::class)->getForCategory($category->id)->getMinPrice();

        return view('front.category.index', ['category' => $category, 'data' => $data, 'availableFilters' => $availableFilters, 'filterTemplate' => $this->getFilterTemplate($availableFilters, $minPrice, $maxPrice)]);
    }

    protected function getFilterTemplate($availableFilters, $minPrice, $maxPrice){

        return $availableFilters->mapWithKeys(function($filter){
            if ($filter->filter_type === Filter::RANGE_NUMBER_INPUTS) {
                return [$filter->id => []];
            } else if ($filter->filter_type === Filter::RANGE_NUMBER_DRAG) {
                return [$filter->id => [$filter->feature->minValue(), $filter->feature->maxValue()]];
            } else {
                return [$filter->id => []];
            }
        })->put('price', [(int) $minPrice, (int) $maxPrice]);

    }
}
