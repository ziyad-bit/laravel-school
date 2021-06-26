@extends('layouts.adminApp')

@section('header')
    <link rel="stylesheet" href='{{asset("css/admins/exams/create.css")}}'>
@endsection


@section('content')
    @if (Session::has('success'))
    <div class="alert alert-success text-center">{{ Session::get('success') }}</div>
    @endif

    @if (Session::has('error'))
    <div class="alert alert-danger text-center">{{ Session::get('error') }}</div>
    @endif

    <div class="d-flex justify-content-center" style="margin-top: 40px">
        <div class="card bg-light mb-3" style="width: 27rem;">
            <div class="card-header">Exam</div>
            <div class="card-body">
                <form method="post" action="{{url('admins/exams/store')}}">
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputname1">name of subject </label>
                        <select name="subject_id" id="" class="form-control" required>
                            <option value="">....</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}">{{$subject->name}}</option>
                            @endforeach
                        </select>
                        <small style="color:red">
                            @error('subject')
                                {{$message}}
                            @enderror
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputname1">name of exam </label>
                        <select name="name" id="" class="form-control" required>
                            <option value="">....</option>
                            
                            <option value="quiz1">quiz1</option>
                            <option value="quiz2">quiz2</option>
                            <option value="quiz3">quiz3</option>
                            <option value="final">final</option>
                        </select>
                        <small style="color:red">
                            @error('subject')
                                {{$message}}
                            @enderror
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">number of questions </label>
                        <input type="number" value="0" required min="1" max="500" class="form-control" name="number_of_questions" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error('number_of_questions')
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">duration in minutes </label>
                        <input type="number" value="0" min="1" required class="form-control" name="duration" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error('duration')
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">date </label>
                        <input type="datetime-local" value="0" required class="form-control" name="date" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error('date')
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputPassword1">level</label>
                        <select name="level" id="" class="form-control" required>
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
                        <select name="term" class="form-control" required>
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
    </div>
@endsection
