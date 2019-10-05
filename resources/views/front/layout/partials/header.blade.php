<!-- navbar area start -->
<nav class="navbar navbar-area navbar-expand-lg navbar-light bg-wite home-5">
    <div class="container nav-container">
        <div class="logo-wrapper navbar-brand ">
            <a href="/" class="logo main-logo">
                <img style="width: 200px" class="logo img-responsive" src="https://lumo.sk/img/Logo_Lumo.png" alt="LUMO Slovakia s.r.o. ">
            </a>
        </div>
        <div class="collapse navbar-collapse" id="mirex">
            <!-- navbar collapse start -->
            <ul class="navbar-nav">
                <!-- navbar- nav -->
                @foreach(App\Shop\Categories\Category::whereParentId(null)->get() as $category)

                    <li class="nav-item dropdown mega-menu"><!-- mega menu start -->
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ $category->name }}</a>
                        <div class="mega-menu-wrapper">
                            <div class="container mega-menu-container">
                                <div class="row">
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mega-menu-columns">
                                            <h6 class="title">{{ __('Subcategories') }}</h6>
                                            <ul class="menga-menu-page-links">
                                                @foreach($category->children as $child)
                                                <li><a href="{{ $child->front_url }}">{{ $child->name }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mega-menu-columns">
                                            <h6 class="title">Other Pages</h6>
                                            <ul class="menga-menu-page-links">
                                                <li><a href="product_upload.html">Product Upload</a></li>
                                                <li><a href="offers.html">Offer</a></li>
                                                <li><a href="invoice.html">Invoice</a></li>
                                                <li><a href="vendor-list.html">Vendor List</a></li>
                                                <li><a href="partners.html">Partners</a></li>
                                                <li><a href="404.html">404 Page</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <div class="mega-menu-columns">
                                            <h6 class="title">{{ __('Information') }}</h6>
                                            <div class="card">
                                                {{ $category->description }}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-12">
                                        <a href="product-details.html">
                                            <img src="{{ $category->getFirstMediaUrl('cover') }}" alt="product image">
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </li>

                @endforeach

                @guest

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ route('login') }}">--}}
                        {{--{{ __('Prihlásenie') }}--}}
                    {{--</a>--}}
                {{--</li>--}}

                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="{{ route('register') }}">--}}
                        {{--{{ __('Registrácia') }}--}}
                    {{--</a>--}}
                {{--</li>--}}

                @else

                    {{--<li class="nav-item dropdown mega-menu"><!-- mega menu start -->--}}
                        {{--<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">{{ getCustomer()->name }}</a>--}}
                        {{--<div class="mega-menu-wrapper">--}}
                            {{--<div class="container mega-menu-container">--}}
                                {{--<div class="row">--}}
                                    {{--<div class="col-lg-3 col-sm-12">--}}
                                        {{--<div class="mega-menu-columns">--}}
                                            {{--<h6 class="title">{{ __('Subcategories') }}</h6>--}}
                                            {{--<ul class="menga-menu-page-links">--}}
                                                {{--<li><a href="category.html">{{ __('Profil') }}</a></li>--}}
                                                {{--<li><a href="category.html">{{ __('Adresy') }}</a></li>--}}
                                                {{--<li><a href="category.html">{{ __('Objednávky') }}</a></li>--}}
                                                {{--<li><a href="{{ route('logout') }}">{{ __('Odhlásiť sa') }}</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3 col-sm-12">--}}
                                        {{--<div class="mega-menu-columns">--}}
                                            {{--<h6 class="title">Other Pages</h6>--}}
                                            {{--<ul class="menga-menu-page-links">--}}
                                                {{--<li><a href="product_upload.html">Product Upload</a></li>--}}
                                                {{--<li><a href="offers.html">Offer</a></li>--}}
                                                {{--<li><a href="invoice.html">Invoice</a></li>--}}
                                                {{--<li><a href="vendor-list.html">Vendor List</a></li>--}}
                                                {{--<li><a href="partners.html">Partners</a></li>--}}
                                                {{--<li><a href="404.html">404 Page</a></li>--}}
                                            {{--</ul>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3 col-sm-12">--}}
                                        {{--<div class="mega-menu-columns">--}}
                                            {{--<h6 class="title">{{ __('Information') }}</h6>--}}
                                            {{--<div class="card">--}}
                                                {{--{{ $category->description }}--}}
                                            {{--</div>--}}
                                        {{--</div>--}}
                                    {{--</div>--}}
                                    {{--<div class="col-lg-3 col-sm-12">--}}
                                        {{--<a href="product-details.html">--}}
                                            {{--<img src="{{ $category->getFirstMediaUrl('cover') }}" alt="product image">--}}
                                        {{--</a>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</li>--}}

                @endguest

                {{--<li class="nav-item active dropdown">--}}
                    {{--<a class="nav-link pl-0 dropdown-toggle" href="#" data-toggle="dropdown">Home--}}
                        {{--<span class="sr-only">(current)</span>--}}
                    {{--</a>--}}
                    {{--<div class="dropdown-menu">--}}
                        {{--<a href="index.html" class="dropdown-item">Home Style 01</a>--}}
                        {{--<a href="index-2.html" class="dropdown-item">Home Style 02</a>--}}
                        {{--<a href="index-3.html" class="dropdown-item">Home Style 03</a>--}}
                        {{--<a href="index-4.html" class="dropdown-item">Home Style 04</a>--}}
                        {{--<a href="index-5.html" class="dropdown-item">Home Style 05</a>--}}
                        {{--<a href="index-6.html" class="dropdown-item">Home Style 06</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="about.html">About</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item dropdown mega-menu"><!-- mega menu start -->--}}
                    {{--<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Pages</a>--}}
                    {{--<div class="mega-menu-wrapper">--}}
                        {{--<div class="container mega-menu-container">--}}
                            {{--<div class="row">--}}
                                {{--<div class="col-lg-3 col-sm-12">--}}
                                    {{--<div class="mega-menu-columns">--}}
                                        {{--<h6 class="title">Inner Pages</h6>--}}
                                        {{--<ul class="menga-menu-page-links">--}}
                                            {{--<li><a href="category.html">Category</a></li>--}}
                                            {{--<li><a href="cart.html">Cart</a></li>--}}
                                            {{--<li><a href="product-details.html">Product Details</a></li>--}}
                                            {{--<li><a href="signup.html">Signup</a></li>--}}
                                            {{--<li><a href="sellers-products.html">Sellers Products</a></li>--}}
                                            {{--<li><a href="seller-dashboard.html">Sellers Dashboard</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-lg-3 col-sm-12">--}}
                                    {{--<div class="mega-menu-columns">--}}
                                        {{--<h6 class="title">Other Pages</h6>--}}
                                        {{--<ul class="menga-menu-page-links">--}}
                                            {{--<li><a href="product_upload.html">Product Upload</a></li>--}}
                                            {{--<li><a href="offers.html">Offer</a></li>--}}
                                            {{--<li><a href="invoice.html">Invoice</a></li>--}}
                                            {{--<li><a href="vendor-list.html">Vendor List</a></li>--}}
                                            {{--<li><a href="partners.html">Partners</a></li>--}}
                                            {{--<li><a href="404.html">404 Page</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-lg-3 col-sm-12">--}}
                                    {{--<div class="mega-menu-columns">--}}
                                        {{--<h6 class="title">Other Pages</h6>--}}
                                        {{--<ul class="menga-menu-page-links">--}}
                                            {{--<li><a href="search.html">Search</a></li>--}}
                                            {{--<li><a href="become-affiliats.html">Become Affiliant</a></li>--}}
                                            {{--<li><a href="faq.html">Faq</a></li>--}}
                                            {{--<li><a href="track-orders.html">Track Order</a></li>--}}
                                            {{--<li><a href="privacy_policy.html">Privacy Policy</a></li>--}}
                                            {{--<li><a href="contact.html">Contact</a></li>--}}
                                        {{--</ul>--}}
                                    {{--</div>--}}
                                {{--</div>--}}
                                {{--<div class="col-lg-3 col-sm-12">--}}
                                    {{--<a href="product-details.html">--}}
                                        {{--<img src="assets/img/mega-menu.jpg" alt="product image">--}}
                                    {{--</a>--}}
                                {{--</div>--}}
                            {{--</div>--}}
                        {{--</div>--}}
                    {{--</div>--}}
                {{--</li><!-- mega menu start -->--}}
                {{--<li class="nav-item dropdown">--}}
                    {{--<a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Blog</a>--}}
                    {{--<div class="dropdown-menu">--}}
                        {{--<a href="blog.html" class="dropdown-item">Blog</a>--}}
                        {{--<a href="blog-details.html" class="dropdown-item">Blog Details</a>--}}
                    {{--</div>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="contact.html">Contact</a>--}}
                {{--</li>--}}
                {{--<li class="nav-item">--}}
                    {{--<a class="nav-link" href="login.html">Login</a>--}}
                {{--</li>--}}
            </ul>
            <!-- /.navbar-nav -->
            <div class="right-btn-wrapper">
                <ul>
                    <li class="search" id="search"><i class="fas fa-search"></i> </li>
                    <li class="cart" id="cart"><i class="fas fa-shopping-basket"></i>
                        <span class="badge">@{{ this.cartCount }}</span>
                    </li>
                    <li class="right-menu" id="side-menu"><i class="fas fa-user"></i> </li>
                </ul>
            </div>
        </div>
        <div class="responsive-mobile-menu">
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#mirex" aria-controls="mirex"
                    aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
        </div>
        <!-- navbar collapse end -->
        <div class="right-btn-wrapper desktop-none">
            <ul>
                <li class="search" id="search"><i class="fas fa-search"></i> </li>
                <li class="cart" id="cart"><i class="fas fa-shopping-basket"></i>
                    <span class="badge">@{{ this.cartCount }}</span>
                </li>
                <li class="right-menu" id="side-menu"><i class="fas fa-user"></i> </li>
            </ul>
        </div>
        <!-- /.navbar btn wrapper -->
    </div>
</nav>