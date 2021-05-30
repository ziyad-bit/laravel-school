<?php

namespace App\Http\Controllers\admins;

use App\Model\Exams;
use App\Model\Levels;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;
use App\Http\Controllers\Controller;
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
        $levels=Levels::selection()->get();
        return view('admins.exams.create',compact('levels'));
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
        $name  = filter_var($request->name  ,FILTER_SANITIZE_STRING);
        $token=Str::random(20);

        $exam=Exams::create([
            'name'                => $name,
            'level_id'            => $request->level,
            'number_of_questions' => $request->number_of_questions,
            'term'                => $request->term,
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
        return view('admins.exams.show');
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
