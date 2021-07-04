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
        $search = $request->has('search') ? $request->get('search') : null;

        //join posts with comments and admins    /   join comments with admisn and users
        //first : show fixed posts
        $fixed_comments_posts =  Posts::selection()
            ->withCount(['comments'])
            ->with(['comments' => function ($q) {
                $q->selection()->with([ 'users' => function($q) {$q->selection();},
                                        'admins'=> function($q) {$q->selection();}]);
            },      'admins' => function ($q) {$q->selection();}])->
            where('level_id', Auth::user()->level_id)->where('fixed', 1)->group();

        //search in fixed posts
        if ($search != null) {
            $fixed_comments_posts = $fixed_comments_posts->search($search);
        }

        $fixed_comments_posts=$fixed_comments_posts->orderBy('id','desc')->paginate(2);
        
        //second : show not fixed posts
        $not_fixed_comments_posts =  Posts::selection()
            ->withCount(['comments'])
            ->with(['comments' => function ($q) {
                $q->selection()->with([ 'users' => function($q) {$q->selection();},
                                        'admins'=> function($q) {$q->selection();}]);
            },      'admins' => function ($q) {$q->selection();}])->
            where('level_id', Auth::user()->level_id)->where('fixed', 0)->group();

        //search in not fixed posts
        if ($search != null) {
            $not_fixed_comments_posts = $not_fixed_comments_posts->search($search);
        }

        $not_fixed_comments_posts=$not_fixed_comments_posts->orderBy('id','desc')->
            paginate(2);

        //infinite scroll
        if($request->has('agax')){
            $view=view('users.posts.all_posts',compact('not_fixed_comments_posts','fixed_comments_posts'))
            ->render();

            return response()->json(['view'=>$view]);
        }

        return view('users.posts.index',compact('not_fixed_comments_posts','fixed_comments_posts'));
    }

    #######################################      download       ############################
    public function download($file)
    {
        return response()->download('files/'.$file);
    }
}
