@extends('layouts.adminApp')

@section('content')
@if (Session::has('success'))
<div class="alert alert-success text-center">{{ Session::get('success') }}</div> 
@endif
<div class="d-flex justify-content-center" style="margin-top: 40px">

    <form method="POST" action="{{url('admins/questions/store/'.request('id'))}}">
        @for ($i = 1; $i < $number_of_questions+1; $i++)
        <div class="card bg-light mb-3" style="width: 27rem;">
            <div class="card-header">Question {{$i}}</div>
            <div class="card-body">
                
                    @csrf
                    <div class="form-group">
                        <label for="exampleInputname1">question </label>
                        <input type="text" class="form-control" name="exam[{{$i}}][question]" id="exampleInputname1" aria-describedby="nameHelp">
                        <small style="color:red">
                            @error("exam.$i.question")
                                {{$message}}
                            @enderror
                        </small>
                            
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 1</label>
                        <input type="text" name='exam[{{$i}}][choice1]' class='form-control'>
            
                        <small style="color:red">
                            @error("exam.$i.choice1")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
                    
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 2</label>
                        <input type="text" name='exam[{{$i}}][choice2]' class='form-control'>
            
                        <small style="color:red">
                            @error("exam.$i.choice2")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 3</label>
                        <input type="text" name='exam[{{$i}}][choice3]' class='form-control'>
            
                        <small style="color:red">
                            @error("exam.$i.choice3")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 4</label>
                        <input type="text" name='exam[{{$i}}][choice4]' class='form-control'>
            
                        <small style="color:red">
                            @error("exam.$i.choice4")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">choice 5</label>
                        <input type="text" name='exam[{{$i}}][choice5]' class='form-control'>
            
                        <small style="color:red">
                            @error("exam.$i.choice5")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
            
                    <div class="form-group">
                        <label for="exampleInputPassword1">correct answer</label>
                        <select name="exam[{{$i}}][correct_ans]" id="" class='form-control'>
                            <option value="">....</option>
                            <option value="choice1">choice1</option>
                            <option value="choice1">choice2</option>
                            <option value="choice1">choice3</option>
                            <option value="choice1">choice4</option>
                            <option value="choice1">choice5</option>
                        </select>
            
                        <small style="color:red">
                            @error("exam.$i.correct_ans")
                                {{$message}}
                            @enderror
                        </small>
                    </div>
                    
                
            </div>
            </div>
        @endfor
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>


@endsection