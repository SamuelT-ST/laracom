@extends('front.layout.master')

@section('body')

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra" >
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">{{ $post->title }}</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">{{ __('Domov') }}</a></li>
                                <li>{{ $post->title }}</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>

    <section class="privacy-page-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="privacy-inner-content"><!-- privacy inner conent -->
                         {!! $post->body !!}
                    </div><!-- //. privacy inner content -->
                </div>
            </div>
        </div>
    </section>

@endsection