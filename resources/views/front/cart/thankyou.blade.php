@extends('front.layout.master')

@section('body')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">{{ __('Ďakujeme za Vašu objednávku') }}</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>{{ __('Ďakujeme za Vašu objednávku') }}</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>

    <!-- error 404 page content area start -->
    <div class="error-404-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="left-content-area"><!-- left content area -->
                        <div class="img-wrapper">
                            <img style="border: 0;" src="{{ asset('images/happy.png') }}" alt="Thank you">
                        </div>
                    </div><!-- //. left content area -->
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area"><!-- right content area -->
                        <span class="details">{{ __('Ďakujeme za Vašu objednávku') }}</span>
                        <p>
                            {{ __('Vaša objednávka') }} #{{ $order->id }} {{ __('v hodnote ') }} {{ $order->total }} {{ \App\Shop\Products\Product::CURRENCY }} {{ __('sa spracováva. O jej vybavení Vás budeme kontaktovať emailom.') }}
                        </p>
                        <div class="btn-wrapper">
                            <a href="/" class="boxed-btn">{{ __('Späť domov') }}</a>
                        </div>
                    </div><!-- //. right content area -->
                </div>
            </div>
        </div>
    </div>
    <!-- error 404 page content area end -->

@endsection