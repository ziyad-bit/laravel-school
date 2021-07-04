<?php

namespace App\Http\Controllers\users;

use App\Model\{Exams,Degrees};
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class NotificationsController extends Controller
{
    ##############################        index       #####################################
    public function index()
    {
        $active_exams=Exams::userSelection()->where('active',1);

        $active_exams_get=$active_exams->wherehas('degrees',
            function($q){$q->where('user_id',Auth::user()->id);})->
            with(['admins'=>function($q){$q->selection();},
                'subjects'=>function($q){$q->selection();}])->orderBy('id','desc')->get();

        $notifs_count=$active_exams->wherehas('degrees',
                function($q){$q->where('user_id',Auth::user()->id)->where('notification',0);})
                ->count();

        $view=view('users.exam.notifs_exam',compact('active_exams_get'))->render();

        return response()->json([
                                'notifs_count' => $notifs_count,
                                'html'         => $view
                            ]);
    }

    ##############################        update       #####################################
    public function update()
    {
        $read_notifs_ids=Degrees::where('user_id',Auth::user()->id)->where('notification',0)->
                    pluck('id')->toArray();

        Degrees::whereIn('id',$read_notifs_ids)->update([
            'notification'=>1
        ]);

        return response()->json();
    }
}
