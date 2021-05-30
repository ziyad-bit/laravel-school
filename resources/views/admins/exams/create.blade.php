@extends('layouts.adminApp')

@section('header')
    <link rel="stylesheet" href='{{asset("css/admins/exams/create.css")}}'>
@endsection

@section('content')

    <div class="card bg-light mb-3" style="max-width: 24rem;">
        <div class="card-header">Exam</div>
        <div class="card-body">
            <form method="post" action="{{url('admins/exams/store')}}">
                @csrf
                <div class="form-group">
                    <label for="exampleInputname1">name </label>
                    <input type="text" class="form-control" name="name" id="exampleInputname1" aria-describedby="nameHelp">
                    <small style="color:red">
                        @error('name')
                            {{$message}}
                        @enderror
                    </small>
                        
                </div>

                <div class="form-group">
                    <label for="exampleInputname1">number of questions </label>
                    <input type="number" value="0" class="form-control" name="number_of_questions" id="exampleInputname1" aria-describedby="nameHelp">
                    <small style="color:red">
                        @error('number_of_questions')
                            {{$message}}
                        @enderror
                    </small>
                        
                </div>

                <div class="form-group">
                    <label for="exampleInputPassword1">level</label>
                    <select name="level" id="" >
                        <option value="">....</option>
                        @foreach ($levels as $level)
                            <option value="{{$level->id}}">{{$level->name}}</option>
                        @endforeach
                    </select>

                    <small style="color:red">
                        @error('level')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                
                <div class="form-group">
                    <label for="exampleInputPassword1">term</label>
                    <select name="term" id="">
                        <option value="">....</option>
                        <option value="1">frist</option>
                        <option value="2">second</option>
                    </select>

                    <small style="color:red">
                        @error('term')
                            {{$message}}
                        @enderror
                    </small>
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
@endsection