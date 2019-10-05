@extends('front.layout.master')

@section('body')

<div class="header-area-five header-bg-five" style="background-image: url({{ $settings['frontpage-banner']->getFirstMediaUrl('image') }})">
    <div class="container">
        <div class="row">
            <div class="col-lg-7">
                <div class="header-inner "><!-- header inner -->
                    <span class="subtitle ">{{ trans('home.frontpage-banner.subtitle') }}</span>
                    <h1 class="title ">{{ trans('home.frontpage-banner.title') }}</h1>
                    <p class="wow fadeInDown">{{ trans('home.frontpage-banner.value') }}</p>
                    <div class="btn-wrapper wow fadeInDown">
                        <a href="{{ trans('home.frontpage-banner.button_url') }}" class="boxed-btn">{{ trans('home.banner1.button_text') }}</a>
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
                                <span class="subtitle wow fadeInDown">{{ trans('home.banner-1.title') }}</span>
                                <h2 class="title wow fadeIn">{{ trans('home.banner-1.value') }}</h2>
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
                                <h2 class="title ">{{ trans('home.banner-2.title') }}</h2>
                                <div class="btn-wrapper wow fadeIn">
                                    <a href="{{ trans('home.banner-2.button_url') }}" class="boxed-btn">{{ trans('home.banner-2.button_text') }}</a>
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
                            <a class="nav-link active" id="bestseller-tab_2" data-toggle="tab" href="#bestseller_2" role="tab" aria-controls="bestseller_2" aria-selected="true">{{ __('Najpredávanejšie') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="newflower-tab_2" data-toggle="tab" href="#newflower_2" role="tab" aria-controls="newflower_2" aria-selected="false">{{ __('Novinky') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="topseller-tab_2" data-toggle="tab" href="#topseller_2" role="tab" aria-controls="topseller_2" aria-selected="false">{{ __('Výpredaj') }}</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="specialflower-tab_2" data-toggle="tab" href="#specialflower_2" role="tab" aria-controls="specialflower_2" aria-selected="false">{{ __('Špeciálne') }}</a>
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
                                @include('front.home.partials.product', ['products' => app(\App\Services\CategoriesWithDiscount::class)->getForCategory(trans('home.category.bestsellers'))->getProducts(15)])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="newflower_2" role="tabpanel" aria-labelledby="newflower-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => app(\App\Services\CategoriesWithDiscount::class)->getForCategory(trans('home.category.new'))->getProducts(15)])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="topseller_2" role="tabpanel" aria-labelledby="topseller-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => app(\App\Services\CategoriesWithDiscount::class)->getForCategory(trans('home.category.discount'))->getProducts(15)])
                            </div>
                        </div>
                        <div class="tab-pane fade" id="specialflower_2" role="tabpanel" aria-labelledby="specialflower-tab_2">
                            <div class="row">
                                @include('front.home.partials.product', ['products' => app(\App\Services\CategoriesWithDiscount::class)->getForCategory(trans('home.category.special'))->getProducts(15)])
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
                        <img src="{{ $settings['video-preview']->getFirstMediaUrl('image') }}" alt="{{ $settings['video-preview']['value'] }}">
                        <div class="hover">
                            <a href="{{ $settings['video-preview']['value'] }}" class="video-play-btn mfp-iframe"><i class="fas fa-play"></i></a>
                        </div>
                    </div>
                    <div class="content-area">
                        <div class="heart"><i class="fas fa-lightbulb"></i></div>
                        <h3 class="title">{{ __('Potešte svoju polovičku kvalitným svetlom!') }}</h3>
                    </div>
                </div><!-- //.surprise inner -->
            </div>
        </div>
    </div>
</div>
<!-- surprise area end -->
<!-- filter area home four start -->
<!-- filter area home four end -->

<!-- banner area home 5 start  -->
<div class="banner-area-home-5">
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="banner-image"><!-- banner image -->
                    <img src="{{ $settings['bottom-banner-1']->getFirstMediaUrl('image') }}" alt="{{ $settings['bottom-banner-1']['value'] }}">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="banner-image"><!-- //.banner image -->
                    <img src="{{ $settings['bottom-banner-2']->getFirstMediaUrl('image') }}" alt="{{ $settings['bottom-banner-2']['value'] }}">
                </div>
            </div>
        </div>
    </div>
</div>
<!-- banner area home 5 end  -->

@endsection