@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{asset('css/users/home/index.css')}}">
    <link rel="stylesheet" href="{{asset('css/users/posts/index.css')}}">
@endsection

@section('content')
    <!--       delete comment modal        -->
    <div class="modal fade" id="delete_modal" tabindex="-1" aria-labelledby="delete_modalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="delete_modalLabel">Modal title</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Are you want to delete this comment ?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                    <button type="button" id="delete_btn" comment_id='' data-dismiss="modal" class="btn btn-danger">delete</button>
                </div>
            </div>
        </div>
    </div>

                        <!--       edit comment modal        -->
    <div class="modal fade" id="edit_modal" tabindex="-1" aria-labelledby="delete_modalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="edit_modal">  Edit comment </h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success text-center" style="display: none"></div>
                <div id="update_input" class="form-control" contenteditable="true"></div>
                <small style="color: red; display:none"></small>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">cancel</button>
                <button type="button" id="update_btn" comment_id=''  class="btn btn-primary">update</button>
            </div>
        </div>
    </div>
    </div>

    <img src="{{asset('images/home4.jpg')}}" alt="" class="land_img">
    
    <h3 class="text-center">Pinned  posts</h3>
    
    @foreach ($fixed_comments_posts as $fixed_comments_post)
                <!--     fixed posts     -->
<section class="d-flex justify-content-center" >
    
        <div class="card bg-light mb-3" style="max-width: 35rem;">

                <!--      card top      -->

            <div class="card-header card-top">
                <img src="{{asset('images/profile/'.$fixed_comments_post->admins->photo)}}" alt="loading" class="rounded-circle">
                <span> {{$fixed_comments_post->admins->name}}</span>
                <small>{{diff_date($fixed_comments_post->created_at)}}</small>
                <p>
                    {{$fixed_comments_post->post}}
                </p>

                @if ($fixed_comments_post->file)
                <a href="{{url('posts/download/'.$fixed_comments_post->file)}}" class="btn btn-primary">
                    <i class="fas fa-arrow-down"></i>{{ strstr($fixed_comments_post->file,'-')}}
                </a>
                    <embed src="{{asset('files/'.$fixed_comments_post->file)}}" >
                @endif

                @if ($fixed_comments_post->photo)
                    <img src="{{asset('images/posts/'.$fixed_comments_post->photo)}}" alt="loading" class="image">
                @endif

                @if ($fixed_comments_post->video)
                    <video src="{{asset('videos/'.$fixed_comments_post->video)}}" controls ></video>
                @endif
                
                <small class="number_comments"><span>{{$fixed_comments_post->comments_count}} comments</span> </small>
            </div>
            <a class="comment_link"   post_id={{$fixed_comments_post->id}}>
                <div class="card-body d-flex justify-content-center comment_btn" id="{{$fixed_comments_post->id}}" style="background-color:#eee ">
                    <i class="fas fa-comment"></i>Comment
                </div>
            </a>

            <!--      card bottom      -->
            <div class="card-header card-bottom">
                @if ($fixed_comments_post->comments_count != 0)
                    <small class=" {{'view_comments '.$fixed_comments_post->id}}" id="{{'view'.$fixed_comments_post->id}}" >view all comments</small>
                @endif
                
                @foreach ($fixed_comments_post->comments as $comment)
                    <div class="{{'comment com'.$fixed_comments_post->id}}" id="{{'comm'.$comment->id}}" style="display: none">
                        @if ($comment->users->photo)
                            <img src="{{asset('images/profile/'.$comment->users->photo)}}" alt="loading" class="rounded-circle">
                            <span >{{$comment->users->name}}</span>
                        @else
                            <img src="{{asset('images/profile/'.$comment->admins->photo)}}" alt="loading" class="rounded-circle">
                            <span >{{$comment->admins->name}}</span>
                        @endif
                        
                        <small>{{diff_date($comment->created_at)}}</small> 
                        
                        <p>
                            
                            <span>{{$comment->comment}}</span>
                            @if ($comment->user_id == Auth::user()->id)
                                <i id="{{$comment->id}}" data-toggle="modal" data-target="#delete_modal" class="fas fa-trash"></i>
                                <i  data-toggle="modal" data-target="#edit_modal" class="{{'fas fa-edit '.$comment->id}}"></i>
                            @endif
                            
                        </p>
                        
                    </div>
                @endforeach
                <form id="{{'form_comment'.$fixed_comments_post->id}}" class="form_comment">
                    @csrf
                    <img src="{{asset('images/profile/'.Auth::user()->photo)}}" alt="loading" class="rounded-circle img_input">
                    <textarea name="comment" post_id="{{$fixed_comments_post->id}}" id="{{'input'.$fixed_comments_post->id}}" cols="20" rows="2" class="form-control input"></textarea>
                    <input type="hidden" name="post_id" value="{{$fixed_comments_post->id}}">
                    <small style="color: red; display:none"></small>
                </form>
            </div>
        </div>
    
