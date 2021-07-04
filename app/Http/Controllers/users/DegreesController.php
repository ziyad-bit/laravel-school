<?php

namespace App\Http\Controllers\users;

use App\Model\{Exams,Subjects,degrees};
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class DegreesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ####################################      index        ##############################
    public function index(int $id)
    {
        $degrees=Subjects::find($id)->degrees;
        $degrees_id=$degrees->where('user_id',Auth::user()->id)->pluck('id')->toArray();

        $exam_degrees=Exams::with(['degrees'=>function($q) use($degrees_id){
            $q->selection()->whereIn('id',$degrees_id)->where('finish',1);
        }])->userSelection()->get();

        return view('users.degrees.index',compact('exam_degrees'));
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\degrees  $degrees
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\degrees  $degrees
     * @return \Illuminate\Http\Response
     */
    public function edit(degrees $degrees)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\degrees  $degrees
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, degrees $degrees)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\degrees  $degrees
     * @return \Illuminate\Http\Response
     */
    public function destroy(degrees $degrees)
    {
        //
    }
}
