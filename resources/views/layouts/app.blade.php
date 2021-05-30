<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('users.includes.header')

<body>
    @include('users.includes.navbar')

    <div class="container">
        @yield('content')
    </div>

    @include('users.includes.footer')

    @yield('script')
</body>
</html>
