<?php

namespace App\Http\Controllers;

use App\model\Posts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
         //join posts with comments and admins    /   join comments with admisn and users
        // show fixed posts
        $fixed_comments_posts = Posts::selection()->withCount(['comments'])
        ->with(['comments' => function ($q) {
            $q->selection()->with([  'users' =>function($q) {$q->selection();}
                                    ,'admins'=>function($q) {$q->selection();}]);
        },      'admins' => function ($q) {$q->selection();}])->
        where('level_id', Auth::user()->level_id)->where('fixed', 1)->get();

        return view('home',compact('fixed_comments_posts'));
    }
}
