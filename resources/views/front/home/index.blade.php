@extends('front.layout.master')

@section('body')

<div class="header-area-five header-bg-five" style="background-image: url({{ $settings['frontpage-banner']->getFirstMediaUrl('image') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="header-inner "><!-- header inner -->
                    {{--<span class="subtitle ">SPRING - SUMMER 2018</span>--}}
                    <h1 class="title ">{{ trans('home.banner1.title') }}</h1>
                    <p class="wow fadeInDown">{{ trans('home.banner1.value') }}</p>
                    <div class="btn-wrapper wow fadeInDown">
                        {!! trans('home.banner1.button') !!}
                    </div>
                </div><!-- //. header inner -->
            </div>
        </div>
    </div>
</div>
<!-- header area end -->

<!-- promotional area seven start -->
<div class="promotinal-area-seven">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="promotional-banner-area right"><!-- promotinal banner area  -->
                    <div class="img-wrapper">
                        <img src="{{ $settings['banner-1']->getFirstMediaUrl('image') }}" alt="promotional images">
                        <div class="hover">
                            <div class="hover-inner">
                                <span class="subtitle wow fadeInDown">{{ trans('home.banner2.title') }}</span>
                                <h2 class="title wow fadeIn">{{ trans('home.banner2.value') }}</h2>
                            </div>
                        </div>
                    </div>
                </div><!-- //.promotinal banner area  -->
            </div>
            <div class="col-lg-6">
                <div class="promotional-banner-area left"><!-- promotinal banner area  -->
                    <div class="img-wrapper">
                        <img src="{{ $settings['banner-2']->getFirstMediaUrl('image') }}" alt="promotional images">
                        <div class="hover">
                            <div class="hover-inner">
                                <h2 class="title ">{{ trans('home.banner3.title') }}</h2>
                                <div class="btn-wrapper wow fadeIn">
                                    {{--<a href="category.html" class="boxed-btn">go shop</a>--}}
                                    {!! trans('home.banner2.link') !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- //.promotinal banner area  -->
            </div>
        </div>
    </div>
</div>
<!-- promotional area seven end -->


<!-- filter area home four start -->
<div class="filter-ara-home-five">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="best-seller-two-filter-menu home-5">
                    <ul class="nav nav-tabs"  role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="bestseller-tab_2" data-toggle="tab" href="#bestseller_2" role="tab" aria-controls="bestseller_2" aria-selected="true">best sellers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="newflower-tab_2" data-toggle="tab" href="#newflower_2" role="tab" aria-controls="newflower_2" aria-selected="false">new flower</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topseller-tab_2" data-toggle="tab" href="#topseller_2" role="tab" aria-controls="topseller_2" aria-selected="false">top sellers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="specialflower-tab_2" data-toggle="tab" href="#specialflower_2" role="tab" aria-controls="specialflower_2" aria-selected="false">special flower</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-area-menu-home-masonry"><!-- filter area menu home masonry -->

                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="bestseller_2" role="tabpanel" aria-labelledby="bestseller-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => \App\Shop\Products\Repositories\ProductRepository::getProductsWithCalculatedDiscount(2, 15)])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="newflower_2" role="tabpanel" aria-labelledby="newflower-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => \App\Shop\Products\Repositories\ProductRepository::getProductsWithCalculatedDiscount(3, 15)])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="topseller_2" role="tabpanel" aria-labelledby="topseller-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => \App\Shop\Products\Repositories\ProductRepository::getProductsWithCalculatedDiscount(4, 15)])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="specialflower_2" role="tabpanel" aria-labelledby="specialflower-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => \App\Shop\Products\Repositories\ProductRepository::getProductsWithCalculatedDiscount(5, 15)])
                            </div>
                        </div>
                    </div>
                </div><!-- //.filter area menu home masonry -->
            </div>
        </div>
    </div>
</div>
<!-- filter area home four end -->

