@extends('layouts.app')

@section('header')
    
@endsection

@section('content')
    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    @if (Session::has('error'))
        <div class="alert alert-success text-center">{{ Session::get('error') }}</div> 
    @endif

    <!--    edit profile form   -->
    <div class="d-flex justify-content-center">
        <div class="card bg-light mb-3 " style="max-width:24rem;margin-top: 150px">
            <div class="card-header">Edit profile</div>
            <div class="card-body">
                <form id="post_form" action="{{ url('profile/update') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <div class="form-group">
                        <label for="exampleInputname1">email </label>
                        <input type="email" value="{{Auth::user()->email}}" name="email" class="form-control">
                        <small style="color:red" id="post_err">
                            
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">photo </label>
                        <input type="file" name="photo" class="form-control">
                        <small style="color:red" id="photo_err">
                            
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary">submit</button>
                </form>
@endsection



