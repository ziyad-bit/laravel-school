<?php

namespace App\Http\Controllers\users;

use App\model\Posts;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    #######################################      index       ############################
    public function index(Request $request)
    {
        //join posts with comments and admins      /    join comments with admisn and users
        //first : show fixed posts
        $fixed_comments_posts = Posts::selection()->withCount(['comments'])
        ->with(['comments' => function ($q) {
            $q->selection()->with(['users' => function ($q) {
                $q->selection();
            },'admins'=>function($q){
                $q->selection();
            }]);
        }, 'admins' => function ($q) {
            $q->selection();
        }])->where('level_id', Auth::user()->level_id)->where('fixed', 1)->paginate(2);

        //second : show not fixed posts
        $comments_posts = Posts::selection()->withCount(['comments'])
        ->with(['comments' => function ($q) {
            $q->selection()->with(['users' => function ($q) {
                $q->selection();
            },'admins'=>function($q){
                $q->selection();
            }]);
        }, 'admins' => function ($q) {
            $q->selection();
        }])->where('level_id', Auth::user()->level_id)->where('fixed', 0)->paginate(2);

        if($request->has('agax')){
            $view=view('users.posts.all_posts',compact('comments_posts','fixed_comments_posts'))->render();
            return response()->json(['view'=>$view]);
        }

        return view('users.posts.index',compact('comments_posts','fixed_comments_posts'));
    }

    #######################################      download       ############################
    public function download($file)
    {
        return response()->download('files/'.$file);
    }
}
