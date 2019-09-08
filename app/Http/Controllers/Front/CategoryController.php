<?php

namespace App\Http\Controllers\Front;

use App\Services\CategoriesWithDiscount;
use App\Services\FrontListing;
use App\Shop\Categories\Category;
use App\Http\Controllers\Controller;
use App\Shop\Products\Requests\IndexProduct;

class CategoryController extends Controller
{

    public function getCategory(String $slug, IndexProduct $request)
    {
        $category = Category::whereSlug($slug)->first();

        // create and AdminListing instance for a specific model and
        $data = app(FrontListing::class)
            ->attachQuery(app(CategoriesWithDiscount::class)->getForCategory($category->id)->getBuilder())
            ->attachPagination($request->input('page', 1), $request->input('per_page', $request->cookie('per_page', 3)))
            ->getResults();

        if ($request->ajax()) {
            return ['data' => $data];
        }

        return view('front.category.index', ['category' => Category::whereSlug($slug)->first(), 'data' => $data]);
    }
}
