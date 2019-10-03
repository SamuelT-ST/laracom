<div class="recently-added-area product-details">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="recently-added-nav-menu"><!-- recently added nav menu -->
                    <ul>
                        <li>{{ __('Produkty z rovnakej kategórie') }}</li>
                    </ul>
                </div><!-- //.recently added nav menu -->
            </div>
            <div class="col-lg-12">
                <div class="recently-added-carousel" id="recently-added-carousel"><!-- recently added carousel -->
                @foreach(app(\App\Services\CategoriesWithDiscount::class)->getForCategory($categoryId)->getProducts() as $product)
                    @include('front.layout.partials.product', ['product' => $product])
                @endforeach
                </div><!-- //. recently added carousel -->
            </div>
        </div>
    </div>
</div>