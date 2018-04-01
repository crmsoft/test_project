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


Route::group([
    'prefix' => LaravelLocalization::setLocale()
], function(){

    Auth::routes();

    Route::group([
        'middleware' => ['auth']
    ], function (){

        // company routes
        Route::get('/', 'CompanyController@index')->name('show-index-companies');
        Route::get('/companies', 'CompanyController@index')->name('show-companies');

        Route::get('/create/company', 'CompanyController@create')->name('create-company');
        Route::post('/store/company', 'CompanyController@store')->name('store-company');

        Route::get('/update/company/{id}', 'CompanyController@update')->name('update-company');

        Route::get('/remove/company/{id}', 'CompanyController@remove')->name('remove-company');

        // employee routes
        Route::get('/list/companies', 'CompanyController@getList')->name('list-companies');

        Route::get('/employees', 'EmployeeController@index')->name('show-employee');

        Route::get('/create/employee', 'EmployeeController@create')->name('create-employee');
        Route::post('/store/employee', 'EmployeeController@store')->name('store-employee');

        Route::get('/update/employee/{id}', 'EmployeeController@update')->name('update-employee');

        Route::get('/remove/employee/{id}', 'EmployeeController@remove')->name('remove-employee');

        Route::get('/list/employees', 'EmployeeController@getList')->name('list-employees');
    });

});