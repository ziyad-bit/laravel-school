<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

###############################      exams      #####################################
Route::group(['prefix'=>'exams','namespace'=>'users'],function(){
    Route:: get   ('/get'                    ,'ExamController@index');
    Route:: any   ('/show/{token}'              ,'ExamController@show')->middleware('exam');
    Route:: get   ('/continue'               ,'ExamController@continue');
});
