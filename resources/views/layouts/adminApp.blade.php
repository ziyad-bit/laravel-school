<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('admins.includes.header')

<body>
    @auth
        @include('admins.includes.navbar')
    @endauth
    <div class="container">
        @yield('content')
    </div>
    


    @include('admins.includes.footer')
</body>
</html>