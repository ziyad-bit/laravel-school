@extends('layouts.adminApp')

@section('content')
    @if (Session::has('success'))
    <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    <a class="btn btn-primary" href="{{url('admins/exams/create')}}">add exam</a>

    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">level</th>
                <th scope="col">term</th>
                <th scope="col">control</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($exams as $exam)
            <tr>
                <th scope="row">{{$exam->id}}</th>
                <td>{{$exam->subject}}</td>
                <td>{{$exam->level_id}}</td>
                <td>{{$exam->term}}</td>
                <td>
                    <a href="{{url('admins/exams/active/'.$exam->id)}}" class='btn btn-primary'>
                        active
                    </a>
                </td>
            </tr>
            @endforeach
            
        </tbody>
    </table>
@endsection
