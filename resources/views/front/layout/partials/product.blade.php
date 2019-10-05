<div class="single-new-collection-item">
    <div class="thumb">
        <img src="{{$product->getProductThumb()}}" alt="product image">
        <product-detail-form :tax-rate="{{ \App\Shop\Products\Product::TAX_RATE }}" @updated-cart="updateCart" :product="{{ $product }}" :url="'{{ route('cart.store') }}'" inline-template>
            <div class="hover">
                <a href="#" class="addtocart" @click.prevent="addToCart">{{ __('Do košíka') }}</a>
            </div>
        </product-detail-form>
    </div>
    <div class="content">
        @foreach($product->categories as $category)
            <span class="category">{{ $category->name }}</span>
        @endforeach
        <a href="{{ $product->front_url }}"><h4 class="title">{{ $product->name }}</h4></a>

        <div class="price">
            <span class="sprice">{{ $product->discounted_price ? $product->discounted_price : $product->price }} {{ \App\Shop\Products\Product::CURRENCY }}</span>
            @if($product->discounted_price)<del class="dprice">{{ $product->price }} {{ \App\Shop\Products\Product::CURRENCY }}</del>@endif
        </div>
    </div>
</div>