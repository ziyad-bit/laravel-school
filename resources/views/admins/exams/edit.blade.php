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
                <form method="post" action="{{url('admins/exams/update/'.$exam->id)}}">
                    @csrf
                    <input type="hidden" value="1" name="id">
                    <div class="form-group">
                        <label for="exampleInputname1">name of subject </label>
                        <select name="subject_id"  class="form-control" required >
                            <option value="" >....</option>
                            @foreach ($subjects as $subject)
                                <option value="{{$subject->id}}"  {{$exam->subject_id == $subject->id ? 'selected' : null}}>{{$subject->name}}</option>
                            @endforeach
                        </select>
                        <small style="color:red">
                            @error('subject_id')
                                {{$message}}
                            @enderror
                        </small>
                    </div>

                    <div class="form-group">
                        <label for="exampleInputname1">name of exam </label>
                        <select name="name" id=""  class="form-control" required>
                            <option value="">....</option>
                            
                            <option value="quiz1" {{$exam->name == 'quiz1' ? 'selected' : null}}>quiz1</option>
                            <option value="quiz2" {{$exam->name == 'quiz2' ? 'selected' : null}}>quiz2</option>
                            <option value="quiz3" {{$exam->name == 'quiz3' ? 'selected' : null}}>quiz3</option>
                            <option value="final" {{$exam->name == 'final' ? 'selected' : null}}>final</option>
                        </select>
                        <small style="color:red">
                            @error('name')
                                {{$message}}
                            @enderror
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">duration in minutes </label>
                        <input type="number" value="{{$exam->duration}}" required min="1" class="form-control" name="duration" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error('duration')
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">date </label>
                        <input type="datetime-local" value="{{ date('Y-m-d\TH:i', strtotime($exam->date)) }}"  class="form-control" name="date" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error('date')
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputPassword1">level</label>
                        <select name="level"  class="form-control" required>
                            <option value="">....</option>
                            @foreach ($levels as $level)
                                <option value="{{$level->id}}" {{$exam->level_id == $level->id ? 'selected' : null}}>{{$level->name}}</option>
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
                        <select name="term" value="{{$exam->term}}" class="form-control" required>
                            <option value="">....</option>
                            <option value="1" {{$exam->term == '1' ? 'selected' : null}}>frist</option>
                            <option value="2" {{$exam->term == '2' ? 'selected' : null}}>second</option>
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
