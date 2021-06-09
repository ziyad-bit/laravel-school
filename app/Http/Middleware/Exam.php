<?php

namespace App\Http\Middleware;

use Closure;
use App\Model\Exams;
use App\Model\Degrees;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class Exam
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $user=Auth::user();
        $error='you are not allowed to join this exam';
        
        $exam=Exams::where('token',request('token'))->active()->first();
        if (!$exam && $request->has('agax')) {
            return response()->json(['error'=>'the duration of exam is finished'],400);
        }

        if(! $exam){
            return Redirect::to('exams/get')->with(['error'=>$error]);
        }

        if($exam->level_id != $user->level_id || $exam->term != $user->term){
            return Redirect::to('exams/get')->with(['error'=>$error]);
        }

        $degree=Degrees::where('exam_id',$exam->id)->where('user_id',$user->id)
                ->where('finish',1)->first();
        if ($degree) {
            return Redirect::to('exams/get')->with(['error'=>'you finished this exam']);
        }

        return $next($request);
    }
}
