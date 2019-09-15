<?php

namespace App\Http\Controllers\Front;

use App\Services\CategoriesWithDiscount;
use App\Shop\Carts\Requests\AddToCartRequest;
use App\Shop\Carts\Repositories\Interfaces\CartRepositoryInterface;
use App\Shop\Couriers\Repositories\Interfaces\CourierRepositoryInterface;
use App\Shop\ProductAttributes\Repositories\ProductAttributeRepositoryInterface;
use App\Shop\Products\Product;
use App\Shop\Products\Repositories\Interfaces\ProductRepositoryInterface;
use App\Shop\Products\Repositories\ProductRepository;
use App\Shop\Products\Transformations\ProductTransformable;
use Gloudemans\Shoppingcart\CartItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CartController extends Controller
{
    use ProductTransformable;

    /**
     * @var CartRepositoryInterface
     */
    private $cartRepo;

    /**
     * @var ProductRepositoryInterface
     */
    private $productRepo;

    /**
     * @var CourierRepositoryInterface
     */
    private $courierRepo;

    /**
     * @var ProductAttributeRepositoryInterface
     */
    private $productAttributeRepo;

    /**
     * CartController constructor.
     * @param CartRepositoryInterface $cartRepository
     * @param ProductRepositoryInterface $productRepository
     * @param CourierRepositoryInterface $courierRepository
     * @param ProductAttributeRepositoryInterface $productAttributeRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository,
        ProductRepositoryInterface $productRepository,
        CourierRepositoryInterface $courierRepository,
        ProductAttributeRepositoryInterface $productAttributeRepository
    ) {
        $this->cartRepo = $cartRepository;
        $this->productRepo = $productRepository;
        $this->courierRepo = $courierRepository;
        $this->productAttributeRepo = $productAttributeRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return array|\Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()){
            return $this->cartRepo->getWholeCart();
        }

        return view('front.cart.index', $this->cartRepo->getWholeCart());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  AddToCartRequest $request
     * @return array|\Illuminate\Http\Response
     */
    public function store(AddToCartRequest $request)
    {

        $product = app(CategoriesWithDiscount::class)->getSingleProductById($request->input('product'));

        if ($product->attributes()->count() > 0) {
            $productAttr = $product->attributes()->where('default', 1)->first();

            if (!is_null($productAttr) && $productAttr->price !== 0 && isset($productAttr->sale_price)) {
                $product->price = $productAttr->price;

                if (!is_null($productAttr) && $productAttr->price !== 0 && !is_null($productAttr->sale_price)) {
                    $product->price = $productAttr->sale_price;
                }
            }
        }

        $options = [];
        if ($request->has('productAttribute') && $request->get('productAttribute') !== null) {

            $attr = $this->productAttributeRepo->findProductAttributeById($request->input('productAttribute'));

            $attr->price = is_null($attr->price) ? 0 : $attr->price;

            $product->price = $product->price + $attr->price;

            $options['product_attribute_id'] = $request->input('productAttribute');
            $options['combination'] = $attr->attributesValues->toArray();
        }

        $options['thumb_url'] = $product->getFirstMediaUrl('cover', 'thumb_200');

        $this->cartRepo->addToCart($product, $request->input('quantity'), $options);

        if ($request->ajax()){
            return $this->cartRepo->getWholeCart();
        }

        return redirect()->route('cart.index')
            ->with('message', 'Add to cart successful');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->cartRepo->updateQuantityInCart($id, $request->input('quantity'));

        request()->session()->flash('message', 'Update cart successful');
        return redirect()->route('cart.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @param Request $request
     * @return array
     */
    public function destroy(Request $request, $id)
    {
        $this->cartRepo->removeToCart($id);

        if ($request->ajax()){
            return $this->cartRepo->getWholeCart();
        }

        request()->session()->flash('message', 'Removed to cart successful');
        return redirect()->route('cart.index');
    }

    public function massUpdate(Request $request){
        collect($request->post('cartItems'))->each(function ($item, $index){
            $this->cartRepo->updateQuantityInCart($index, $item['qty']);
        });

        return $this->cartRepo->getWholeCart();
    }
}
