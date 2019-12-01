@extends('front.layout.master')

@section('body')

    <!-- breadcrumb area start -->
    <section class="breadcrumb-area breadcrumb-bg extra">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">Login</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>Login</li>
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
                    <div class="login-page-wrapper"><!-- login page wrapper -->
                        <div class="or">
                            <span>or</span>
                        </div>
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="left-content-area">
                                    <div class="top-content">
                                        <h4 class="title">Welcome Back Again</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                    </div>
                                    <div class="bottom-content">
                                        <div class="left-content">
                                            <div class="thumb">
                                                <img src="assets/img/login-image.jpg" alt="login image">
                                            </div>
                                        </div>
                                        <div class="right-content">
                                            <ul>
                                                <li class="active">
                                                    <a href="#">Login as shuvo</a>
                                                </li>
                                                <li>
                                                    <a href="#">Delete Account</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="right-contnet-area">
                                    <div class="top-content">
                                        <h4 class="title">Account Login</h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore.</p>
                                    </div>
                                    <div class="bottom-content">
                                        <form action="{{ route('login') }}" method="post" class="login-form">
                                            {{ csrf_field() }}
                                            <div class="form-element">
                                                <input type="email" name="email" class="input-field" placeholder="Enter Username or Email">
                                            </div>
                                            <div class="form-element">
                                                <input type="password" name="password" class="input-field" placeholder="Enter Password">
                                            </div>
                                            <div class="btn-wrapper">
                                                <button type="submit" class="submit-btn">Login</button>
                                                <a href="#" class="link">Forget password?</a>
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






    {{--<hr>--}}
    {{--<!-- Main content -->--}}
    {{--<section class="container content">--}}
        {{--<div class="col-md-12">@include('admin.layout.errors-and-messages')</div>--}}
        {{--<div class="col-md-4 col-md-offset-4">--}}
            {{--<h2>Login to your account</h2>--}}
            {{--<form action="{{ route('login') }}" method="post" class="form-horizontal">--}}
                {{--{{ csrf_field() }}--}}
                {{--<div class="form-group">--}}
                    {{--<label for="email">Email</label>--}}
                    {{--<input type="email" id="email" name="email" value="{{ old('email') }}" class="form-control" placeholder="Email" autofocus>--}}
                {{--</div>--}}
                {{--<div class="form-group">--}}
                    {{--<label for="password">Password</label>--}}
                    {{--<input type="password" name="password" id="password" value="" class="form-control" placeholder="xxxxx">--}}
                {{--</div>--}}
                {{--<div class="row">--}}
                    {{--<button class="btn btn-default btn-block" type="submit">Login now</button>--}}
                {{--</div>--}}
            {{--</form>--}}
            {{--<div class="row">--}}
                {{--<hr>--}}
                {{--<a href="{{route('password.request')}}">I forgot my password</a><br>--}}
                {{--<a href="{{route('register')}}" class="text-center">No account? Register here.</a>--}}
            {{--</div>--}}
        {{--</div>--}}
    {{--</section>--}}
    <!-- /.content -->
@endsection
