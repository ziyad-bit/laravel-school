@extends('layouts.adminApp')

@section('content')
    @if (Session::has('success'))
    <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    <a class="btn btn-primary" href="{{url('admins/posts/create')}}" style="margin-top: 20px">add post</a>

    <table class="table" style="margin-top: 20px">
        <thead class="thead-dark" >
            <tr>
                <th scope="col">ID</th>
                <th scope="col">post</th>
                <th scope="col">level</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $post)
                <tr>
                    <th scope="row">{{$post->id}}</th>
                    <td>{{$post->post}}</td>
                    <td>{{$post->level_id}}</td>
                    <td>
                        <a href="{{url('admins/posts/edit/'.$post->id)}}" class='btn btn-primary'>
                            edit
                        </a>
                        <a href="{{url('admins/posts/delete/'.$post->id)}}" class='btn btn-danger'>
                            delete
                        </a>
                    </td>
                </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection
