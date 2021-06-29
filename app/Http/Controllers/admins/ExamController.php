<?php

namespace App\Http\Controllers\admins;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Requests\ExamRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use App\Model\{Degrees, Exams,Levels,Subjects};

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
            'name'                => $request->name,
            'date'                => $request->date,
            'subject_id'          => $request->subject_id,
            'level_id'            => $request->level,
            'admin_id'            => Auth::user()->id,
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
        if (! $exam) {
            return redirect()->back()->with(['error'=>'not found']);
        }

        $users=User::where('level_id',$exam->level_id)->get();
        foreach ($users as  $user) {
            Degrees::create([
                'exam_id'    => $exam->id,
                'user_id'    => $user->id,
                'subject_id' => $exam->subject_id,
            ]);
        }

        $exam->update([
            'active'=>1
        ]);

        return redirect()->back()->with(['success'=>'you activated it']);
    }

    ################################     update number of questions   #####################
    public function update_number_questions(Request $request)
    {
        $exam_id=$request->id;
        $exam=Exams::find($exam_id);
        if (! $exam) {
            return redirect()->back()->with(['error'=>'not found']);
        }

        $number_of_questions_request=$request->number_of_questions;

        $exam->number_of_questions+=$number_of_questions_request;
        $exam->save();

        return view('admins\questions\add',compact('number_of_questions_request','exam_id'));
    }

    
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    ##################################      edit        ##################################
    public function edit($id)
    {
        $subjects=Subjects::selection()->get();
        $levels=Levels::selection()->get();

        $exam=Exams::find($id);
        if (!$exam) {
            return redirect()->back()->with(['error'=>'not found']);
        }

        return view('admins\exams\edit',compact('exam','subjects','levels'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    ##################################      update        ##################################
    public function update($id ,ExamRequest $request)
    {
        $exam=Exams::find($id);
        if (!$exam) {
            return redirect()->back()->with(['error'=>'not found']);
        }

        $exam->name                = $request->name;
        $exam->date                = $request->date;
        $exam->subject_id          = $request->subject_id;
        $exam->level_id            = $request->level;
        $exam->duration            = $request->duration;
        $exam->term                = $request->term;

        $exam->save();
        return redirect()->back()->with(['success'=>'you successfully updated exam']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Exam  $exam
     * @return \Illuminate\Http\Response
     */
    ##################################      delete        ##################################
    public function delete($id)
    {
        $exam=Exams::find($id);
        if (!$exam) {
            return redirect()->back()->with(['error'=>'not found']);
        }

        $exam->delete();

        return redirect()->back()->with(['success'=>'you successfully deleted it']);
    }
}
