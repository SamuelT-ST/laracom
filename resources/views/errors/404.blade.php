@extends('front.layout.master')

@section('body')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">{{ __('404 - stránka neexistuje') }}</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">Home</a></li>
                                <li>404</li>
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
                            <img src="{{ asset('images/404-error.png') }}" alt="404 error page">
                        </div>
                    </div><!-- //. left content area -->
                </div>
                <div class="col-lg-6">
                    <div class="right-content-area"><!-- right content area -->
                        <h3 class="title">404</h3>
                        <span class="details">{{ __('Hups... Táto stránka neexistuje...') }}</span>
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