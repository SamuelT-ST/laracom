<?php

namespace App\Http\Controllers\Front;

use App\Services\CategoriesWithDiscount;
use App\Shop\ProductGroups\ProductGroup;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Http\Controllers\Controller;
use App\Shop\Products\Transformations\ProductTransformable;

class ProductController extends Controller
{
    use ProductTransformable;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * ProductController constructor.
     * @param ProductRepositoryInterface $productRepository
     */
    public function __construct(ProductRepositoryInterface $productRepository)
    {
        $this->productRepo = $productRepository;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search()
    {
        if (request()->has('q') && request()->input('q') != '') {
            $list = $this->productRepo->searchProduct(request()->input('q'));
        } else {
            $list = $this->productRepo->listProducts();
        }

        $products = $list->where('status', 1)->map(function (Product $item) {
            return $this->transformProduct($item);
        });

        return view('front.products.product-search', [
            'products' => $this->productRepo->paginateArrayResults($products->all(), 10)
        ]);
    }

    /**
     * Get the product
     *
     * @param string $slug
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show(string $slug)
    {
        $product = app(CategoriesWithDiscount::class)->getSingleProductBySlug($slug);
        $productAttributes = $product->attributes;

//        dd($product->toArray());


        return view('front.product-detail.index', compact(
            'product',
            'productAttributes',
            'defaultAttribute'
        ));
    }

    public function showProductGroup(string $slug){

        $productGroup = ProductGroup::with('categories', 'products')->where('slug', $slug)->first();

        $products = $productGroup->products->map(function ($product){
            return collect(app(CategoriesWithDiscount::class)->getSingleProductById($product->id))->put('pivot', $product->pivot);
        });

        return view('front.product-group.index', compact(
            'productGroup',
            'products'
        ));
    }
}
