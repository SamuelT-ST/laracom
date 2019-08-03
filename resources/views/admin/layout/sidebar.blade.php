<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Dashboard</li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard')  }}"><i class="nav-icon icon-home"></i>Home</a></li>
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/orders') }}"><i class="nav-icon icon-drop"></i> {{ trans('admin.order.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/payment-methods') }}"><i class="nav-icon icon-plane"></i> {{ trans('admin.payment-method.title') }}</a></li>
           <li class="nav-item"><a class="nav-link" href="{{ url('admin/settings') }}"><i class="nav-icon icon-ghost"></i> {{ trans('admin.setting.title') }}</a></li>
           {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">Predaj</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon cui-basket-loaded"></i> Produkty
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products.index')  }}">
                            <i class="nav-icon cui-list"></i> Zoznam produktov
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.attributes.index')  }}">
                            <i class="nav-icon cui-list"></i> Atribúty
                        </a>
                    </li>
                    {{--<li class="nav-item">--}}
                        {{--<a class="nav-link" href="{{ route('admin.brands.index')  }}">--}}
                            {{--<i class="nav-icon cui-list"></i> Brands--}}
                        {{--</a>--}}
                    {{--</li>--}}
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <i class="nav-icon cui-list"></i> Kategórie
                </a>
            </li>

            <li class="nav-item"><a class="nav-link" href="{{ url('admin/discounts') }}"><i class="nav-icon cui-tags"></i> {{ trans('admin.discount.title') }}</a></li>


            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon cui-people"></i> Zákazníci
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customers.index')  }}">
                            <i class="nav-icon cui-list"></i> Zoznam zákazníkov
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customerGroups.index')  }}">
                            <i class="nav-icon cui-list"></i> Zákaznícke skupiny
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.addresses.index')  }}">
                            <i class="nav-icon cui-list"></i> Adresy
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-title">Objednávky</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cui-note"></i> Rýchla objednávka
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.orders.index')}}">
                    <i class="nav-icon cui-cart"></i> Zoznam objednávok
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order-statuses.index')}}">
                    <i class="nav-icon cui-task"></i> Stavy objednávok
                </a>
            </li>
            <li class="nav-title">Doručenie a platba</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.couriers.index')}}">
                    <i class="nav-icon cui-speedometer"></i> Doručenie
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cui-credit-card"></i> Platba
                </a>
            </li>
            <li class="nav-title">Plánovač osvetlenia</li>
            <li class="nav-item">
                <a class="nav-link" href="#">
                    <i class="nav-icon cui-cog"></i> Nastavenia
                </a>
            </li>
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/admin-users') }}"><i class="nav-icon icon-user"></i> {{ __('Manage access') }}</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ url('admin/translations') }}"><i class="nav-icon icon-location-pin"></i> {{ __('Translations') }}</a></li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
