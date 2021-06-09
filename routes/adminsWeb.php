<?php

use Illuminate\Support\Facades\Route;



###############################     not auth admins     #####################################
Route::group(['namespace'=>'admins','middleware'=>'guest:admins'],function(){
    Route::get ('/get/login','AdminsController@index')->name('admins.login');
    Route::post('/login'    ,'AdminsController@login');
    
});
###############################      admins     #####################################
Route::group(['namespace'=>'admins'],function(){
    Route::get ('/dashboard','AdminsController@show');
    Route::get ('/logout'   ,'AdminsController@logout');
});


###############################      exams      #####################################
Route::group(['prefix'=>'exams','namespace'=>'admins'],function(){
    Route:: get   ('/create'                 ,'ExamController@index');
    Route:: get   ('/show'                   ,'ExamController@show');
    Route:: post  ('/store'                  ,'ExamController@store');
    Route:: get   ('/active/{id}'            ,'ExamController@active');
}); 

###############################      questions      #####################################
Route::group(['prefix'=>'questions','namespace'=>'admins'],function(){
    Route:: get   ('/create/{id}'  ,'QuestionsController@index');
    Route:: post  ('/store/{id}'   ,'QuestionsController@store');
    
});