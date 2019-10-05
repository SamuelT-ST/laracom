@extends('front.layout.master')

@section('body')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">{{ __('Registrácia') }}</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">{{ __('Domov') }}</a></li>
                                <li>{{ __('Registrácia') }}</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>
    <!-- breadcrumb area end -->

    <!-- login page content area start -->
    <div class="login-page-content-area">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="signup-page-wrapper"><!-- login page wrapper -->
                        <div class="or">
                            <span>alebo</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-6 padding-right-0">
                                <div class="right-contnet-area">
                                    <div class="top-content">
                                        <h4 class="title">{{ __('Prihláste sa pomocou inej siete') }}</h4>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>--}}
                                    </div>
                                    <div class="bottom-content">
                                        <form class="login-form">
                                            <div class="block-link">
                                                <a href="#" class="facebook">{{ __('Prihlásenie cez Facebook') }}</a>
                                                <a href="#" class="google">{{ __('Prihlásenie cez Google') }}</a>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-contnet-area">
                                    <div class="top-content">
                                        <h4 class="title">{{ __('Alebo sa zaregistrujte') }}</h4>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>--}}
                                    </div>
                                    <div class="bottom-content">
                                        <form class="form-horizontal login-form" role="form" method="POST" action="{{ route('register') }}">
                                            {{ csrf_field() }}
                                            <div class="form-element">
                                                <input type="name" class="input-field" name="name" value="{{ old('name') }}" autofocus placeholder="{{ __('Meno') }}">
                                                @if ($errors->has('name'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('name') }}</strong>
                                             </span>
                                                @endif
                                            </div>
                                            <div class="form-element">
                                                <input type="email" class="input-field" name="email" value="{{ old('email') }}" placeholder="{{ __('E-mail') }}">

                                                @if ($errors->has('email'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                                @endif

                                            </div>
                                            <div class="form-element">
                                                <input type="password" class="input-field" name="password" placeholder="{{ __('Heslo') }}">
                                                @if ($errors->has('password'))
                                                    <span class="help-block">
                                                <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                                @endif
                                            </div>
                                            <div class="form-element">
                                                <input type="password" class="input-field" name="password_confirmation" placeholder="{{ __('Heslo znovu') }}">
                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="submit-btn">{{ __('Registrácia') }}</button>
                                                <a href="{{ route('login') }}" class="link">{{ __('Už máte účet?') }}</a>
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
