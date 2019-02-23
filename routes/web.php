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


//homepage website
Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');


//Standar authentication routes
Auth::routes();

//check role route user
Route::group(['middleware' => ['auth','role:user']], function () {
    Route::resource('user', 'UserController'); 
});

//check role route admin
Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::resource('admin', 'AdminController'); 
});



