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



Auth::routes();

Route::get('/', 'HomeController@index')->name('home')->middleware('auth');

###############################         exams        #####################################
Route::group(['prefix'=>'exams','namespace'=>'users'],function(){
    Route:: get   ('/get'                    ,'ExamController@index');
    Route:: any   ('/show/{token}'           ,'ExamController@show')->middleware('exam');
    Route:: get   ('/continue'               ,'ExamController@continue');
});

###############################      notifications        #####################################
Route::group(['prefix'=>'notifications','namespace'=>'users'],function(){
    Route:: get   ('/get'    ,'NotificationsController@index');
    Route:: get   ('/update' ,'NotificationsController@update');
});

###############################      subjects      #####################################
Route::group(['prefix'=>'subjects','namespace'=>'users'],function(){
    Route:: get   ('/get'      ,'SubjectsController@index');
    
});

###############################      profile      #####################################
Route::group(['prefix'=>'profile','namespace'=>'users'],function(){
    Route:: get   ('/get'      ,'ProfileController@index');
    Route:: get   ('/edit'     ,'ProfileController@edit');
    Route:: post  ('/update'   ,'ProfileController@update');
});

###############################      degrees       #####################################
Route::group(['prefix'=>'degrees','namespace'=>'users'],function(){
    Route:: get   ('/get/{id}'      ,'DegreesController@index');
    
});

###############################      paypal        #####################################
Route::group(['prefix'=>'paypal','namespace'=>'users'],function(){
    Route:: get   ('/show/{id}'              ,'PaypalController@show');
    Route:: get   ('/get/{id}'               ,'PaypalController@paypalReturn');
    Route:: post   ('/post/{id}'             ,'PaypalController@index');
});

###############################      posts         #####################################
Route::group(['prefix'=>'posts','namespace'=>'users'],function(){
    Route:: any   ('/get'                   ,'PostsController@index');
    Route:: any   ('/download/{file}'       ,'PostsController@download');
});

###############################      comments         #####################################
Route::group(['prefix'=>'comments','namespace'=>'users'],function(){
    Route:: post   ('/store'                 ,'CommentsController@store');
    Route:: post   ('/delete'                ,'CommentsController@delete');
    Route:: post   ('/update'                ,'CommentsController@update');
});


