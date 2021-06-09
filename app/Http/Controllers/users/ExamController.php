<?php

namespace App\Http\Controllers\users;

use App\Http\Controllers\Controller;
use App\Model\Degrees;
use App\Model\Exams;
use App\Model\Questions;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ExamController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    #####################################      index        #################################
    public function index()
    {
        $exams = Exams::doesntHave('degrees')->userSelection()
                    ->where('level_id', Auth::user()->level_id)
                    ->where('term', Auth::user()->term)->active()->get();

        $degree = Degrees::where('finish', 0)->where('user_id', Auth::user()->id)
            ->first();

        if ($degree) {
            $page = $degree->page;
            $exam = Exams::where('id', $degree->exam_id)->active()->first();
        } else {
            $exam = null;
            $page = null;
        }
        return view('users.exam.index', compact('exams', 'exam', 'page'));
    }

    #####################################      show        #################################
    public function show($token, Request $request)
    {
        $exam = Exams::where('token', $token)->active()->first();
        if (!$exam) {
            return response()->json(['error' => 'not found'], 404);
        }
        $exam_id = $exam->id;

        $questions = Questions::with('exams')->where('exam_id', $exam_id)->paginate(1);
        $degree = Degrees::where('exam_id', $exam_id)->where('user_id', Auth::user()->id)
            ->first();

        if($degree){
            $page_stored=$degree->page;
        }
        
        if(isset($request->page) && isset($page_stored) ){
            $page_request = $request->page;

            if ($page_request < $page_stored) {
                return redirect('exams/show/'.$token .'?page='.$page_stored);
            }
        }
            
        if (!$request->has('agax')) {
            if (!$degree) {
                $degree = Degrees::create([
                    'degrees'    => 0,
                    'exam_id'    => $exam_id,
                    'user_id'    => Auth::user()->id,
                    'subject_id' => $exam->subject_id
                ]);
            }
        } else {
            $student_ans = $request->choice;
            $correct_ans = Questions::find($request->id)->correct_ans;
            $degree->page = $page_request;
            $degree->save();

            if ($student_ans == $correct_ans) {
                $degree->degrees += 1;
                $degree->save();
            }

            $view = view('users.exam.all_questions', compact('questions','page_request'))->render();
            if ($exam->number_of_questions < $page_request) {
                $view = '';

                $student_degree = $degree->degrees;
                $degree->finish = 1;
                $degree->save();

                return response()->json(['html' => $view, 'degree' => $student_degree]);
            }

            return response()->json(['html' => $view]);
        }

        return view('users.exam.show', compact('questions'));
    }

    #####################################      store        #################################
    function continue ($token) {

    }
}
