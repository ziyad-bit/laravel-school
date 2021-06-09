<nav class="navbar navbar-expand-lg navbar-light "   >
    <div class="container">
        <i class="fas fa-align-left"></i>
            <a class="navbar-brand" href="{{url('/home')}}">Laravel school</a>

            
            <i class="fas fa-arrow-left"></i>
            
            <form class="form-inline my-2 my-lg-0 form-search">
                <input class="form-control mr-sm-2 search" type="search" placeholder="Search for post" aria-label="Search">
                <button class="btn btn-light my-2 my-sm-0 search-button" type="submit">Search</button>
            </form>
            
        <div class="logout">
            <i class="fas fa-bell"></i>
            <i class="fas fa-search search_icon"></i>
            <ul class="list-unstyled">
                <li class="nav-item dropdown">

                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                        {{ ucfirst(substr(Auth::user()->name,0,1)) }}
                    </a>
    
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                            document.getElementById('logout-form').submit();">
                            {{ __('Logout') }}
                        </a>
    
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </div>
                </li>
            </ul>
            
        </div>
        
    </div>
    
</nav>

@section('navbar_script')
    <script>
        $(function()
        {
            let form_inline  = $('.form-inline'),
                navbar_brand = $('.navbar-brand'),
                fa_align     = $('.fa-align-left'),
                fa_search    = $('.fa-search'),
                arrow        = $('.fa-arrow-left');

            $(window).on('resize', function () {
                if($(window).width() <= 576){
                    fa_search.on('click', function () {
                        form_inline.removeClass('form-search');
                        $(this).hide();
                        navbar_brand.hide();
                        arrow.show();
                        fa_align.hide();
                    });
                }
            });

            
            fa_search.on('click', function () {
                    form_inline.removeClass('form-search');
                    $(this).hide();
                    navbar_brand.hide();
                    arrow.show();
                    fa_align.hide();
                });
                

            arrow.on('click', function () {
                form_inline.addClass('form-search');
                fa_search.show();
                navbar_brand.show();
                $(this).hide();
                fa_align.show();
            });

            
            let content         = $('.content'),
                sidebar_wrapper = $('.sidebar_wrapper');

            $(window).on('resize', function () {
                if($(window).width() >= 768){
                    content.show();
                }
                
                if($(window).width() <= 768){
                    sidebar_wrapper.hide();
                }

                if($(window).width() <= 768){
                    fa_align.on('click', function () {
                        content.toggle();
                        sidebar_wrapper.toggle();
                        
                    });
                }
            });
            
            fa_align.on('click', function () {
                    content.toggle();
                    sidebar_wrapper.toggle();
                    
                });
        })
        
    </script>
@endsection

