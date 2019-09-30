<cart @cart-count-update="updateCartCount" :initial-content="{{ app(\App\Shop\Carts\Repositories\CartRepository::class)->getWholeCart() }}" :updated-content="cartContent" inline-template>
    <div class="cart-sidebar-area" id="cart-sidebar-area">
        <div class="top-content"><!-- top content -->
            {{--<a href="#" class="logo">--}}
                {{--<img src="https://lumo.sk/img/Logo_Lumo.png" alt="logo">--}}
            {{--</a>--}}
            <span class="side-sidebar-close-btn" ><i class="fas fa-times"></i></span>
        </div><!-- //. top content -->
        <div class="bottom-content"><!-- bottom content -->
            <div class="cart-products"><!-- cart product -->
                <h4 class="title">{{ __('Košík') }}</h4>

                <template v-for="(item, index) in content.cartItems">
                    <div class="single-product-item"><!-- single product item -->
                        <div class="thumb">
                            <img style="width: 86px" :src="item.options.thumb_url ? item.options.thumb_url : '/images/camera.png'" alt="recent review">
                        </div>
                        <div class="content">
                            <h4 class="title">@{{ item.name }}</h4>
                            <small v-if="item.options.attribute">@{{ item.options.attribute }}: @{{ item.options.value }}</small>
                            <div class="price"><span class="pprice">@{{ item.price }} € </span>
                                {{--<del class="dprice">$500.00</del>--}}
                            </div>
                            <a href="#" class="remove-cart" @click.prevent="removeItem(index)">{{ __('Odstrániť') }}</a>
                        </div>
                    </div>
                </template>
                <div class="btn-wrapper">
                    <a href="{{ route('cart.index') }}" class="boxed-btn">{{ __('Do pokladne') }}</a>
                </div>
            </div> <!-- //. cart product -->
        </div><!-- //. bottom content -->
    </div>
</cart>