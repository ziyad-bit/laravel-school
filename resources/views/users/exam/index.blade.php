@extends('layouts.app')

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div> 
    @endif
    <table class="table">
        <thead class="thead-dark">
            <tr>
                <th scope="col">ID</th>
                <th scope="col">name</th>
                <th scope="col">control</th>
                
            </tr>
        </thead>
        <tbody>
            @if(isset($exam))
                <tr>
                    <th scope="row">{{$exam->id}}</th>
                    <td>{{$exam->name}}</td>
                    <td>
                        <a href="{{url('exams/show/'.$exam->token.'?page='.$page)}}" class='btn btn-primary'>
                            continue
                        </a>
                    </td>
                    
                </tr>
            @else
                @foreach ($exams as $exam)
                <tr>
                    <th scope="row">{{$exam->id}}</th>
                    <td>{{$exam->name}}</td>
                    <td>
                        <a href="{{url('exams/show/'.$exam->token)}}" class='btn btn-primary'>
                            start
                        </a>
                    </td>
                    
                </tr>
                @endforeach
            @endif
            
            
        </tbody>
    </table>
@endsection