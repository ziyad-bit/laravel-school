<?php

namespace App\Http\Controllers\admins;

use App\Model\Exams;
use App\Model\Questions;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\QuestionRequest;
use Illuminate\Support\Facades\Redirect;

class QuestionsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ##################################      index        ##################################
    public function index($id)
    {
        $exam=Exams::find($id);
        $number_of_questions=$exam->number_of_questions;
        return view('admins.exams.addQuestions',compact('number_of_questions'));
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
            $exam_questions_arr[]=[
                'question'    => $exam_question['question'],
                'choice1'     => $exam_question['choice1'],
                'choice2'     => $exam_question['choice2'],
                'choice3'     => $exam_question['choice3'],
                'choice4'     => $exam_question['choice4'],
                'choice5'     => $exam_question['choice5'],
                'correct_ans' => $exam_question['correct_ans'],
                'exam_id'     => $id,
            ];
        }

        Questions::insert($exam_questions_arr);

        return Redirect::to('admins/questions/create/'.$id)->with(['success'=>'you added successfully questions']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function show(Questions $questions)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function edit(Questions $questions)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Questions $questions)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\Questions  $questions
     * @return \Illuminate\Http\Response
     */
    public function destroy(Questions $questions)
    {
        //
    }
}
