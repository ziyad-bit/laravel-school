<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    @include('admins.includes.header')

<body>
    
    
    <div class="container">
        @yield('content')
    </div>
    
    @include('admins.includes.footer')
</body>
</html>