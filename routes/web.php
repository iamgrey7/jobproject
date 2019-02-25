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

    Route::get('dashboard', 'AdminController@index')
        ->name('admin.index');
    
    Route::get('user-management', 'UserController@userManage')
        ->name('user-management.manage');

    Route::get('applicant-profile/{id}', 'AdminController@showProfile')
    ->name('applicant.profile');

    // Route::get('/uploads/cv/{file}', function ($file='') {
    //     return response()->download(storage_path('uploads/cv/'.$file)); 
    // });

    Route::get('/download/{file}', 'AdminController@download')
        ->name('download.cv');
    
    // Route::resource('admin', 'AdminController');
    // Route::resource('user-management', 'UserController');

});



