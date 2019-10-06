@extends('front.layout.master')

@section('body')

<section class="breadcrumb-area breadcrumb-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                    <div class="left-content-area"><!-- left content area -->
                        <h1 class="title">{{ __('Detaily produktu') }}</h1>
                    </div><!-- //. left content area -->
                    <div class="right-content-area">
                        <ul>
                            <li><a href="/">{{ __('Domov') }}</a></li>
                            @foreach(collect($productGroup->categories)->reverse() as $categoryPath)
                                <li><a href="{{$categoryPath->front_url}}">{{ $categoryPath->name }}</a></li>
                            @endforeach
                            <li>{{ $productGroup->name }}</li>
                        </ul>
                    </div>
                </div><!-- //. breadcrumb inner -->
            </div>
        </div>
    </div>
</section>
<!-- breadcrumb area end -->

<product-group
        inline-template
        @updated-cart="updateCart"
        :url="'{{ route('store-group') }}'"
        :available-products="{{ $products }}">

    <!-- product details content area  start -->
    <div class="product-details-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area"><!-- left content area -->
                        <div class="product-details-slider" id="product-details-slider" data-slider-id="1">
                            @if($productGroup->getFirstMediaUrl('cover'))
                            <div class="single-product-thumb">
                                <img src="{{ $productGroup->getFirstMediaUrl('cover', 'product_detail') }}" alt="product details image">
                            </div>
                            @endif
                            @foreach($productGroup->getMedia('images') as $media)
                            <div class="single-product-thumb">
                                <img src="{{ $media->getUrl('product_detail') }}" alt="product details image">
                            </div>
                            @endforeach
                        </div>
                        <ul class="owl-thumbs product-deails-thumb" data-slider-id="1">
                            @if($productGroup->getFirstMediaUrl('cover'))
                            <li class="owl-thumb-item">
                                <img src="{{ $productGroup->getFirstMediaUrl('cover', 'product_detail_thumb') }}" alt="product details thumb">
                            </li>
                            @endif
                            @foreach($productGroup->getMedia('images') as $media)
                            <li class="owl-thumb-item">
                                <img src="{{ $media->getUrl('product_detail_thumb') }}" alt="product details thumb">
                            </li>
                            @endforeach
                        </ul>
                    </div><!-- //.left content area -->
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area"><!-- right content area -->
                        {{--<div class="top-content">--}}
                            {{--<ul class="review">--}}
                                {{--<li><i class="fas fa-star"></i></li>--}}
                                {{--<li><i class="fas fa-star"></i></li>--}}
                                {{--<li><i class="fas fa-star"></i></li>--}}
                                {{--<li><i class="fas fa-star-half-alt"></i></li>--}}
                                {{--<li><i class="far fa-star"></i></li>--}}
                                {{--<li class="reviewes">23 <small>reviews</small> </li>--}}
                            {{--</ul>--}}
                            {{--<span class="orders">Orders (200+)</span>--}}
                        {{--</div>--}}
                        {{--{{ dd($product) }}--}}
                        <div class="bottom-content">
                            @foreach($productGroup->categories as $category)
                            <span class="cat">{{ $category->name }}</span>
                            @endforeach
                            <h3 class="title">{{ $productGroup->name }}</h3>

                            <div class="price-area">
                                <div class="left">
                                    <span class="sprice">@{{ calculatedPrice }} {{ \App\Shop\Products\Product::CURRENCY }}</span>

                                    <span v-if="atLeastOneDiscount" class="dprice"><del>@{{ calculatedOldPrice }} {{ \App\Shop\Products\Product::CURRENCY }}</del></span>
                                </div>
                                {{--<div class="right">--}}
                                {{--<a href="#" class="size">size chart</a>--}}
                                {{--</div>--}}
                            </div>

                            <div class="pdescription">
                                <h4 class="title">{{ __('Popis') }}</h4>
                                <p>{!! $productGroup->description !!}</p>
                                <div class="mt-4">
                                    <h4 class="title">{{ __('Dĺžka v m') }}</h4>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" type="number" v-model="size" />
                                </div>

                            </div>
                            <div class="paction">
                                <div class="qty">
                                    <ul>
                                        <li><span class="qtminus" @click="quantity--"><i class="fas fa-minus"></i></span></li>
                                        <li><span class="qttotal">@{{ quantity }}</span></li>
                                        <li><span class="qtplus" @click="quantity++"><i class="fas fa-plus"></i></span></li>
                                    </ul>
                                </div>
                                <ul class="activities">
                                    <li><a href="#"><i class="fas fa-heart"></i></a></li>
                                    <li><a href="#"><i class="fas fa-hourglass"></i></a></li>
                                    <li><a href="#"><i class="fas fa-share-square"></i></a></li>
                                </ul>
                                <div class="btn-wrapper">
                                    <a href="#" class="boxed-btn addtocart" data-product-id="{{ $productGroup->id }}" @click="addToCart">{{ __('Do košíka') }}</a>
                                </div>
                            </div>
                        </div>
                    </div><!-- //. right content area -->
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="product-details-area">
                        <div class="product-details-tab-nav">
                            <ul class="nav nav-tabs" role="tablist">
                                <li class="nav-item">
                                    <a class="nav-link active" id="item-review-tab" data-toggle="tab" href="#item_review" role="tab" aria-controls="item_review" aria-selected="true">{{ __('Produkty v balíku') }}</a>
                                </li>
                                {{--<li class="nav-item">--}}
                                    {{--<a class="nav-link" id="descr-tab" data-toggle="tab" href="#descr" role="tab" aria-controls="descr" aria-selected="false">{{ __('Popis') }}</a>--}}
                                {{--</li>--}}
                                {{--<li class="nav-item">--}}
                                {{--<a class="nav-link" id="method-tab" data-toggle="tab" href="#method" role="tab" aria-controls="method" aria-selected="false">Features</a>--}}
                                {{--</li>--}}
                            </ul>
                        </div>
                        <div class="tab-content">
                            <div class="tab-pane fade show active" id="item_review" role="tabpanel" aria-labelledby="item-review-tab">
                                <div class="item_review_content">
                                    <h4 class="title">{{ __('Produkty v balíku') }}</h4>
                                        @include('front.product-group.partials.product-group')
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</product-group>
<!-- product details content area end -->
<!-- recently added start -->
@include('front.layout.partials.recently-added', ['categoryId' => $productGroup->categories()->first()->id])
<!-- recently added end -->

@endsection

{{--@section('bottom-scripts')--}}
    {{--<script>--}}
        {{--$('.addtocart').on('click', function(){--}}
            {{--$.ajax({--}}
                {{--method: "POST",--}}
                {{--url: "/cart",--}}
                {{--data: {--}}
                    {{--product: $('.addtocart').data('product-id'),--}}
                    {{--quantity: $('.qttotal').text(),--}}
                    {{--productAttribute: $('.attribute-select').val(),--}}
                    {{--_token: "{{ csrf_token() }}",--}}
                {{--}--}}
            {{--}).done(() => {--}}
                {{--console.log('addedToCart');--}}
            {{--}).fail((response) => {--}}
                {{--console.log('fail');--}}
                {{--});--}}
            {{--});--}}
    {{--</script>--}}
{{--@endsection--}}