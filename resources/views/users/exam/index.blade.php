@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/exams/index.css')}}">
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
                <th scope="col">duration </th>
                <th scope="col">control</th>
                
            </tr>
        </thead>
        <tbody>
            @if(isset($exam))
                <tr>
                    <th scope="row">{{$exam->id}}</th>
                    <td>{{$exam->name}}</td>
                    <td>{{$exam->duration}} mins</td>
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
                        <td>{{$exam->duration.' min'}}</td>
                        <td>
                            <a href="{{url('exams/show/'.$exam->token.'?page=1')}}" class='btn btn-primary'>
                                start
                            </a>
                                
                        </td>
                        
                    </tr>
                
                
                @endforeach
            @endif
            
            
        </tbody>
    </table>
@endsection