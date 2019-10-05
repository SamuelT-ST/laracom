@extends('front.layout.master')

@section('body')

<section class="breadcrumb-area breadcrumb-bg" >
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                    <div class="left-content-area"><!-- left content area -->
                        <h1 class="title">{{ __('Vaše objednávky') }}</h1>
                    </div><!-- //. left content area -->
                    <div class="right-content-area">
                        <ul>
                            <li><a href="/">{{ __('Domov') }}</a></li>
                            <li>{{ __('Vaše objednávky') }}</li>
                        </ul>
                    </div>
                </div><!-- //. breadcrumb inner -->
            </div>
        </div>
    </div>
</section>


<section class="order-track-page-content">
    <div class="container">
        {{--<div class="row justify-content-center">--}}
            {{--<div class="col-lg-8">--}}
                {{--<div class="track-order-form-wrapper"><!-- track order form -->--}}
                    {{--<h3 class="title">Track Your Order From Here</h3>--}}
                    {{--<form action="track-orders.html" class="track-order-form">--}}
                        {{--<div class="form-element">--}}
                            {{--<input type="text" class="input-field" placeholder="Type your order number...">--}}
                        {{--</div>--}}
                        {{--<button type="submit" class="submit-btn"><i class="fas fa-truck"></i> Track order</button>--}}
                    {{--</form>--}}
                {{--</div><!-- //. track order form -->--}}
            {{--</div>--}}
        {{--</div>--}}
        <div class="row">
            <div class="col-lg-12">
                <div class="order-track-tab-nav"><!-- order track tab nav -->
                    @if(count($statuses))
                    <div class="left-content">
                        <ul class="nav nav-tabs" id="myTab" role="tablist">

                            @foreach($statuses as $status)
                                <li class="nav-item">
                                    <a class="nav-link @if($loop->index === 0) active @endif" id="status{{ $status->id }}-tab" data-toggle="tab" href="#status{{ $status->id }}" role="tab" aria-controls="status{{ $status->id }}" @if($loop->index === 0) aria-selected="true" @endif>{{ $status->name }} ({{count($status->orders)}})</a>
                                </li>
                            @endforeach


                        </ul>
                    </div>
                    <div class="right-content">
                        <ul>
                            <li><a href="#"><i class="fas fa-copy"></i></a></li>
                            <li><a href="#"><i class="fas fa-paste"></i></a></li>
                            <li><a href="#"><i class="fas fa-redo-alt"></i></a></li>
                            <li><a href="#"><i class="fas fa-arrows-alt-v"></i></a></li>
                        </ul>
                    </div>
                    @else
                    <h3>
                        {{ __('Zatiaľ nemáte žiadnu objednávku') }}
                    </h3>
                    @endif
                </div><!-- //.order track tab nav -->
                <div class="order-track-tab-content mx-3"><!-- order track tab content -->
                    <div class="tab-content" id="myTabContent">
                        @foreach($statuses as $status)
                        <div class="tab-pane fade @if($loop->index === 0)show active @endif" id="status{{ $status->id }}" role="tabpanel" aria-labelledby="status{{ $status->id }}-tab">
                            <div class="track-tab-content-inner"><!-- track tab content inner -->
                                <table class="table table-default table-responsive">
                                    <tbody>
                                    @foreach($status->orders as $order)
                                    <tr>
                                        <td>{{$order->id}}</td>
                                        <td>{{$order->customer_name}}</td>
                                        <td><strong>{{ $order->total }} {{ \App\Shop\Products\Product::CURRENCY }}</strong></td>
                                        <td><span class="base-color">{{$status->name}}</span></td>
                                        <td style="text-align: right">{{ $order->created_at }}</td>
                                    </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><!-- //.track tab content inner -->
                        </div>
                        @endforeach
                    </div>
                </div><!-- //.order track tab content -->
            </div>
        </div>
    </div>
</section>
<!-- order track page content area end -->

<!-- how it works area start -->
<section class="how-it-works-area gray-bg">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-8">
                <div class="section-title-two">
                    <span class="subtitle">{{ __('Pozrite sa') }}</span>
                    <h2 class="title">{{ 'ako to funguje' }}</h2>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6">
                <div class="single-coin-box yellow wow  slideInLeft">
                    <div class="icon">
                        <i class="fas fa-box-open"></i>
                    </div>
                    <div class="content">
                        <h4>{{ __('Vytvorte objednávku') }}</h4>
                        <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-coin-box blue wow slideInDown">
                    <div class="icon">
                        <i class="fas fa-truck"></i>
                    </div>
                    <div class="content">
                        <h4>{{ __('Sledujte objednávku') }}</h4>
                        <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-coin-box green wow slideInUp">
                    <div class="icon">
                        <i class="fas fa-smile"></i>
                    </div>
                    <div class="content">
                        <h4>{{ __('Hotovo') }}</h4>
                        <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="single-coin-box red wow slideInRight">
                    <div class="icon">
                        <i class="fas fa-truck-loading"></i>
                    </div>
                    <div class="content">
                        <h4>{{ __('Prevezmite objednávku') }}</h4>
                        <p>The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


@endsection

@section('bottom-scripts')
    <script src="{{asset('/js/waypoints.min.js')}}"></script>

    <script src="assets/js/waypoints.min.js"></script>
@endsection