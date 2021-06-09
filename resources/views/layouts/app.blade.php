<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

@include('users.includes.header')

<body>
    @auth
        @include('users.includes.navbar')
    @endauth

    @auth
        <div class="row" style="margin: 0">
            <div class="col-  col-md-3 col-lg-2 " style="padding-left: 0">
                <div class=" sidebar_wrapper">
                    @include('users.includes.sidebar')
                </div>
            </div>

            <div class="col-  col-md-9  col-lg-10 all" style="padding: 0; ">
                <div class="container content">
                    @yield('content')
                </div>
            </div>
        </div>

    @else

        <div class="container content">
            @yield('content')
        </div>
    @endauth

    @include('users.includes.footer')

    @yield('navbar_script')
    @yield('sidebar_script')
    @yield('script')
</body>

</html>
