@extends('front.layout.master')

@section('body')
    <category-listing
            :data="{{ $data->toJson() }}"
            :url="'{{ url('category/'.$category->slug) }}'"
            @updated-cart="updateCart"
            inline-template>
        <div>
        <section class="breadcrumb-area breadcrumb-bg extra">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="breadcrumb-inner"><!-- breadcrumb inner -->
                            <div class="left-content-area"><!-- left content area -->
                                <h1 class="title">{{ $category->name }}</h1>
                            </div><!-- //. left content area -->
                            <div class="right-content-area">
                                <ul>
                                    <li><a href="{{ url('/') }}">{{ __('Domov') }}</a></li>

                                    @foreach($category->getAncestors()->toFlatTree() as $categoryPath)
                                        <li><a href="{{$categoryPath->front_url}}">{{ $categoryPath->name }}</a></li>
                                    @endforeach

                                    <li>{{ $category->name }}</li>
                                </ul>
                            </div>
                        </div><!-- //. breadcrumb inner -->
                    </div>
                </div>
            </div>
        </section>
        <!-- breadcrumb area end -->
        <div class="body-overlay" id="body-overlay"></div>

        <!-- cart sidebar area end -->
        <!-- category block area start -->
        <div class="category-block-area">
            <div class="container">
                <div class="row">
                   @foreach($category->children as $subcategory)
                       @include('front.category.partials.subcategory', ['subcategory' => $subcategory])
                   @endforeach
                </div>
            </div>
        </div>
        <!-- category block area end -->


        <!-- category content area start -->
        <div class="category-content-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-3">
                        @include('front.category.partials.sidebar')
                    </div>
                    <div class="col-lg-9">
                        <div class="right-content-area"><!-- right content area -->
                            <div class="top-content"><!-- top content -->
                                <div class="left-conent">
                                    <span class="cat">Cloths</span>
                                </div>
                                <div class="right-content">
                                    <ul>
                                        <li>
                                            <div class="form-element has-icon">
                                                <select class="selectpicker input-field select">
                                                    <option value="0">Show</option>
                                                    <option value="2">Hide</option>
                                                    <option value="1">Show</option>
                                                </select>
                                                <div class="the-icon">
                                                    <i class="fas fa-angle-down"></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="form-element has-icon">
                                                <select class="selectpicker input-field select">
                                                    <option value="0">short by</option>
                                                    <option value="2">Price</option>
                                                    <option value="1">Ratings</option>
                                                </select>
                                                <div class="the-icon">
                                                    <i class="fas fa-angle-down"></i>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="grid icon active">
                                            <i class="fas fa-th-large"></i>
                                        </li>
                                        <li class="grid icon">
                                            <i class="fas fa-th-list"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div><!-- //. top content -->
                            <div class="bottom-content"><!-- top content -->
                                <div class="row">
                                    <template v-for="(item, index) in collection">
                                        @include('front.category.partials.product')
                                    </template>
                                </div>
                            </div><!-- //.top content -->
                            <div class="row" v-if="pagination.state.total > 0">
                                <div class="col-sm">
                                    <span class="pagination-caption">{{ trans('brackets/admin-ui::admin.pagination.overview') }}</span>
                                </div>
                                <div class="col-sm-auto">
                                    <pagination></pagination>
                                </div>
                            </div>
                        </div><!-- //. right content area -->
                    </div>
                </div>
            </div>
        </div>
        </div>
    </category-listing>
@endsection

<!-- category content area end -->