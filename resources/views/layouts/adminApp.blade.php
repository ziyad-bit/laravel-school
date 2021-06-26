<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('admins.includes.header')

<body>
    @include('admins.includes.navbar')
    
    <div class="container">
        @yield('content')
    </div>
    
    @include('admins.includes.footer')

    @yield('script')
</body>
</html>