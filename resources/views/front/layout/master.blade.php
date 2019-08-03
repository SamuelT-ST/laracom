<!DOCTYPE html>
<html lang="en">

@include('front.layout.partials.head')

<body>

    @include('front.layout.partials.header')

    @include('front.layout.partials.recently-viewed')

    @include('front.layout.partials.cart')

    @yield('body')

    @include('front.layout.partials.footer')

</body>

@include('front.layout.partials.bottom-scripts')

</html>