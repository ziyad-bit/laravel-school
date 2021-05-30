<?php

namespace App\Http\Controllers\admins;

use App\Model\admins;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AdminsController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth:admins'])->except(['index','login']);
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    ##################################      index        ##################################
    public function index()
    {
        return view('admins.auth.login');
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
    ##################################      logout        ##################################
    public function logout(){
        Auth::logout();
        return Redirect::to('admins/get/login');
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    ##################################      login        ##################################
    public function login(Request $request)
    {
        $credentials=$request->only('email','password');
        if (auth()->guard('admins')->attempt($credentials)) {
            return Redirect::to('admins/dashboard');
        }else{
            return Redirect::to('admins/get/login')->with(['error'=>'incorrect password or email']);
        }
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\admins  $admins
     * @return \Illuminate\Http\Response
     */
    ##################################      show        ##################################
    public function show()
    {
        return view('admins\auth\dashboard');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Model\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function edit(admins $admins)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Model\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, admins $admins)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Model\admins  $admins
     * @return \Illuminate\Http\Response
     */
    public function destroy(admins $admins)
    {
        //
    }
}
