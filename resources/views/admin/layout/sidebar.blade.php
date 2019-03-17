<div class="sidebar">
    <nav class="sidebar-nav">
        <ul class="nav">
            <li class="nav-title">Home</li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.dashboard')  }}"><i class="nav-icon icon-home"></i>Home</a></li>
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.content') }}</li>
            {{-- Do not delete me :) I'm used for auto-generation menu items --}}

            <li class="nav-title">Sell</li>
            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon cui-basket-loaded"></i> Products
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.products.index')  }}">
                            <i class="nav-icon cui-list"></i> Products list
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.attributes.index')  }}">
                            <i class="nav-icon cui-list"></i> Attributes
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.brands.index')  }}">
                            <i class="nav-icon cui-list"></i> Brands
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.categories.index')}}">
                    <i class="nav-icon cui-list"></i> Categories
                </a>
            </li>

            <li class="nav-item nav-dropdown">
                <a class="nav-link nav-dropdown-toggle" href="#">
                    <i class="nav-icon cui-people"></i> Customers
                </a>
                <ul class="nav-dropdown-items">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customers.index')  }}">
                            <i class="nav-icon cui-list"></i> Customers list
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.customerGroups.index')  }}">
                            <i class="nav-icon cui-list"></i> Customer groups
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.addresses.index')  }}">
                            <i class="nav-icon cui-list"></i> Addresses
                        </a>
                    </li>
                </ul>
            </li>
            <li class="nav-title">Orders</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.orders.index')}}">
                    <i class="nav-icon cui-cart"></i> Orders
                </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.order-statuses.index')}}">
                    <i class="nav-icon cui-task"></i> Order statuses
                </a>
            </li>
            <li class="nav-title">Delivery</li>
            <li class="nav-item">
                <a class="nav-link" href="{{route('admin.couriers.index')}}">
                    <i class="nav-icon cui-speedometer"></i> Couriers
                </a>
            </li>
            <li class="nav-title">{{ trans('brackets/admin-ui::admin.sidebar.settings') }}</li>
            {{-- Do not delete me :) I'm also used for auto-generation menu items --}}
            {{--<li class="nav-item"><a class="nav-link" href="{{ url('admin/configuration') }}"><i class="nav-icon icon-settings"></i> {{ __('Configuration') }}</a></li>--}}
        </ul>
    </nav>
    <button class="sidebar-minimizer brand-minimizer" type="button"></button>
</div>
