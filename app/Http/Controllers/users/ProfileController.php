<?php

namespace App\Http\Controllers\users;

use App\User;
use App\Traits\UploadImage;
use App\Http\Requests\UserRequest;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use UploadImage;

    ################################      index      #######################################
    public function index()
    {
        return view('users.profile.index');
    }

    ################################      edit      #######################################
    public function edit()
    {
        return view('users.profile.edit');
    }

    ################################      update      #######################################
    public function update(UserRequest $request)
    {
        $user=User::find(Auth::user()->id);
        
        $photo_name=Auth::user()->photo;
        $photo=$request->file('photo');
        if ($photo) {
            $photo_name=$this->uploadphoto($request->file('photo'),'images/profile');
        }
        
        $user->photo=$photo_name;
        $user->email=$request->email;
        $user->save();

        return redirect()->back()->with(['success'=>'you successfully updated your profile']);
    }
}
