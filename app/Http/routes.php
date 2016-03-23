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
    Route::get('auth/confirm/{uid}/{code}', 'Auth\AuthController@confirm');
    Route::post('auth/confirm/password', 'Auth\AuthController@confirmSetPassword');

    Route::get('student', 'StudentController@index');
    Route::resource('student.hours', 'Admin\HourController', ['only' => ['store', 'destroy']]);
    
    Route::get('admin', function () {
        return redirect('/admin/student');
    });

    Route::group([
        'namespace' => 'Admin',
        'middleware' => ['auth','Admin'],
    ], function () {
        Route::resource('admin/student', 'StudentController');
        Route::resource('admin/student.hours', 'HourController');
        Route::resource('admin/student.payments', 'PaymentController');
        Route::resource('admin/instructor', 'InstructorController');
        Route::resource('admin/instructor.drives', 'DriveController');
        Route::resource('admin/drives.student.hours', 'DriveStudentHourController', ['only' => ['store', 'update', 'destroy']]);

    });

});
