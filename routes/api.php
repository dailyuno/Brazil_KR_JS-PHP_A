<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function(){
    Route::middleware('auth.token')->group(function(){
        Route::post('logout', 'Api\UserController@logout');

        Route::get('courses', 'Api\CourseController@index');

        Route::post('registrations', 'Api\RegistrationController@store');

        Route::get('registrations', 'Api\RegistrationController@index');

        Route::put('registrations/{id}', 'Api\RegistrationController@update');
    });

    Route::post('profile', 'Api\UserController@register');

    Route::post('login', 'Api\UserController@login');
});