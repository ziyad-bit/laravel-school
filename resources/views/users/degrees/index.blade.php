@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/degrees/index.css')}}">
@endsection

@section('content')
    @if (Session::has('error'))
        <div class="alert alert-danger text-center">{{ Session::get('error') }}</div> 
    @endif
    
    <table class="table" >
        <thead class="thead-dark">
            <tr>
                <th scope="col">name</th>
                <th scope="col">degree/full degree</th>
                <th scope="col">date</th>
                <th scope="col">control</th>
                
            </tr>
        </thead>
        <tbody>
            @if($exam_degrees)
                @foreach ($exam_degrees as $exam_degree)
                    <tr>
                        <td>{{$exam_degree->name}}</td>

                        @foreach ($exam_degree->degrees as $degree)
                            <td>{{$degree->degrees . '/' . $exam_degree->number_of_questions}}</td>
                            <th scope="row">{{$degree->created_at}}</th>

                            <td>
                                @if ($degree->grievance == 0)
                                    <a href="{{url('paypal/show/'.$degree->id)}}" class='btn btn-primary'>
                                        grievance
                                    </a>
                                @endif
                            
                            </td>
                        @endforeach
                        
                    </tr>
                @endforeach
            @endif
        </tbody>
    </table>
@endsection