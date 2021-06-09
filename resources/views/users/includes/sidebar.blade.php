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

        <a href="">
            <div class="links">
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
        if(window.location.pathname == '/exams/get'){
            $('.exams').addClass('active');
        }

        if(window.location.pathname == '/subjects/get'){
            $('.subjects').addClass('active');
        }

        if(window.location.pathname == '/home'){
            $('.home').addClass('active');
        }

        
    </script>
@endsection