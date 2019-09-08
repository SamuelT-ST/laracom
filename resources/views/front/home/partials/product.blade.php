@foreach($products as $product)

<div class="col-lg-3 col-md-6">
    <div class="single-new-collection-item"><!-- single new collections -->
        <div class="thumb">
            <img src="{{$product->getProductThumb()}}" alt="new collcetion image">
            <div class="hover">
                <a href="#" class="addtocart">{{ __('Add to cart') }}</a>
            </div>
        </div>
        <div class="content">
            @foreach($product->categories as $category)
            <span class="category">{{ $category->name }}</span>
            @endforeach
            <a href="#"><h4 class="title">{{ $product->name }}</h4></a>
            <div class="price"><span class="sprice">{{ $product->discounted_price ? $product->discounted_price : $product->price }}</span> @if($product->discounted_price)<del class="dprice">{{ $product->price }}</del>@endif</div>
        </div>
    </div><!-- //. single new collections  -->
</div>

@endforeach