</section>
@endforeach
@endsection

@section('script')
    <script>
        //scroll to comment_input
        function generalEventListener(type, selector, callback) {
            document.addEventListener(type, e => {
                if (e.target.matches(selector)) {
                    callback(e)
                }
            })
        }

        generalEventListener('click', '.comment_btn', e => {
            let id    = e.target.id,
                input = document.getElementById('input' + id);

            input.scrollIntoView({
                behavior: 'smooth',
                block   : 'center'
            });
            input.focus()
        })

        
        //edit comment
        generalEventListener('click', '.fa-edit', e => {
            let id           = e.target.classList[2],
                comment      = document.querySelector('#comm'+id+' p span').textContent,
                update_btn   = document.getElementById('update_btn'),
                update_input = document.querySelector('#update_input');

            update_btn.setAttribute('comment_id',id)
            update_input.textContent = comment;
        })

        
        //update comment
        let update_btn         = document.getElementById('update_btn')
            update_btn.onclick = function(){
                let id              = this.getAttribute('comment_id'),
                    comment         = document.querySelector('#update_input').textContent,
                    old_comment     = document.querySelector('#comm'+id+' p span'),
                    success_element = document.querySelector('.modal-body .alert-success'),
                    update_request  = new XMLHttpRequest();

            update_request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    success_element.style.display = '';
                    setTimeout(()=>{
                        success_element.style.display = 'none';
                    },3000)

                    success_element.textContent = 'you updated successfully it';
                    old_comment.textContent     = comment;
                    comment.textContent         = ''
                }

                if (this.readyState == 4 && this.status != 200) {
                    let res           = JSON.parse(this.responseText),
                        error_element = document.querySelector('.modal-body small'),
                        error         = res.errors.comment[0];

                    error_element.style.display='';
                    setTimeout(()=>{
                        error_element.style.display = 'none';
                    },3000)

                    error_element.textContent=error;
                }
            }

            data = {
                'id'     : id,
                'comment': comment
            }

            update_request.open('post', "{{ url('comments/update') }}");
            update_request.setRequestHeader('content-type', 'application/json');
            update_request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            update_request.send(JSON.stringify(data));
        }
        

        //delete comment
        generalEventListener('click', '#delete_btn', e => {
            let delete_btn     = document.getElementById('delete_btn'),
                id             = delete_btn.getAttribute('comment_id'),
                delete_request = new XMLHttpRequest();

            delete_request.onreadystatechange = function() {
                if (this.readyState == 4 && this.status == 200) {
                    let comment = document.getElementById('comm'+id);
                    comment.remove();
                }
            }

            data = {
                'id': id
            }

            delete_request.open('post', "{{ url('comments/delete') }}");
            delete_request.setRequestHeader('content-type', 'application/json');
            delete_request.setRequestHeader("X-CSRF-TOKEN", "{{ csrf_token() }}");
            delete_request.send(JSON.stringify(data));
        })

        generalEventListener('click', '.fa-trash', e => {
            let id         = e.target.id,
                delete_btn = document.getElementById('delete_btn');

            delete_btn.setAttribute('comment_id',id);
        })


        //post comments
        $('body').on('keypress', '.input', function(e) {
            let id = $(this).attr('post_id');

            let formData = new FormData($('#form_comment' + id)[0])
            if (e.keyCode == 13) {
                e.preventDefault();

                $.ajax({
                    type       : "post",
                    url        : "{{ url('comments/store') }}",
                    data       : formData,
                    processData: false,
                    contentType: false,
                    cache      : false,
                    success    : function(data, status) {
                        if (status == 'success') {
                            let post_id = data.post_id,
                                view    = data.view,
                                input   = document.getElementById('input'+id);
                            
                            input.value = '';
                            
                            $(view).insertBefore('#form_comment' + post_id);
                        }
                    },
                    error:function(res){
                        let response      = $.parseJSON(res.responseText),
                            post_id       = response.post_id,
                            error         = response.errors.comment[0],
                            error_element = $('#form_comment'+post_id+' small');

                        error_element.show();
                        setTimeout(e=>{
                            error_element.hide();
                        },3000)
                        
                        error_element.text(error);
                    }
                });
            }
        });


        //view comments
        generalEventListener('click','.view_comments',e=>{
            let id            = e.target.classList[1];
                view_comments = document.getElementById('view'+id)
                comments      = document.getElementsByClassName('com' + id);

            for (let i = 0; i < comments.length; i++) {
                if (comments[i].style.display === 'none') {
                    comments[i].style.display = '';
                    view_comments.textContent = 'hide all comments';
                } else {
                    comments[i].style.display = 'none';
                    view_comments.textContent = 'view all comments';
                }
            }
        })

    </script>
@endsection
