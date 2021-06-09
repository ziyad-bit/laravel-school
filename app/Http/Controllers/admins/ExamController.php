<?php

namespace App\Http\Controllers\admins;

use App\Model\Exams;
use App\Model\Levels;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;
use App\Http\Controllers\Controller;
use App\model\Subjects;
use Illuminate\Support\Facades\Redirect;

class ExamController extends Controller
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
    public function index()
    {
        $subjects=Subjects::selection()->get();
        $levels=Levels::selection()->get();
        return view('admins.exams.create',compact('levels','subjects'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    ##################################      store        ##################################
    public function store(ExamRequest $request)
    {
        $token=Str::random(20);

        $exam=Exams::create([
            'subject'             => $request->subject,
            'date'                => $request->date,
            'level_id'            => $request->level,
            'number_of_questions' => $request->number_of_questions,
            'term'                => $request->term,
            'duration'            => $request->duration,
            'token'               => $token,
        ]);

        return Redirect::to('admins/questions/create/'.$exam->id)->with(['success'=>'you created successfully exam  and you can add questions']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    ##################################      show        ##################################
    public function show()
    {
        $exams=Exams::selection()->get();
        return view('admins.exams.show',compact('exams'));
    }

    ##################################      active        #################################
    public function active($id)
    {
        $exam=Exams::find($id);
        $exam->update([
            'active'=>1
        ]);

        return redirect()->back()->with(['success'=>'you activated it']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function edit(Exam $exam)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Exam $exam)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    public function destroy(Exam $exam)
    {
        //
    }
}
