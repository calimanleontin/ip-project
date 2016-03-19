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

    Route::get('/', 'UserController@index');

    Route::get('/auth/register', 'UserController@getRegister');
    Route::get('/auth/login', 'UserController@getLogin');
    Route::get('/auth/logout', 'UserController@logout');
    Route::post('/auth/register', 'UserController@postRegister');
    Route::post('/auth/login', 'UserController@postLogin');

    Route::get('/company', 'CompanyController@account');
    Route::get('/company/register', 'CompanyController@getRegister');
    Route::get('/company/login', 'CompanyController@getLogin');
    Route::post('/company/register', 'CompanyController@postRegister');
    Route::post('/company/login', 'CompanyController@postLogin');
    Route::get('/company/edit', 'CompanyController@edit');
    Route::post('/company/update', 'CompanyController@update');
    Route::get('/company/{slug}', 'CompanyController@show');

    Route::get('/api/comments/{slug}', 'CommentController@show');
    Route::post('/api/comments/save/{id}', 'CommentController@store');
    Route::get('/api/comments/delete/{id}', 'CommentController@delete');

    Route::get('/create-tag', 'TagController@create');
    Route::post('/store-tag', 'TagController@store');

    Route::get('/api/tags/', 'TagController@index');
    Route::post('/api/tags/assign/', 'TagController@assign');
    Route::get('/api/tags/delete/{tagId}/', 'TagController@delete');


});
