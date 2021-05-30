<?php

use Illuminate\Support\Facades\Route;


Route::get ('/get/login','admins\AdminsController@index')->name('admins.login')->middleware('guest:admins');

###############################      admins     #####################################
Route::group(['namespace'=>'admins'],function(){
    Route::get ('/dashboard','AdminsController@show');
    Route::get ('/logout'   ,'AdminsController@logout');
    Route::post('/login'    ,'AdminsController@login');
    
});


###############################      exams      #####################################
Route::group(['prefix'=>'exams','namespace'=>'admins'],function(){
    Route:: get   ('/create'                 ,'ExamController@index');
    Route:: get   ('/show'                   ,'ExamController@show');
    Route:: post  ('/store'                  ,'ExamController@store');
});

###############################      questions      #####################################
Route::group(['prefix'=>'questions','namespace'=>'admins'],function(){
    Route:: get   ('/create/{id}'  ,'QuestionsController@index');
    Route:: post  ('/store/{id}'   ,'QuestionsController@store');
    
});