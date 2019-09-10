<right-cart-panel :initial-content="{{ \Gloudemans\Shoppingcart\Facades\Cart::content() }}" :updated-content="cartContent" inline-template>
    <div class="cart-sidebar-area" id="cart-sidebar-area">
        <div class="top-content"><!-- top content -->
            <a href="#" class="logo">
                <img src="assets/img/logo-white.png" alt="logo">
            </a>
            <span class="side-sidebar-close-btn" ><i class="fas fa-times"></i></span>
        </div><!-- //. top content -->
        <div class="bottom-content"><!-- bottom content -->
            <div class="cart-products"><!-- cart product -->
                <h4 class="title">{{ __('Košík') }}</h4>

                <template v-for="item in content">
                    <div class="single-product-item"><!-- single product item -->
                        <div class="thumb">
                            <img style="width: 86px" :src="item.options.thumb_url" alt="recent review">
                        </div>
                        <div class="content">
                            <h4 class="title">@{{ item.name }}</h4>
                            <div class="price"><span class="pprice">@{{ item.price }} € </span>
                                {{--<del class="dprice">$500.00</del>--}}
                            </div>
                            <a href="#" class="remove-cart">Remove</a>
                        </div>
                    </div>
                </template>
                <div class="btn-wrapper">
                    <a href="checkout.html" class="boxed-btn">Checkout</a>
                </div>
            </div> <!-- //. cart product -->
        </div><!-- //. bottom content -->
    </div>
</right-cart-panel>