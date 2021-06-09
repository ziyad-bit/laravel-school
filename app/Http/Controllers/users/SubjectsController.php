<?php

namespace App\Http\Controllers\users;

use App\model\Subjects;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class SubjectsController extends Controller
{
    public function index()
    {
        $subjects=Subjects::with('levels')->whereHas('levels',function($q){
            $q->where('subjects_level.level_id',Auth::user()->level_id);
        })->get();

        return view('users\subjects\index',compact('subjects'));
    }
}
