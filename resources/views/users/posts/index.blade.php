@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/posts/index.css')}}">
@endsection

@section('content')
@foreach ($comments_posts as $comments_post)
    <section class="d-flex justify-content-center">
        
            <div class="card bg-light mb-3" style="max-width: 35rem;">
                <div class="card-header card-top">
                    <img src="{{asset('images/profile/download.png')}}" alt="loading" class="rounded-circle">
                    <span> {{$comments_post->admins->name}}</span>
                    <small>12m</small>
                    <p>
                        {{$comments_post->post}}
                    </p>
                    <small class="number_comments"><span>23 comments</span> </small>
                </div>
                <a href="#{{$comments_post->id}}">
                    <div class="card-body d-flex justify-content-center comment_btn" style="background-color:#eee ">
                        <i class="fas fa-comment"></i>Comment
                    </div>
                </a>
                <div class="card-header card-bottom">
                    <small>view all comments</small>
                    @foreach ($comments_post->comments as $comment)
                        <div class="comment">
                            <img src="{{asset('images/profile/download.png')}}" alt="loading" class="rounded-circle">
                                <span >{{$comment->users->name}}</span>
                                <p>
                                    {{$comment->comment}}
                                </p>
                        </div>
                    @endforeach
                    
                    
                    <img src="{{asset('images/profile/download.png')}}" alt="loading" class="rounded-circle img_input">
                    <textarea name="" id="{{$comments_post->id}}" cols="20" rows="2" class="form-control"></textarea>
                </div>
            </div>
        
        
    </section>
    @endforeach
@endsection