<!-- surprise area start -->
<div class="surprise-area light-bg">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="surprise-inner"><!-- surprise inner -->
                    <div class="video-thumb">
                        <img src="assets/img/surprise-image.jpg" alt="surprise image">
                        <div class="hover">
                            <a href="https://www.youtube.com/watch?v=ivbq60GlBWs" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                    <div class="content-area">
                        <div class="heart"><i class="fas fa-heart"></i></div>
                        <h3 class="title">Suprise Your Valentine! Let Us Arrange A Smile</h3>
                    </div>
                </div><!-- //.surprise inner -->
            </div>
        </div>
    </div>
</div>
<!-- surprise area end -->
<!-- filter area home four start -->
<div class="filter-ara-home-five-two">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="best-seller-two-filter-menu home-5">
                    <ul class="nav nav-tabs"  role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="bestseller-tab_3" data-toggle="tab" href="#bestseller_3" role="tab" aria-controls="bestseller_3" aria-selected="true">best sellers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="newflower-tab_3" data-toggle="tab" href="#newflower_3" role="tab" aria-controls="newflower_3" aria-selected="false">new flower</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topseller-tab_3" data-toggle="tab" href="#topseller_3" role="tab" aria-controls="topseller_3" aria-selected="false">top sellers</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="specialflower-tab_3" data-toggle="tab" href="#specialflower_3" role="tab" aria-controls="specialflower_3" aria-selected="false">special flower</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="filter-area-menu-home-masonry-six"><!-- filter area menu home masonry -->
                    <div class="tab-content">
                        <div class="tab-pane fade show active" id="bestseller_3" role="tabpanel" aria-labelledby="bestseller-tab_3">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/01.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">Sportswear</span>
                                            <a href="#"><h4 class="title">Black Tshirt Brock</h4></a>
                                            <div class="price"><span class="sprice">$23.00</span> <del class="dprice">$55.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/02.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Footwear Dark</h4></a>
                                            <div class="price"><span class="sprice">$50.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/03.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">accesories</span>
                                            <a href="#"><h4 class="title">Milo Hoverboard</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$99.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/04.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Lobina Perak Shoe</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$120.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/05.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">hat</span>
                                            <a href="#"><h4 class="title">Red Yello Hat</h4></a>
                                            <div class="price"><span class="sprice">$10.00</span> <del class="dprice">$50.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/06.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">cycle</span>
                                            <a href="#"><h4 class="title">Minimal Cycle</h4></a>
                                            <div class="price"><span class="sprice">$700.00</span> <del class="dprice">$1500.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/07.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">bike</span>
                                            <a href="#"><h4 class="title">Dart Moto Bike</h4></a>
                                            <div class="price"><span class="sprice">$90.00</span> <del class="dprice">$1200.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/08.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">electric</span>
                                            <a href="#"><h4 class="title">Minimal Screw</h4></a>
                                            <div class="price"><span class="sprice">$37.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="newflower_3" role="tabpanel" aria-labelledby="newflower-tab_3">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/01.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">Sportswear</span>
                                            <a href="#"><h4 class="title">Black Tshirt Brock</h4></a>
                                            <div class="price"><span class="sprice">$23.00</span> <del class="dprice">$55.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/02.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Footwear Dark</h4></a>
                                            <div class="price"><span class="sprice">$50.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/03.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">accesories</span>
                                            <a href="#"><h4 class="title">Milo Hoverboard</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$99.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/04.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Lobina Perak Shoe</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$120.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/05.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">hat</span>
                                            <a href="#"><h4 class="title">Red Yello Hat</h4></a>
                                            <div class="price"><span class="sprice">$10.00</span> <del class="dprice">$50.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/06.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">cycle</span>
                                            <a href="#"><h4 class="title">Minimal Cycle</h4></a>
                                            <div class="price"><span class="sprice">$700.00</span> <del class="dprice">$1500.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/07.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">bike</span>
                                            <a href="#"><h4 class="title">Dart Moto Bike</h4></a>
                                            <div class="price"><span class="sprice">$90.00</span> <del class="dprice">$1200.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/08.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">electric</span>
                                            <a href="#"><h4 class="title">Minimal Screw</h4></a>
                                            <div class="price"><span class="sprice">$37.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="topseller_3" role="tabpanel" aria-labelledby="topseller-tab_3">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/01.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">Sportswear</span>
                                            <a href="#"><h4 class="title">Black Tshirt Brock</h4></a>
                                            <div class="price"><span class="sprice">$23.00</span> <del class="dprice">$55.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/02.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Footwear Dark</h4></a>
                                            <div class="price"><span class="sprice">$50.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/03.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">accesories</span>
                                            <a href="#"><h4 class="title">Milo Hoverboard</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$99.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/04.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Lobina Perak Shoe</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$120.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/05.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">hat</span>
                                            <a href="#"><h4 class="title">Red Yello Hat</h4></a>
                                            <div class="price"><span class="sprice">$10.00</span> <del class="dprice">$50.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/06.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">cycle</span>
                                            <a href="#"><h4 class="title">Minimal Cycle</h4></a>
                                            <div class="price"><span class="sprice">$700.00</span> <del class="dprice">$1500.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/07.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">bike</span>
                                            <a href="#"><h4 class="title">Dart Moto Bike</h4></a>
                                            <div class="price"><span class="sprice">$90.00</span> <del class="dprice">$1200.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/08.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">electric</span>
                                            <a href="#"><h4 class="title">Minimal Screw</h4></a>
                                            <div class="price"><span class="sprice">$37.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                            </div>
                        </div>
                        <div class="tab-pane fade" id="specialflower_3" role="tabpanel" aria-labelledby="specialflower-tab_3">
                            <div class="row">
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/01.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">Sportswear</span>
                                            <a href="#"><h4 class="title">Black Tshirt Brock</h4></a>
                                            <div class="price"><span class="sprice">$23.00</span> <del class="dprice">$55.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/02.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Footwear Dark</h4></a>
                                            <div class="price"><span class="sprice">$50.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/03.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">accesories</span>
                                            <a href="#"><h4 class="title">Milo Hoverboard</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$99.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/04.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">shoe</span>
                                            <a href="#"><h4 class="title">Lobina Perak Shoe</h4></a>
                                            <div class="price"><span class="sprice">$78.00</span> <del class="dprice">$120.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/05.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">hat</span>
                                            <a href="#"><h4 class="title">Red Yello Hat</h4></a>
                                            <div class="price"><span class="sprice">$10.00</span> <del class="dprice">$50.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/06.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">cycle</span>
                                            <a href="#"><h4 class="title">Minimal Cycle</h4></a>
                                            <div class="price"><span class="sprice">$700.00</span> <del class="dprice">$1500.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/07.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">bike</span>
                                            <a href="#"><h4 class="title">Dart Moto Bike</h4></a>
                                            <div class="price"><span class="sprice">$90.00</span> <del class="dprice">$1200.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                                <div class="col-lg-3 col-md-6">
                                    <div class="single-new-collection-item"><!-- single new collections -->
                                        <div class="thumb">
                                            <img src="assets/img/flower/08.jpg" alt="new collcetion image">
                                            <div class="hover">
                                                <a href="#" class="addtocart">Add To Cart</a>
                                            </div>
                                        </div>
                                        <div class="content">
                                            <span class="category">electric</span>
                                            <a href="#"><h4 class="title">Minimal Screw</h4></a>
                                            <div class="price"><span class="sprice">$37.00</span> <del class="dprice">$80.00</del></div>
                                        </div>
                                    </div><!-- //. single new collections  -->
                                </div>
                            </div>
                        </div>
                    </div>
                </div><!-- //.filter area menu home masonry -->
            </div>
        </div>
    </div>
</div>
<!-- filter area home four end -->

<!-- banner area home 5 start  -->
<div class="banner-area-home-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-image"><!-- banner image -->
                    <img src="assets/img/banner-add/02-big.jpg" alt="banner image">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-image"><!-- //.banner image -->
                    <img src="assets/img/banner-add/02-bg.jpg" alt="banner image">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner area home 5 end  -->

@endsection