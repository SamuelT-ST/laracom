@extends('front.layout.master')

@section('body')

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">{{ __('Reset hesla') }}</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">{{ __('Domov') }}</a></li>
                                <li>{{ __('Reset hesla') }}</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- login page content area start -->
    <div class="login-page-content-area one-column">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 offset-lg-3">
                    <div class="signup-page-wrapper mb-5"><!-- login page wrapper -->
                        <div class="row">
                            <div class="col-lg-12">
                                @if(session()->has('status'))
                                    <div class="mt-3 mx-4 alert alert-success">
                                        {{ session()->get('status') }}
                                    </div>
                                @endif
                                <div class="right-contnet-area">
                                    <div class="top-content">
                                        <h4 class="title">{{ __('Reset hesla') }}</h4>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>--}}
                                    </div>
                                    <div class="bottom-content">
                                        <form action="{{ route('password.email') }}" method="post" class="login-form">
                                            {{ csrf_field() }}
                                            <div class="form-element">
                                                <input type="email" name="email" class="input-field" placeholder="{{ __('Email') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                            <strong>{{ $errors->first('email') }}</strong>
                                                    </span>
                                                @endif
                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="submit-btn">{{ __('Resetovať') }}</button>
                                                <a href="/login" class="link">{{ __('Prihlásiť sa') }}</a><br>
                                                <a href="{{ __('/register') }}" class="link">{{ __('Nemáte účet?') }}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div><!-- //.login page wrapper -->
                </div>
            </div>
        </div>
    </div>

    <!-- login page content area end -->
@endsection
