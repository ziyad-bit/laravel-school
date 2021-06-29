<aside id="sidebar">
    <ul class="list-unstyled sidebar_links">
        <a href="{{ url('/home') }}">
            <div class="links home">
                <li >
                    <i class="fas fa-home"></i>
                    <span>home</span>
                </li>
            </div>
        </a>

        <a href="{{url('profile/get')}}">
            <div class="links profile">
                <li>
                    <i class="fas fa-user"></i>
                    <span>profile</span>
                </li>
            </div>
        </a>

        <a href="{{url('posts/get')}}">
            <div class="links posts">
                <li>
                    <i class="fas fa-clone"></i>
                    <span>posts</span>
                </li>
            </div>
        </a>

        <a href="{{ url('exams/get') }}">
            <div class="links exams">
                <li>
                    <i class="fas fa-paste"></i>
                    <span>exams</span>
                </li>
            </div>
        </a>

        <a href="{{url('subjects/get')}}">
            <div class="links subjects">
                <li>
                    <i class="fas fa-book"></i>
                    <span>subjects</span> 
                </li>
            </div>
        </a>
    </ul>

</aside>


@section('sidebar_script')
    <script>
        $(function(){
            //active links
            if(window.location.pathname == '/exams/get'){
                $('.exams').addClass('active');
            }

            if(window.location.pathname == '/subjects/get'){
                $('.subjects').addClass('active');
            }

            if(window.location.pathname == '/home'){
                $('.home').addClass('active');
            }

            if(window.location.pathname == '/posts/get'){
                $('.posts').addClass('active');
            }

            if(window.location.pathname == '/profile/get'){
                $('.profile').addClass('active');
            }

            //responsive sidebar
            let content     = $('.content'),
            sidebar_wrapper = $('.sidebar_wrapper');

            $(window).on('resize', function () {
                if($(window).width() >= 768){
                    content.show();
                }
                
                if($(window).width() <= 768){
                    sidebar_wrapper.hide();
                }
            });

            $('body').on('click','.fa-align-left', function () {
                content.toggle();
                sidebar_wrapper.toggle();
                
            });
        })
    </script>
@endsection