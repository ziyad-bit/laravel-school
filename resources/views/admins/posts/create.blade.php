@extends('layouts.adminApp')

@section('header')
    <link rel="stylesheet" href='{{ asset('css/admins/exams/create.css') }}'>
@endsection

@section('content')
    <!--    post form   -->
    <div class="d-flex justify-content-center">
        <div class="card bg-light mb-3 " style="max-width:24rem;margin-top: 40px">
            <div class="card-header">Post</div>
            <div class="card-body">
                <form id="post_form" action="{{ url('admins/posts/store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
    
                    <div class="form-group">
                        <label for="exampleInputname1">text </label>
                        <textarea name="post" class="form-control" cols="15" rows="5"></textarea>
                        <small style="color:red" id="post_err">
                            
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">photo </label>
                        <input type="file" name="photo" class="form-control">
                        <small style="color:red" id="photo_err">
                            
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">file </label>
                        <input type="file" name="file" class="form-control">
                        <small style="color:red" id="file_err">
                          
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputname1">video </label>
                        <input type="file" name="video" class="form-control">
                        <small style="color:red" id="video_err">
                           
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputPassword1">level</label>
                        <select name="level" class="form-control">
                            <option value="">....</option>
                            @foreach ($levels as $level)
                                <option value="{{ $level->id }}">{{ $level->name }}</option>
                            @endforeach
                        </select>
    
                        <small style="color:red" id="level_err">
                            
                        </small>
                    </div>
    
                    <div class="form-group">
                        <label for="exampleInputPassword1">fixed</label>
                        <select name="fixed" class="form-control">
                            <option value="">....</option>
                            <option value="1">yes</option>
                            <option value="0">no</option>
                        </select>
    
                        <small style="color:red" id="fixed_err">
                           
                        </small>
                    </div>
                    <button type="submit" class="btn btn-primary submit_btn">Submit</button>
                </form>
            </div>
        </div>
    </div>
    
    <!--    progress bar    -->
    <div class="progress text-center" style="display: none;margin-bottom: 40px">
        <div class="progress-bar " role="progressbar" aria-valuenow="0" aria-valuemin="0" aria-valuemax="100"
            style="width: 0%;">
        </div>
    </div>

    <div class="alert alert-success text-center" style="display: none">
        you successfully created the post
    </div>
@endsection

@section('script')
    <script>
        // upload form and show progress bar
        $(function() {
            let progress_bar = $('.progress-bar');
            let progress = $('.progress')
            $('form').ajaxForm({
                beforeSend: function() {
                    progress.show()
                    document.getElementsByClassName('progress')[0].scrollIntoView({
                        behavior: 'smooth',
                        block: 'center'
                    });
                },
                uploadProgress: function(event, position, total, percent) {
                    progress_bar.text(percent + ' %   wait until a successful message appears');
                    progress_bar.css('width', percent + '%');
                },
                success: function(data, status) {
                    if (status == 'success') {
                        progress.hide()
                        $('.alert-success').show()
                    }
                },
                error: function(res) {
                    progress.hide()
                    let response = $.parseJSON(res.responseText);
                    $.each(response.errors, function(key, value) {
                        $("#" + key + "_err").text(value[0]);
                    })
                }
            });
        });

    </script>
@endsection
