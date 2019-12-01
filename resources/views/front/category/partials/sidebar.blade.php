<div class="category-sidebar"><!-- category sidebar -->
    <div class="category-filter-widget"><!-- category-filter-widget -->
        <h4 class="title">{{ __('Filtrovať podľa') }} <span class="right">+</span></h4>
        <ul class="cat-list">
            <li><a href="#">{{ __('Ceny') }} <span class="right">+</span></a></li>
            <vue-range-slider :min="initialMinPrice" :max="initialMaxPrice" @drag-end="loadData(true)" ref="slider" v-model="filters['price']"></vue-range-slider>
        @foreach( $availableFilters as $filter)
            <li><a href="#">{{ $filter->feature->title }} <span class="right">+</span></a></li>
                @if($filter->filter_type === \App\Shop\Filters\Filter::CHECKBOX_STRING)
                    @foreach($filter->feature->featureValues as $value)
                        <input type="checkbox" @change="loadData(true)" v-model="filters[{{ $filter->id }}]" value="{{ $value->value_string }}"> {{ $value->value_string }}<br>
                    @endforeach
                @endif
                @if($filter->filter_type === \App\Shop\Filters\Filter::CHECKBOX_NUMBER)
                    @foreach($filter->feature->featureValues as $value)
                        <input type="checkbox" @change="loadData(true)" v-model="filters[{{ $filter->id }}]" value="{{ $value->value_integer }}"> {{ $value->value_integer }}<br>
                    @endforeach
                @endif
                @if($filter->filter_type === \App\Shop\Filters\Filter::RANGE_NUMBER_INPUTS)
                        {{ $filter->feature->title }} od <input @input="loadData(true)" type="number" v-model="filters[{{ $filter->id }}].from"> <br>
                        {{ $filter->feature->title }} do <input @input="loadData(true)" type="number" v-model="filters[{{ $filter->id }}].to"> <br>
                @endif
                @if($filter->filter_type === \App\Shop\Filters\Filter::RANGE_NUMBER_DRAG)
                        <vue-range-slider @drag-end="loadData(true)" ref="slider" :min="{{ $filter->feature->minValue() }}" :max="{{ $filter->feature->maxValue() }}" v-model="filters[{{ $filter->id }}]"></vue-range-slider>
                @endif
            @endforeach
            {{--<li><a href="#">PROCESSOR TYPE <span class="right">+</span></a></li>--}}
            {{--<li><a href="#">CACHE MEMORY <span class="right">+</span></a></li>--}}
            {{--<li><a href="#">OTHERS <span class="right">+</span></a></li>--}}
            {{--<li><a href="#">PRICE <span class="right">+</span></a></li>--}}
        </ul>
    </div><!-- //.category-filter-widget -->
</div><!-- //. category sidebar -->
{{--<div class="category-compare">--}}
    {{--<h4 class="title">compare (03)</h4>--}}
    {{--<ul class="compare-list">--}}
        {{--<li>--}}
            {{--<div class="single-compare-item"><!-- single compare item -->--}}
                {{--<h4 class="title">Intel kaby lake core i3 7100 3.90GHZ 3MB.</h4>--}}
                {{--<div class="close-btn">X</div>--}}
            {{--</div><!-- //..single compare item -->--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<div class="single-compare-item"><!-- single compare item -->--}}
                {{--<h4 class="title">Intel kaby lake core i3 7100 3.90GHZ 3MB.</h4>--}}
                {{--<div class="close-btn">X</div>--}}
            {{--</div><!-- //..single compare item -->--}}
        {{--</li>--}}
        {{--<li>--}}
            {{--<div class="single-compare-item"><!-- single compare item -->--}}
                {{--<h4 class="title">Intel kaby lake core i3 7100 3.90GHZ 3MB.</h4>--}}
                {{--<div class="close-btn">X</div>--}}
            {{--</div><!-- //..single compare item -->--}}
        {{--</li>--}}
    {{--</ul>--}}
    {{--<div class="btn-wrapper">--}}
        {{--<a href="#" class="boxed-btn">Compare</a>--}}
    {{--</div>--}}
{{--</div>--}}