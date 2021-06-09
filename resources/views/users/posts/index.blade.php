@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/posts/index.css')}}">
@endsection

@section('content')
    <section class="d-flex justify-content-center">
        <div class="card bg-light mb-3" style="max-width: 35rem;">
            <div class="card-header card-top">
                <img src="{{asset('images/profile/download.png')}}" alt="loading" class="rounded-circle">
                <span>ziyad</span>
                <small>12m</small>
                <p>
                    Lorem ipsum dolor, 
                    sit amet consectetur adipisicing elit. 
                    Aut sit quisquam ratione, saepe exercitationem possimus, 
                    neque laboriosam sint, consequatur ipsam expedita? 
                    Aut eum eius et quibusdam laudantium placeat accusantium dolor.
                </p>
                <small class="number_comments"><span>23 comments</span> </small>
            </div>
    
            <div class="card-body d-flex justify-content-center comment_btn" style="background-color:#eee ">
                <p><i class="fas fa-comment"></i>Comment</p>
            </div>
            <div class="card-header card-bottom" >
                <small>view all comments</small>
                <div class="comment">
                    <img src="{{asset('images/profile/download.png')}}" alt="loading" class="rounded-circle">
                        <span >mohamed</span>
                        <p>
                            Lorem ipsum dolor sit amet consectetur adipisicing eli
                            .
                        </p>
                </div>
                <img src="{{asset('images/profile/download.png')}}" alt="loading" class="rounded-circle img_input">
                <textarea name="" id="" cols="20" rows="2" class="form-control"></textarea>
            </div>
        </div>
    </section>
@endsection
