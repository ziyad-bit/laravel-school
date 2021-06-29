@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/profile/index.css')}}">
@endsection

@section('content')
<a href="{{url('profile/edit')}}" class="btn btn-primary edit_btn">edit</a>
<div class="d-flex justify-content-center">
    <div class="card mb-3" style="max-width: 70%;">
        <div class="row no-gutters">
        <div class="col-md-4">
            <img src="{{asset('images/profile/'.Auth::user()->photo)}}" alt="loading">
        </div>
        <div class="col-md-8">
            
                <ul class="list-group">
                    <li class="list-group-item active" aria-current="true"><h4>My profile</h4> </li>
                    <li class="list-group-item"> <span>name</span> : {{Auth::user()->name}} </li>
                    <li class="list-group-item"><span>email</span> : {{Auth::user()->email}}</li>
                    <li class="list-group-item"><span class="profile_span">level</span>  : {{Auth::user()->level_id}}</li>
                    <li class="list-group-item"><span class="profile_span">term</span>   : {{Auth::user()->term}}</li>
                </ul>
            
        </div>
        </div>
    </div>
</div>
    
@endsection