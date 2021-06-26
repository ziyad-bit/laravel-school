<?php

namespace App\Http\Controllers\admins;

use App\model\{Posts,Levels};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\PostRequest;
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
    public function index(Request $request)
    {
        $posts=Posts::selection()->get();

        return view('admins.posts.index',compact('posts'));
    }

    ###################################       create           ###############################
    public function create()
    {
        $levels=Levels::selection()->get();

        return view('admins.posts.create',compact('levels'));
    }

    ###################################       store           ###############################
    public function store(PostRequest $request)
    {
        $image_name=null;
        $image=$request->file('photo');
        if ($image) {
            $image_name=$this->uploadphoto($image,'images/posts/');
        }
        
        $file_name=null;
        $file=$request->file('file');
        if ($file) {
            $file_name=$this->uploadFile($file,'files');
        }

        $video_name=null;
        $video=$request->file('video');
        if ($video) {
            $video_name=$this->uploadFile($video,'videos');
        }

        $post_s       = filter_var($request->post ,FILTER_SANITIZE_STRING);
        $video_name_s = filter_var($video_name    ,FILTER_SANITIZE_STRING);
        $image_name_s = filter_var($image_name    ,FILTER_SANITIZE_STRING);
        $file_name_s  = filter_var($file_name     ,FILTER_SANITIZE_STRING);

        Posts::create([
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
