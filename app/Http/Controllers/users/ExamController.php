<?php

namespace App\Http\Controllers\users;

use App\Model\Exams;
use App\Model\Degrees;
use App\Model\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    #####################################      index        #################################
    public function index()
    {
        $exams=Exams::userSelection()->where('level_id',Auth::user()->level_id)
                ->where('term',Auth::user()->term)->get();

        $degree=Degrees::where('finish',0)->where('user_id',Auth::user()->id)
                ->first();
        
        if($degree){
            $page=$degree->page;
            $exam=Exams::find($degree->exam_id);
        }else{
            $exam=null;
            $page=null;
        }
        return view('users.exam.index',compact('exams','exam','page'));
    }

    #####################################      show        #################################
    public function show($token,Request $request)
    {
        $exam=Exams::where('token',$token)->first();
        $exam_id=$exam->id;
        
        $questions=Questions::with('exams')->where('exam_id',$exam_id)->paginate(1);
        $degree=Degrees::where('exam_id',$exam_id)->where('user_id',Auth::user()->id)
                    ->first();

        if(! $request->has('agax')){
            if (! $degree) {
                $degree=Degrees::create([
                    'degrees' => 0,
                    'exam_id' => $exam_id,
                    'user_id' => Auth::user()->id
                ]);
            }
        }else{
            $student_ans=$request->choice;
            $correct_ans=Questions::find($request->id)->correct_ans;

            $page_request=$request->page;
            $degree->page = $page_request;
            $degree->save();

            if($student_ans == $correct_ans){
                $degree->degrees += 1;
                $degree->save();
            }else{
                null;
            }
            
            $view=view('users.exam.all_questions',compact('questions'))->render();
            if($exam->number_of_questions < $page_request){
                $view='';

                $student_degree=$degree->degrees;
                $degree->finish =1;
                $degree->save();
                
                return response()->json(['html'=>$view,'degree'=>$student_degree]) ;
            }

            return response()->json(['html'=>$view]) ;
        }

        return view('users.exam.show',compact('questions'));
    }

    #####################################      store        #################################
    public function continue($token)
    {

    }
}
