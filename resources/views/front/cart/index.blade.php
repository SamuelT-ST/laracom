@extends('front.layout.master')

@section('body')
    <section class="breadcrumb-area breadcrumb-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                        <div class="left-content-area"><!-- left content area -->
                            <h1 class="title">Cart</h1>
                        </div><!-- //. left content area -->
                        <div class="right-content-area">
                            <ul>
                                <li><a href="index.html">Home</a></li>
                                <li>{{ __('Košík') }}</li>
                            </ul>
                        </div>
                    </div><!-- //. breadcrumb inner -->
                </div>
            </div>
        </div>
    </section>

    <!-- cart contetn area start -->
    <cart :initial-content="{{ app(\App\Shop\Carts\Repositories\CartRepository::class)->getWholeCart() }}" :updated-content="cartContent" v-cloak inline-template>
        <div class="cart-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="cart-content-inner"><!-- cart content inner -->
                            <div class="top-content"><!-- top content -->
                                <table class="table table-responsive">
                                    <thead>
                                    <tr>
                                        <th>{{ __('Produkt') }}</th>
                                        <th>{{ __('Cena') }}</th>
                                        <th>{{ __('Množstvo') }}</th>
                                        <th>{{ __('Celkom') }}</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <tr v-for="(item, index) in content.cartItems">
                                        <td>
                                            <div class="product-details"><!-- product details -->
                                                <div class="close-btn cart-remove-item">
                                                    <i class="fas fa-times" @click="removeItem(index)"></i>
                                                </div>
                                                <div class="thumb">
                                                    <img style="max-width: 150px" :src="item.options.thumb_url ? item.options.thumb_url : '/images/camera.png'" alt="cart image">
                                                </div>
                                                <div class="content">
                                                    <h4 class="title">@{{ item.name }}</h4>
                                                </div>
                                            </div><!-- //. product detials -->
                                        </td>
                                        <td>
                                            <div class="price">@{{ item.price }} €</div>
                                        </td>
                                        <td>
                                            <div class="qty">
                                                <ul>
                                                    <li><span class="qtminus" @click="item.qty--"><i class="fas fa-minus"></i></span></li>
                                                    <li><span class="qttotal">@{{ item.qty }}</span></li>
                                                    <li><span class="qtplus" @click="item.qty++"><i class="fas fa-plus"></i></span></li>
                                                </ul>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="price">@{{ item.subtotal }} €</div>
                                        </td>
                                    </tr>
                                    </tbody>
                                </table>
                            </div><!-- //. top content -->
                            <div class="bottom-content"><!-- bottom content -->
                                <div class="left-content-area">
                                    <div class="coupon-code-wrapper">
                                        <div class="form-element">
                                            <input type="text" class="input-field" placeholder="Coupon Code">
                                        </div>
                                        <button type="button" class="submit-btn">{{ __('Použiť zľavový kód') }}</button>
                                    </div>
                                </div>
                                <div class="right-content-area">
                                    <div class="btn-wrapper">
                                        <button type="button" class="boxed-btn" @click="massUpdate"> {{ __('Aktualizovať košík') }} </button>
                                        <a href="{{ route('checkout') }}" class="boxed-btn"> {{ __('Pokladňa') }} </a>
                                    </div>
                                    <div class="cart-total">
                                        <h3 class="title">{{ __('Zhrnutie') }}</h3>
                                        <ul class="cart-list">
                                            <li>{{ __('Celkom') }} <span class="right">@{{ content.subtotal }} €</span></li>
                                            <li>{{ __('Doprava') }} <span class="right">@{{ content.shippingFee }} €</span></li>
                                            <li>{{ __('Daň') }}	 <span class="right">@{{ content.tax }} €</span></li>
                                            <li class="total">{{ __('Celkom s DPH') }} <span class="right">@{{ content.total }} €</span></li>
                                        </ul>
                                    </div>
                                </div>

                            </div><!-- //. bottom content -->
                        </div><!-- //. cart content inner -->
                    </div>
                </div>
            </div>
        </div>
    </cart>

@endsection

<!-- cart contetn area end -->
<!-- breadcrumb area end -->