@extends('layouts.adminApp')

@section('content')

    @if (Session::has('success'))
        <div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
    @endif

    @if (Session::has('error'))
        <div class="alert alert-success text-center">{{ Session::get('error') }}</div> 
    @endif

<div class="d-flex justify-content-center" style="margin-top: 40px">

    <form method="POST" action="{{url('admins/questions/update/'.$questions->id)}}">
        
        <div class="card bg-light mb-3" style="width: 27rem;">
            <div class="card-header">Question </div>
            <div class="card-body">
                
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputname1">question </label>
                        <input type="text" class="form-control" value="{{$questions->question}}" name="question" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error("question")
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 1</label>
                        <input type="text" name='choice1' value="{{$questions->choice1}}" class='form-control'>
            
                        <small style="color:red">
                            @error("choice1")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 2</label>
                        <input type="text" name='choice2' value="{{$questions->choice2}}" class='form-control'>
            
                        <small style="color:red">
                            @error("choice2")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 3</label>
                        <input type="text" name='choice3' value="{{$questions->choice3 ? $questions->choice3 : null }}" class='form-control'>
            
                        <small style="color:red">
                            @error("choice3")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 4</label>
                        <input type="text" name='choice4' value="{{$questions->choice4 ? $questions->choice4 : null }}" class='form-control'>
            
                        <small style="color:red">
                            @error("choice4")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 5</label>
                        <input type="text" name='choice5' value="{{$questions->choice5 ? $questions->choice5 : null }}" class='form-control'>
            
                        <small style="color:red">
                            @error("choice5")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">correct answer</label>
                        <select name="correct_ans"  class='form-control'>
                            <option value="choice1" {{$questions->correct_ans == 'choice1' ? 'selected' : null }}>choice1</option>
                            <option value="choice2" {{$questions->correct_ans == 'choice2' ? 'selected' : null }}>choice2</option>
                            <option value="choice3" {{$questions->correct_ans == 'choice3' ? 'selected' : null }}>choice3</option>
                            <option value="choice4" {{$questions->correct_ans == 'choice4' ? 'selected' : null }}>choice4</option>
                            <option value="choice5" {{$questions->correct_ans == 'choice5' ? 'selected' : null }}>choice5</option>
                        </select>
            
                        <small style="color:red">
                            @error("correct_ans")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
                    
                
            </div>
            </div>
        
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection