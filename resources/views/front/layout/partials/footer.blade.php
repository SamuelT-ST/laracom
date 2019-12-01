
<!-- footer area one start -->
<footer class="footer-arae-one">
    <div class="footer-top-one blue-bg"><!-- footer top one-->
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget about">
                        <div class="widget-body">
                            {{--<a href="/" class="logo main-logo">--}}
                                {{--<img style="width: 200px" class="logo img-responsive" src="https://lumo.sk/img/Logo_Lumo.png" alt="LUMO Slovakia s.r.o. ">--}}
                            {{--</a>--}}
                            <ul class="contact-info-list">
                                <li>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </div>
                                        <div class="content">
                                            <span class="details">{{ __('LUMO Slovakia s.r.o. Vajnorská 98/A 831 04 Bratislava') }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <i class="fas fa-envelope"></i>
                                        </div>
                                        <div class="content">
                                            <span class="details">{{ __('Pošlite nám email:') }}</span>
                                            <span class="details">{{ __('info@lumo.sk') }}</span>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="single-contact-info">
                                        <div class="icon">
                                            <i class="fas fa-phone"></i>
                                        </div>
                                        <div class="content">
                                            <span class="details">{{ __('Zavolajte nám:') }}</span>
                                            <span class="details">{{ __('1111 11 11 11') }}</span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h4 class="title">{{ __('Kategórie') }}</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="page-list">
                                @foreach(App\Shop\Categories\Category::whereParentId(null)->get() as $category)
                                    <li><a href="{{ $category->front_url }}">--  {{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h4 class="title">{{ __('Články a tipy') }}</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="page-list">
                                @foreach(App\Shop\Categories\Category::whereParentId(null)->get() as $category)
                                    <li><a href="{{ $category->front_url }}">--  {{ $category->name }}</a></li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6">
                    <div class="footer-widget">
                        <div class="widget-title">
                            <h4 class="title">{{ __('Informácie') }}</h4>
                        </div>
                        <div class="widget-body">
                            <ul class="page-list">
                                <li><a href="#">--  Sitemap</a></li>
                                <li><a href="#">--  Search Terms</a></li>
                                <li><a href="#">--  Advanced Search</a></li>
                                <li><a href="about.html">--  About us</a></li>
                                <li><a href="contact.html">--  Contact Us</a></li>
                                <li><a href="partners.html">--  Suppliers</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div><!-- //.footer top one -->
    <div class="copyright-area blue-bg"><!-- copyright area -->
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="copyright-inner"><!-- copyright inner -->
                        <div class="left-content-area">
                            <span class="copyright-text">Copyright Lumo.sk - 2019</span>
                        </div>
                        <div class="right-content-area">
                            <ul class="payment-logo">

                            </ul>
                        </div>
                    </div><!-- //. copyright inner -->
                </div>
            </div>
        </div>
    </div><!-- //. copyright area -->
</footer>