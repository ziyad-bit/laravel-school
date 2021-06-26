@extends('layouts.app')

@section('header')
    <link rel="stylesheet" href="{{ asset('css/users/posts/index.css') }}">
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

    <div id="more_posts">
        @include('users.posts.all_posts')
    </div>

    <div id="load" style="display: none;color: #0070ba" class="d-flex justify-content-center">
        <div class="spinner-border text-primary" style="margin-right: 5px" role="status">
            <span class="sr-only">Loading...</span>
        </div>
        <span id="posts_end">loading ...</span>
    </div>
    
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


        //infinite scroll
        function loadMore(page) {
            $.ajax({
                type: "get",
                url : '?page=' + page,
                data: {
                    'agax': 1,
                },
                beforeSend: function() {
                    $('#load').show()
                }

            }).done(function(response) {
                let posts = response.view
                if (posts == '') {
                    $('#load').text('no more posts')
                    return
                }

                $('#more_posts').append(posts)
                $('#load').hide()

            })
        }

        let page = 1;
        $(window).scroll(function() {
            if ($('#load').text() != 'no more posts') {
                if ($(window).scrollTop() + $(window).height() >= $(document).height()) {
                    page++
                    loadMore(page)
                }
            }

        });


        /*
        function loadMore(page){
            let posts_request                    = new XMLHttpRequest();
                posts_request.onreadystatechange = function(){
                if(this.readyState == 4 && this.status == 200){
                    let res   = JSON.parse(this.responseText);
                    let posts = res.view;
                    let load  = document.getElementById('load');
                    
                    if(posts == ''){
                        document.getElementById('posts_end').className = 'posts_end';
                                                load.textContent       = 'no more posts';
                        return
                    }
                    
                    let more_posts = document.getElementById('more_posts');
                    more_posts.insertAdjacentHTML('afterend',posts);
                    load.style.display = 'none';
                }
            }

                let agax     = document.getElementById('agax');
                let formData = new FormData(agax);

                posts_request.open('post','?page='+page);
                posts_request.send(formData)
            
            
        }
        
        var body = document.body,
            html = document.documentElement;

        var height = Math.max( body.scrollHeight, body.offsetHeight, 
                        html.clientHeight, html.scrollHeight, html.offsetHeight );
        console.log(document.getElementById('posts_end').className)
        console.log(window.scrollY+ window.innerHeight +height)
        console.log($(window).scrollTop()+$(window).height() + $(document).height())

        let page = 1
        
            window.onscroll=function(){
                let load = document.getElementById('load');
                if (document.getElementById('posts_end').className!='posts_end') {
                    if(window.scrollY + window.innerHeight >= height){
                    
                    
                    load.style.display = '';
                    page++;
                    loadMore(page);
                    }
                }
                
            }
            
        
        */

    </script>
@endsection
