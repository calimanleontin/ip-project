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
    Route::get('/auth/change-password', 'UserController@changePassword');
    Route::post('/auth/update-password', 'UserController@updatePassword');


    Route::get('/company', 'CompanyController@account');
    Route::get('/company/register', 'CompanyController@getRegister');
    Route::get('/company/login', 'CompanyController@getLogin');
    Route::post('/company/register', 'CompanyController@postRegister');
    Route::post('/company/login', 'CompanyController@postLogin');
    Route::get('/company/edit', 'CompanyController@edit');
    Route::post('/company/update', 'CompanyController@update');
    Route::get('/company/{slug}', 'CompanyController@show');
    Route::get('/search', 'CompanyController@search');

    Route::get('/company/campaign/create', 'CampaignsController@getCreate');
    Route::post('/company/campaign/create', 'CampaignsController@postCreate');
    Route::get('/campaigns/{id}', 'CampaignsController@viewEntity');


    Route::get('/api/comments/{slug}', 'CommentController@show');
    Route::post('/api/comments/save/{id}', 'CommentController@save');
    Route::get('/api/comments/delete/{id}', 'CommentController@delete');

    Route::get('/create-tag', 'TagController@create');
    Route::post('/store-tag', 'TagController@store');

    Route::get('/api/tags/', 'TagController@index');
    Route::post('/api/tags/assign/', 'TagController@assign');
    Route::get('/api/tags/delete/{tagId}/', 'TagController@delete');

    Route::get('/api/company-location/{company}', 'CompanyController@getLocation');
    Route::get('/api/grades/{company_slug}', 'GradeController@getGradeValue');
    Route::get('/api/grades/{companyId}/{value}', 'GradeController@setGradeValue');
    Route::get('/api/save-location/{lat}/{lng}', 'UserController@saveLocation');
    Route::get('/api/auto-complete', 'CompanyController@getSearchData');

    Route::get('/my-profile', 'ProfileController@index');
    Route::get('/edit-profile', 'ProfileController@index');
    Route::post('/update-profile', 'ProfileController@update');
    
    Route::get('/get-companies', 'CompanyController@getCompanies');
    Route::get('/api-login', 'UserController@apiLogin');
    Route::get('/visit-company', 'CompanyController@visitCompany');
    Route::get('/assign-voucher', 'CompanyController@assignVoucher');
    Route::get('/get-visits-number', 'CompanyController@getVisits');

});
