@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/subjects/index.css')}}">
@endsection

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div> 
    @endif
    <table class="table" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">subject</th>
                <th scope="col">control</th>
                
            </tr>
        </thead>
        <tbody>
            @if(isset($subjects))
                @foreach ($subjects as $subject)
                    <tr>
                        <th scope="row">{{$subject->id}}</th>
                        <td>{{$subject->name}}</td>
                        <td>
                            <a href="{{url('degrees/get/'.$subject->id)}}" class='btn btn-primary'>
                                degrees
                            </a>
                        </td>
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection