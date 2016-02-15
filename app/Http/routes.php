<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/





/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/

Route::group(['middleware' => ['web']], function () {
    //
    Route::get('/', 'HomeController@index');
    Route::get('auth/logout',function(){
        Auth::logout();
        return redirect('/');
    });
    Route::get('auth/{provider?}', 'Auth\AuthController@redirectToProvider');
	Route::get('auth/{provider?}/callback', 'Auth\AuthController@handleProviderCallback');

    Route::get('admin', function () {
        return redirect('/admin/student');
    });

    Route::group([
        'namespace' => 'Admin',
        'middleware' => 'auth',
    ], function () {
        Route::resource('admin/student', 'StudentController');
        Route::resource('admin/student.hours', 'HourController');
        Route::resource('admin/student.payments', 'PaymentController');
        
    });

});
