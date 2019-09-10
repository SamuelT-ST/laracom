<!DOCTYPE html>
<html lang="en">

@include('front.layout.partials.head')

<body>
    <div id="app">
        @include('front.layout.partials.header')

        @include('front.layout.partials.recently-viewed')

        @include('front.layout.partials.cart')

        @yield('body')

        @include('front.layout.partials.footer')
        {{--<div class="modals">--}}
            {{--<v-dialog/>--}}
        {{--</div>--}}
        <div>
            <notifications position="bottom right" :duration="2000" />
        </div>
    </div>
</body>

@include('front.layout.partials.bottom-scripts')

</html>