<?php

namespace App\Http\Controllers\users;

use App\model\Comments;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\{Auth,Validator};
use App\Traits\CommentRules;

class CommentsController extends Controller
{
    use CommentRules;
    
    public function __construct()
    {
        $this->middleware(['auth','throttle:3,1']);
    }
    #######################################      store       ############################
    public function store(Request $request)
    {
        $post_id=$request->post_id;

        $rules    = $this->commentRules();
        $messages = $this->commentMessages();

        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return  response()->json(['errors'=>$validator->errors(),'post_id'=>$post_id],400);
        }
        
        $comment_s = filter_var($request->comment , FILTER_SANITIZE_STRING);

        $comment=Comments::create([
            'comment'=>$comment_s,
            'user_id'=>Auth::user()->id,
            'post_id'=>$post_id,
        ]);

        $view=view('users.posts.post_comments',compact('comment'))->render();
        return response()->json(['view'=>$view,'post_id'=>$post_id]);
    }

    #######################################      delete       ############################
    public function delete(Request $request)
    {
        $id=$request->id;
        $comment=Comments::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if (!$comment) {
            return response()->json(['error'=>'not found'],404);
        }

        $comment->delete();

        return response()->json();
    }

    #######################################      update       ############################
    public function update(Request $request)
    {
        $rules    = $this->commentRules();
        $messages = $this->commentMessages();

        $validator=Validator::make($request->all(),$rules,$messages);

        if($validator->fails()){
            return  response()->json(['errors'=>$validator->errors()],400);
        }
        
        $id=$request->id;
        $comment=Comments::where('user_id',Auth::user()->id)->where('id',$id)->first();
        if (!$comment) {
            return response()->json(['error'=>'not found'],404);
        }

        $comment_s = filter_var($request->comment , FILTER_SANITIZE_STRING);

        $comment->comment=$comment_s;
        $comment->save();
        
        return response()->json();
    }
}
