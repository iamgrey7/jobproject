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
// Route::get('/', 'HomeController@index')->name('home');
Route::get('/home', 'HomeController@index')->name('home');

Route::get('/homepage', 'HomeController@home')->name('guest.home');
Route::get('/', 'HomeController@home')->name('guest.home');


//Standar authentication routes
Auth::routes();

//check role route user
Route::group(['middleware' => ['auth','role:user','profile']], function () {
    //Route::resource('users', 'UserController');     
    Route::get('users/{id}/profile', 'UserController@showFormProfile')
        ->name('users.profile-form');
    Route::post('users/{id}/profile', 'UserController@storeProfile')
         ->name('users.profile-store'); 
    Route::get('users/{id}/profile/info', 'UserController@showProfile')
        ->name('users.profile-show');   
    Route::get('users/home', 'UserController@index')
        ->name('users.index');
    Route::put('users/{id}/upload', 'UserController@uploadCV')
        ->name('users.upload');
});

//check role route admin
Route::group(['middleware' => ['auth','role:admin']], function () {
    Route::resource('user-management', 'UserController');
    Route::get('user-management', 'UserController@userManage')
        ->name('user-management.manage');

    Route::get('applicant-profile/{id}', 'UserController@showProfile')
    ->name('applicant.profile');
    
    Route::resource('admin', 'AdminController');
    

});



