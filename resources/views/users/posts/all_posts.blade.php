@if($fixed_comments_posts)
    @foreach ($fixed_comments_posts as $fixed_comments_post)

        <!--     fixed posts     -->
        <section class="d-flex justify-content-center">
            <div class="card bg-light mb-3" style="max-width: 35rem;">

                <!--      card top      -->
                <div class="card-header card-top">
                    <img src="{{ asset('images/profile/' . $fixed_comments_post->admins->photo) }}" alt="loading"
                        class="rounded-circle">
                    <span> {{ $fixed_comments_post->admins->name }}</span>
                    <!-- diff_date is autoloaded from app\helper\general -->
                    <small>{{ diff_date($fixed_comments_post->created_at) }}</small>
                    <p>
                        {{ $fixed_comments_post->post }}
                    </p>

                    @if ($fixed_comments_post->file)
                        <a href="{{ url('posts/download/' . $fixed_comments_post->file) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-down"></i>{{ strstr($fixed_comments_post->file, '-') }}
                        </a>
                        <embed src="{{ asset('files/' . $fixed_comments_post->file) }}">
                    @endif

                    @if ($fixed_comments_post->photo)
                        <img src="{{ asset('images/posts/' . $fixed_comments_post->photo) }}" alt="loading" class="image">
                    @endif

                    @if ($fixed_comments_post->video)
                        <video src="{{ asset('videos/' . $fixed_comments_post->video) }}" controls></video>
                    @endif

                    <small class="number_comments"><span>{{ $fixed_comments_post->comments_count }} comments</span> </small>
                </div>
                <a class="comment_link" post_id={{ $fixed_comments_post->id }}>
                    <div class="card-body d-flex justify-content-center comment_btn" id="{{ $fixed_comments_post->id }}"
                        style="background-color:#eee ">
                        <i class="fas fa-comment"></i>Comment
                    </div>
                </a>

                <!--      card bottom      -->
                <div class="card-header card-bottom">
                    @if ($fixed_comments_post->comments_count != 0)
                        <small class=" {{ 'view_comments ' . $fixed_comments_post->id }}"
                            id="{{ 'view' . $fixed_comments_post->id }}">view all comments</small>
                    @endif

                    @foreach ($fixed_comments_post->comments as $comment)
                        <div class="{{ 'comment com' . $fixed_comments_post->id }}" id="{{ 'comm' . $comment->id }}"
                            style="display: none">
                            @if ($comment->users->photo)
                                <img src="{{ asset('images/profile/' . $comment->users->photo) }}" alt="loading"
                                    class="rounded-circle">
                                <span>{{ $comment->users->name }}</span>
                            @else
                                <img src="{{ asset('images/profile/' . $comment->admins->photo) }}" alt="loading"
                                    class="rounded-circle">
                                <span>{{ $comment->admins->name }}</span>
                            @endif

                            <small>{{ diff_date($comment->created_at) }}</small>

                            <p>

                                <span>{{ $comment->comment }}</span>
                                @if ($comment->user_id == Auth::user()->id)
                                    <i id="{{ $comment->id }}" data-toggle="modal" data-target="#delete_modal"
                                        class="fas fa-trash"></i>
                                    <i data-toggle="modal" data-target="#edit_modal"
                                        class="{{ 'fas fa-edit ' . $comment->id }}"></i>
                                @endif

                            </p>

                        </div>
                    @endforeach
                    <form id="{{ 'form_comment' . $fixed_comments_post->id }}" class="form_comment">
                        @csrf
                        <img src="{{ asset('images/profile/' . Auth::user()->photo) }}" alt="loading"
                            class="rounded-circle img_input">
                        <textarea name="comment" post_id="{{ $fixed_comments_post->id }}"
                            id="{{ 'input' . $fixed_comments_post->id }}" cols="20" rows="2"
                            class="form-control input"></textarea>
                        <input type="hidden" name="post_id" value="{{ $fixed_comments_post->id }}">
                        <small style="color: red; display:none"></small>
                    </form>
                </div>
            </div>

        </section>
    @endforeach
