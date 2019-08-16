<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->group(function(){
    Route::resource('course', 'CourseController');

    Route::get('/', 'CourseController@index')->name('course.index');

    Route::get('/course/{course}/attendees', 'CourseController@attendees')->name('course.attendees');

    Route::get('/course/{course}/ratings', 'CourseController@ratings')->name('course.ratings');

    Route::get('/member', 'MemberController@index')->name('member.index');

    Route::get('/member/{member}/status', 'MemberController@status')->name('member.status');
});