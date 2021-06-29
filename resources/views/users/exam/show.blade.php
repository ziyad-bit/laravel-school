@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset(url('css/users/exams/show.css'))}}">
@endsection

@section('content')

<div class="alert alert-success text-center" id="success" style="display: none"></div>
<div class="alert alert-danger text-center" id="exam_finish" style="display: none"></div>

<div class="parent">
    <div class="parent2 d-flex justify-content-center ">
        <form  id="questionForm">
            @foreach ($questions as $question)
            <div class="card bg-light mb-3" style="max-width: 40rem;">
                <div class="card-header"><span><span style="font-size: 20px;">{{$page_req=request('page')}}- </span>{{$question->question}}</span>  ?</div>
                <div class="card-body">
                    
                        @csrf
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="choice" value="choice1"
                                    > {{$question->choice1}}
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input type="radio" class="form-check-input" name="choice" value="choice2"
                                    > {{$question->choice2}}
                            </label>
                        </div>
                        @if ($question->choice3)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="choice" value="choice3"
                                        > {{$question->choice3}}
                                </label>
                            </div>
                        @endif
                        @if ($question->choice4)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="choice" value="choice4"
                                        > {{$question->choice4}}
                                </label>
                            </div>
                        @endif
                        @if ($question->choice5)
                            <div class="form-check">
                                <label class="form-check-label">
                                    <input type="radio" class="form-check-input" name="choice" value="choice5"
                                        > {{$question->choice5}}
                                </label>
                            </div>
                        @endif
                        <input type="hidden" name='id' value="{{$question->id}}">
                        <input type="hidden" name="token" value="{{request('token')}}">
                        <input type="hidden" name="agax" value="1">
                </div>
            </div>
            @endforeach
            <button type="submit" class="btn btn-primary" >next</button>
            </form>
    </div>
    </div>
    

@endsection

@section('script')
    <script>
            function loadMore(page){
                let formData = new FormData($('#questionForm')[0]);
                formData.append('page',page);
                $.ajax({
                type       : "post",
                url        : '?page='+page,
                data       : formData,
                processData: false,
                contentType: false,
                cache      : false,
                success : function (data,status) {
                    if(status=='success'){
                        let degree    = data.degree,
                            questions = data.html,
                            parent2   = $('.parent2'),
                            success   = $('#success');

                        if(questions == ''){
                            success.show();
                            success.text('you finished the exam and you get '+ degree +'/'+ (page-1));
                            
                            parent2.remove();
                            return
                        }

                        parent2.remove();
                        $('.parent').append(questions);
                    }
                },
                error:function(res){
                    let response=$.parseJSON(res.responseText);
                    let error=response.error;
                    let finish=$('#exam_finish');

                    finish.show();
                    finish.text(error);
                }
            });
            }
            
            let page="{{request('page')}}"

            if(page){
                null;
            }else{
                page=1;
            }
            
            $('body').on('click','.btn-primary',function(e){
                e.preventDefault();
                page++;
                loadMore(page);
            })
        
    </script>
@endsection