@endif

@if($not_fixed_comments_posts)
    @foreach ($not_fixed_comments_posts as $comments_post)

        <!--    not fixed posts     -->
        <section class="d-flex justify-content-center" >
            <div class="card bg-light mb-3" style="max-width: 35rem;">

                <!--      card top      -->
                <div class="card-header card-top">
                    <img src="{{ asset('images/profile/' . $comments_post->admins->photo) }}" alt="loading"
                        class="rounded-circle">
                    <span> {{ $comments_post->admins->name }}</span>
                    <small>{{ diff_date($comments_post->created_at) }}</small>
                    <p>
                        {{ $comments_post->post }}
                    </p>

                    @if ($comments_post->file)
                        <a href="{{ url('posts/download/' . $comments_post->file) }}" class="btn btn-primary">
                            <i class="fas fa-arrow-down"></i>{{ strstr($comments_post->file, '-') }}
                        </a>
                        <iframe src="{{ asset('files/' . $comments_post->file) }}" frameborder="0"></iframe>
                        <!-- <embed src="{{ asset('files/' . $comments_post->file) }}"> -->
                    @endif

                    @if ($comments_post->photo)
                        <img src="{{ asset('images/posts/' . $comments_post->photo) }}" alt="loading" class="image">
                    @endif

                    @if ($comments_post->video)
                        <video src="{{ asset('videos/' . $comments_post->video) }}" controls></video>
                    @endif

                    <small class="number_comments"><span>{{ $comments_post->comments_count }} comments</span> </small>
                </div>
                <a class="comment_link" post_id={{ $comments_post->id }}>
                    <div class="card-body d-flex justify-content-center comment_btn" id="{{ $comments_post->id }}"
                        style="background-color:#eee ">
                        <i class="fas fa-comment"></i>Comment
                    </div>
                </a>

                <!--      card bottom      -->
                <div class="card-header card-bottom">
                    @if ($comments_post->comments_count != 0)
                        <small class=" {{ 'view_comments ' . $comments_post->id }}"
                            id="{{ 'view' . $comments_post->id }}">view all comments</small>
                    @endif

                    @foreach ($comments_post->comments as $comment)
                        <div class="{{ 'comment com' . $comments_post->id }}" id="{{ 'comm' . $comment->id }}"
                            style="display: none">
                            @if (isset($comment->users->photo))
                                <img src="{{ asset('images/profile/' . $comment->users->photo) }}" alt="loading"
                                    class="rounded-circle">
                                <span>{{ $comment->users->name }}</span>
                            @else
                                <img src="{{ asset('images/profile/' . $comment->admins->photo) }}" alt="loading"
                                    class="rounded-circle">
                                <span>{{ $comment->admins->name }}</span>
                            @endif

                            <small>{{ diff_date($comment->created_at) }}</small>

                            <p>

                                <span>{{ $comment->comment }}</span>
                                @if ($comment->user_id == Auth::user()->id)
                                    <i id="{{ $comment->id }}" data-toggle="modal" data-target="#delete_modal"
                                        class="fas fa-trash"></i>
                                    <i data-toggle="modal" data-target="#edit_modal"
                                        class="{{ 'fas fa-edit ' . $comment->id }}"></i>
                                @endif

                            </p>

                        </div>
                    @endforeach
                    <form id="{{ 'form_comment' . $comments_post->id }}">
                        @csrf
                        <img src="{{ asset('images/profile/' . Auth::user()->photo) }}" alt="loading"
                            class="rounded-circle img_input">
                        <textarea name="comment" post_id="{{ $comments_post->id }}" id="{{ 'input' . $comments_post->id }}"
                            cols="20" rows="2" class="form-control input"></textarea>
                        <input type="hidden" name="post_id" value="{{ $comments_post->id }}">
                        <small style="color: red;display: none"></small>
                    </form>
                </div>
            </div>

        </section>
    @endforeach
    
@endif
