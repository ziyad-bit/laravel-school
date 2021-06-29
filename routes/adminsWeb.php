<?php

use Illuminate\Support\Facades\Route;



###############################     not auth admins     #####################################
Route::group(['namespace'=>'admins','middleware'=>'guest:admins'],function(){
    Route::get ('/get/login' ,'AdminsController@index')->name('admins.login');
    Route::post('/login'     ,'AdminsController@login');
    
});

###############################      admins     #####################################
Route::group(['namespace'=>'admins'],function(){
    Route::get ('/dashboard' ,'AdminsController@show');
    Route::get ('/logout'    ,'AdminsController@logout');
});

###############################      exams      #####################################
Route::group(['prefix'=>'exams','namespace'=>'admins'],function(){
    Route:: get   ('/create'                     ,'ExamController@index');
    Route:: get   ('/show'                       ,'ExamController@show');
    Route:: post  ('/store'                      ,'ExamController@store');
    Route:: get   ('/active/{id}'                ,'ExamController@active');
    Route:: get   ('/edit/{id}'                  ,'ExamController@edit');
    Route:: post  ('/update/{id}'                ,'ExamController@update');
    Route:: get   ('/delete/{id}'                ,'ExamController@delete');
    Route:: post  ('/update/number_questions'    ,'ExamController@update_number_questions');
}); 

###############################      questions      #####################################
Route::group(['prefix'=>'questions','namespace'=>'admins'],function(){
    Route:: get   ('/show/{id}'            ,'QuestionsController@show');
    Route:: get   ('/edit/{id}'            ,'QuestionsController@edit');
    Route:: post  ('/update/{id}'          ,'QuestionsController@update');
    Route:: get   ('/delete/{id}'          ,'QuestionsController@delete');
    Route:: get   ('/create/{id}'          ,'QuestionsController@index');
    Route:: post  ('/store/{id}'           ,'QuestionsController@store');
    Route:: get   ('/update/addQuestions'  ,'QuestionsController@update');

});

###############################      posts      #####################################
Route::group(['prefix'=>'posts','namespace'=>'admins'],function(){
    Route:: get   ('/index'       ,'PostsController@index');
    Route:: get   ('/delete/{id}' ,'PostsController@delete');
    Route:: get   ('/edit/{id}'   ,'PostsController@edit');
    Route:: post  ('/update/{id}' ,'PostsController@update');
    Route:: get   ('/create'      ,'PostsController@create');
    Route:: post  ('/store'       ,'PostsController@store');
});