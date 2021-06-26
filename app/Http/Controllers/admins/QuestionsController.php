<?php

namespace App\Http\Controllers\admins;

use App\Model\{Exams,Questions};
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\Redirect;

class QuestionsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:admins');
    }
    
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ##################################      index        ##################################
    public function index($id)
    {
        $exam=Exams::find($id);
        if (!$exam) {
            return redirect()->back()->with(['error'=>'not found']);
        }

        $number_of_questions=$exam->number_of_questions;
        return view('admins.questions.store',compact('number_of_questions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    ##################################      store        ##################################
    public function store(QuestionRequest $request,$id)
    {
        $exam_questions=collect($request->exam);

        $exam_questions_arr=[];
        foreach ($exam_questions as $exam_question ) {
            $question_s    = filter_var($exam_question['question']    ,FILTER_SANITIZE_STRING);
            $choice1_s     = filter_var($exam_question['choice1']     ,FILTER_SANITIZE_STRING);
            $choice2_s     = filter_var($exam_question['choice2']     ,FILTER_SANITIZE_STRING);
            $choice3_s     = filter_var($exam_question['choice3']     ,FILTER_SANITIZE_STRING);
            $choice4_s     = filter_var($exam_question['choice4']     ,FILTER_SANITIZE_STRING);
            $choice5_s     = filter_var($exam_question['choice5']     ,FILTER_SANITIZE_STRING);
            $correct_ans_s = filter_var($exam_question['correct_ans'] ,FILTER_SANITIZE_STRING);

            $exam_questions_arr[]=[
                'question'    => $question_s,
                'choice1'     => $choice1_s,
                'choice2'     => $choice2_s,
                'choice3'     => $choice3_s,
                'choice4'     => $choice4_s,
                'choice5'     => $choice5_s,
                'correct_ans' => $correct_ans_s,
                'exam_id'     => $id,
            ];
        }

        Questions::insert($exam_questions_arr);

        return Redirect::to('admins/exams/index')->with(['success'=>'you added successfully questions']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    ##################################      show        ##################################
    public function show($id)
    {
        $questions=Exams::find($id)->questions;
        if (! $questions) {
            return redirect()->back()->with(['error','not found']);
        }

        return view('admins\questions\index',compact('questions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    ##################################      edit        ##################################
    public function edit($id)
    {
        $questions=Questions::find($id);
        if (! $questions) {
            return redirect()->back()->with(['error','not found']);
        }

        return view('admins\questions\edit',compact('questions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    ##################################      update        ##################################
    public function update(QuestionRequest $request , $id)
    {
        $questions=Questions::find($id);
        if (! $questions) {
            return redirect()->back()->with(['error','not found']);
        }

        $question    = filter_var($request->question     ,FILTER_SANITIZE_STRING);
        $choice1     = filter_var($request->choice1      ,FILTER_SANITIZE_STRING);
        $choice2     = filter_var($request->choice2      ,FILTER_SANITIZE_STRING);
        $choice3     = filter_var($request->choice3      ,FILTER_SANITIZE_STRING);
        $choice4     = filter_var($request->choice4      ,FILTER_SANITIZE_STRING);
        $choice5     = filter_var($request->choice5      ,FILTER_SANITIZE_STRING);
        $correct_ans = filter_var($request->correct_ans  ,FILTER_SANITIZE_STRING);

        $questions->question    = $question;
        $questions->choice1     = $choice1;
        $questions->choice2     = $choice2;
        $questions->choice3     = $choice3;
        $questions->choice4     = $choice4;
        $questions->choice5     = $choice5;
        $questions->correct_ans = $correct_ans;

        $questions->save();
        return redirect()->back()->with(['success' => 'you successfully updated question']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    ##################################      delete        ##################################
    public function delete($id)
    {
        $questions=Questions::find($id);
        if (! $questions) {
            return redirect()->back()->with(['error','not found']);
        }

        $questions->delete();
        return redirect()->back()->with(['success' => 'you successfully deleted question']); 
    }
}
