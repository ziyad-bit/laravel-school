<?php

namespace App\Http\Controllers\users;

use App\model\Posts;
use App\model\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class PostsController extends Controller
{
    public function index()
    {
        $comments_posts=Posts::with(['admins'=>function($q){
            $q->selection();
        },'comments'=>function($q){
            $q->with(['users'=>function($q){
                $q->selection();
            }])->selection();
        }])->selection()->where('level_id',Auth::user()->level_id)->get();

        //dd($comments_posts);
        return view('users.posts.index',compact('comments_posts'));
    }
}
