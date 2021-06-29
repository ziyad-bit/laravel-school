<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container">
        <i class="fas fa-align-left"></i>
            <a class="navbar-brand" href="{{url('/home')}}">Laravel school</a>
            
            <i class="fas fa-arrow-left"></i>
            
            <form class="form-inline my-2 my-lg-0 form-search" action="{{url('posts/get')}}" 
                method="POST">

                @csrf
                <input class="form-control mr-sm-2 search" name="search" 
                type="search" placeholder="Search for post (subject or text)">

                <button class="btn btn-light my-2 my-sm-0 search-button" type="submit">
                    Search
                </button>
            </form>
            
        <div class="navbar_left">
            <i class="fas fa-bell">
                <span id="notifs_count"></span>
            </i>

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
        <div class="list-group notifications" style="display: none">
            
        </div>
    </div>
</nav>

@section('navbar_script')
    <script>
        $(function()
        {
            //responsive navbar 
            let form_inline  = $('.form-inline'),
                navbar_brand = $('.navbar-brand'),
                fa_align     = $('.fa-align-left'),
                fa_search    = $('.fa-search'),
                arrow        = $('.fa-arrow-left');

            $('body').on('click','.fa-search', function () {
                form_inline.removeClass('form-search');
                $('.fa-search').hide();
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

            //get notifications
            notify();

            $('.fa-bell').on('click', function () {
                $('.notifications').show();

                $.ajax({
                    type    : "get",
                    url     : "{{url('notifications/update')}}",
                    success : function (response) {
                        
                    }
                });
            });

            
            $(document).on('click', function (e) {
                if (e.target.classList[1] != 'fa-bell') {
                    $('.notifications').hide();
                }
                
            });
            
        })

        function notify(){
                $.ajax({
                    type    : "get",
                    url     : "{{url('notifications/get')}}",
                    success : function (response , status) {
                        if (status == 'success') {
                            let html         = response.html,
                                notifs_count = response.notifs_count;

                            $('.notifications').html(html);

                            if (notifs_count == 0) {
                                $('#notifs_count').text('');
                            }else{
                                $('#notifs_count').text(notifs_count);
                            }
                        }
                    },
                    complete:function(){
                        update();
                    }
                });
            }

        function update(){
            setTimeout(function(){notify()},5000)
        }

        
    </script>
@endsection

