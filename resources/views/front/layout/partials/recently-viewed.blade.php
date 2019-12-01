<!-- navbar area end -->
<div class="body-overlay" id="body-overlay"></div>
<div class="search-popup" id="search-popup">
    <product-search
            :search-url="'{{ route('search.product') }}'"
            inline-template>
        <form action="/search" class="search-popup-form">
            <div class="form-element">

                    <multiselect
                            v-model="chosen"
                            :options="availableLoaded"
                            label="name"
                            select-label=""
                            {{--:custom-label="customLabel"--}}
                            @search-change="asyncFind"
                            :preserve-search="true"
                            open-direction="bottom"
                            :internal-search="false"
                            @select="selectProduct"
                            name="q"
                            class="input-field"
                            placeholder="{{ __('Zadajte frázu') }}"></multiselect>
            </div>
            <button type="submit" class="submit-btn"><i class="fas fa-search"></i></button>
        </form>
    </product-search>
</div>
<!-- slide sidebar area start -->
<div class="slide-sidebar-area" id="slide-sidebar-area">
    {{--<div class="top-content"><!-- top content -->--}}
        {{--<a href="#" class="logo">--}}
            {{--<img src="assets/img/logo-white.png" alt="logo">--}}
        {{--</a>--}}
        {{--<span class="side-sidebar-close-btn" id="side-sidebar-close-btn"><i class="fas fa-times"></i></span>--}}
    {{--</div><!-- //. top content -->--}}
    <div class="bottom-content"><!-- bottom content -->
        <div class="recent-reviews"><!-- recent reviews -->
            <h4>{{ __('Váš účet') }}</h4><br>
            @guest

            <h5 class="title">{{ __('Nie ste prihlásený, prosím prihláste sa alebo sa zaregistrujte.') }}</h5>

                <div class="right-contnet-area">
                    <div class="top-content">
                        <h4 class="title">{{ __('Prihlásenie') }}</h4>
                    </div>
                    <div class="bottom-content">
                        <form action="{{ route('login') }}" method="post" class="login-form right-login">
                            {{ csrf_field() }}
                            <div class="form-element">
                                <input type="email" name="email" class="input-field" placeholder="Enter Username or Email">
                            </div>
                            <div class="form-element">
                                <input type="password" name="password" class="input-field" placeholder="Enter Password">
                            </div>
                            <div class="btn-wrapper">
                                <button type="submit" class="submit-btn mb-3">Login</button><br>

                                <a href="{{ route('register') }}" class="link">{{ __('Ešte nemáte účet?') }}</a><br>
                                <a href="#" class="link">{{ __('Zabudli ste heslo?') }}</a>
                            </div>
                        </form>
                    </div>
                </div>

            {{--<a href="#" class="boxed-btn">--}}
            {{--{{ __('Prihlásenie') }}--}}
            {{--</a>--}}

            {{--<a href="#" class="boxed-btn">--}}
                {{--{{ __('Registrácia') }}--}}
            {{--</a>--}}

            @else
                <h5> {{ getCustomer()->name }} </h5><br>
                <div class="user-menu"><!-- single review item -->

                    <ul class="user-menu-links">
                        <li><a href="{{ route('front.account.orders') }}">{{ __('Profil') }}</a></li>
                        <li><a href="{{ route('front.account.orders') }}">{{ __('Adresy') }}</a></li>
                        <li><a href="{{ route('front.account.orders') }}">{{ __('Objednávky') }}</a></li>
                        <li><a href="{{ route('logout') }}">{{ __('Odhlásiť sa') }}</a></li>
                    </ul>

                </div>
            @endguest
            {{--<div class="single-review-item"><!-- single review item -->--}}
                {{--<div class="thumb">--}}
                    {{--<img src="assets/img/recent-review/01.jpg" alt="recent review">--}}
                {{--</div>--}}
                {{--<div class="content">--}}
                    {{--<h4 class="title">Footwear Dark</h4>--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="posted-by">by Abir Khan</span>--}}
                {{--</div>--}}
            {{--</div><!-- //. single review item -->--}}
            {{--<div class="single-review-item"><!-- single review item -->--}}
                {{--<div class="thumb">--}}
                    {{--<img src="assets/img/recent-review/02.jpg" alt="recent review">--}}
                {{--</div>--}}
                {{--<div class="content">--}}
                    {{--<h4 class="title">Milo Hoverboard</h4>--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="posted-by">by Rex Rifat</span>--}}
                {{--</div>--}}
            {{--</div><!-- //. single review item -->--}}
            {{--<div class="single-review-item"><!-- single review item -->--}}
                {{--<div class="thumb">--}}
                    {{--<img src="assets/img/recent-review/03.jpg" alt="recent review">--}}
                {{--</div>--}}
                {{--<div class="content">--}}
                    {{--<h4 class="title">Black Tshirt Brock</h4>--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="posted-by">by Panto Roy</span>--}}
                {{--</div>--}}
            {{--</div>--}}
            {{--<div class="single-review-item"><!-- single review item -->--}}
                {{--<div class="thumb">--}}
                    {{--<img src="assets/img/recent-review/04.jpg" alt="recent review">--}}
                {{--</div>--}}
                {{--<div class="content">--}}
                    {{--<h4 class="title">Black Tshirt Brock</h4>--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="posted-by">by Panto Roy</span>--}}
                {{--</div>--}}
            {{--</div><!-- //. single review item -->--}}
            {{--<div class="single-review-item"><!-- single review item -->--}}
                {{--<div class="thumb">--}}
                    {{--<img src="assets/img/recent-review/05.jpg" alt="recent review">--}}
                {{--</div>--}}
                {{--<div class="content">--}}
                    {{--<h4 class="title">Black Tshirt Brock</h4>--}}
                    {{--<ul>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                        {{--<li>--}}
                            {{--<i class="fas fa-star"></i>--}}
                        {{--</li>--}}
                    {{--</ul>--}}
                    {{--<span class="posted-by">by Panto Roy</span>--}}
                {{--</div>--}}
            {{--</div>--}}
        </div> <!-- //. recent reviews -->
    </div><!-- //. bottom content -->
</div>