<div id="app">
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Home</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup"
            aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
            <div class="navbar-nav">
                <a class="nav-link" href="{{url('admins/exams/show')}}">exams </a>
                <a class="nav-link" href="{{url('admins/posts/index')}}">posts</a>
                <a class="nav-link " href="{{url('admins/logout')}}" >logout</a>
            </div>
        </div>
    </nav>

</div>
