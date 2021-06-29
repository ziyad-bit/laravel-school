<?php

namespace App\Http\Controllers\admins;

use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
use App\model\{Posts,Subjects,Levels};
use App\Traits\{UploadFile,UploadImage};
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    use UploadImage;
    use UploadFile;

    public function __construct()
    {
        $this->middleware('auth:admins');
    }

    ###################################       index           ###############################
    public function index()
    {
        $posts    = Posts::selection()->get();

        return view('admins.posts.index', compact('posts'));
    }

    ###################################       create           ###############################
    public function create()
    {
        $levels = Levels::selection()->get();
        $subjects = Subjects::selection()->get();

        return view('admins.posts.create', compact('levels','subjects'));
    }

    ###################################       store           ###############################
    public function store(PostRequest $request)
    {
        $image_name = null;
        $image = $request->file('photo');
        if ($image) {
            $image_name = $this->uploadphoto($image, 'images/posts/');
        }

        $file_name = null;
        $file = $request->file('file');
        if ($file) {
            $file_name = $this->uploadFile($file, 'files');
        }

        $video_name = null;
        $video = $request->file('video');
        if ($video) {
            $video_name = $this->uploadFile($video, 'videos');
        }

        $post_s       = filter_var($request->post, FILTER_SANITIZE_STRING);
        $video_name_s = filter_var($video_name   , FILTER_SANITIZE_STRING);
        $image_name_s = filter_var($image_name   , FILTER_SANITIZE_STRING);
        $file_name_s  = filter_var($file_name    , FILTER_SANITIZE_STRING);

        Posts::create([
            'photo'    => $image_name_s,
            'video'    => $video_name_s,
            'post'     => $post_s,
            'fixed'    => $request->fixed,
            'subject'  => $request->subject,
            'level_id' => $request->level,
            'file'     => $file_name_s,
            'admin_id' => Auth::user()->id,
        ]);

        return response()->json();
    }

    ###################################      delete       #####################################
    public function delete($id)
    {
        $post = Posts::find($id);
        if (!$post) {
            return redirect()->back()->with(['error' => 'not found']);
        }

        $post->delete();
        return redirect()->back()->with(['success' => 'you successfully deleted it']);
    }

    ###################################      edit       #####################################
    public function edit($id)
    {
        $levels = Levels::selection()->get();
        $post   = Posts::find($id);

        if (!$post) {
            return redirect()->back()->with(['error' => 'not found']);
        }

        return view('admins\posts\edit', compact('post','levels'));
    }

    ###################################      update       #####################################
    public function update($id ,PostRequest $request)
    {
        $post   = Posts::find($id);
        if (!$post) {
            return redirect()->back()->with(['error' => 'not found']);
        }

        $image_name = $post->photo ? $post->photo : null;
        $image = $request->file('photo');
        if ($image) {
            $image_name = $this->uploadphoto($image, 'images/posts/');
        }

        $file_name = $post->file ? $post->file : null;
        $file = $request->file('file');
        if ($file) {
            $file_name = $this->uploadFile($file, 'files');
        }

        $video_name = $post->video ? $post->video : null;
        $video = $request->file('video');
        if ($video) {
            $video_name = $this->uploadFile($video, 'videos');
        }

        $post_s       = filter_var($request->post, FILTER_SANITIZE_STRING);
        $video_name_s = filter_var($video_name   , FILTER_SANITIZE_STRING);
        $image_name_s = filter_var($image_name   , FILTER_SANITIZE_STRING);
        $file_name_s  = filter_var($file_name    , FILTER_SANITIZE_STRING);

        $post->update([
            'photo'    => $image_name_s,
            'video'    => $video_name_s,
            'post'     => $post_s,
            'fixed'    => $request->fixed,
            'level_id' => $request->level,
            'file'     => $file_name_s,
            'admin_id' => Auth::user()->id,
        ]);

        return response()->json();
    }
}
