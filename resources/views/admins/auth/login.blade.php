@extends('layouts.adminLogin')

@section('header')
    <link rel="stylesheet" href="{{asset('css/admins/login.css')}}">
@endsection

@if (Session::has('error'))
    <div class="alert alert-danger text-center">{{ Session::get('error') }}</div> 
@endif

@section('content')
    <div class="card text-white bg-dark mb-3 card-login" style="max-width: 18rem;">
        <div class="card-header">Admin Login</div>
        <div class="card-body">
            <form method="POST" action="{{url('admins/login')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" name="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
            
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input type="password" name='password' class="form-control" id="exampleInputPassword1">
                </div>
                
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>

        </div>
    </div>
@endsection
