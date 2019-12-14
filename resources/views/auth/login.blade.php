@extends('front.layout.master')

@section('body')
    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">{{ __('Prihlásiť sa') }}</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="/">{{ __('Domov') }}</a></li>
                                <li>{{ __('Prihlásiť sa') }}</li>
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
                    @if(session()->has('registration-result'))
                        @if(session()->get('registration-result') === 'success')
                            <div class="mt-3 mx-4 alert alert-success">
                                {{ __('Váš účet bol úspešne aktivovaný, môžete sa prihlásiť') }}
                            </div>
                        @endif
                        @if(session()->get('registration-result') === 'fail')
                            <div class="mt-3 mx-4 alert alert-danger">
                                {{ __('Váš účet už bol aktivovaný alebo link nie je správny') }}
                            </div>
                        @endif
                    @endif
                    <div class="signup-page-wrapper mb-5"><!-- login page wrapper -->
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
                                        <h4 class="title">{{ __('Prihlásiť sa') }}</h4>
                                        {{--<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>--}}
                                    </div>
                                    <div class="bottom-content">
                                        <form action="{{ route('login') }}" method="post" class="login-form">
                                            {{ csrf_field() }}
                                            <div class="form-element">
                                                <input type="email" name="email" class="input-field" placeholder="{{ __('Email') }}">
                                            </div>
                                            <div class="form-element">
                                                <input type="password" name="password" class="input-field" placeholder="{{ __('Heslo') }}">
                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="submit-btn">{{ __('Prihlásiť sa') }}</button>
                                                <a href="/password/reset" class="link">{{ __('Zabudli ste heslo?') }}</a><br>
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
