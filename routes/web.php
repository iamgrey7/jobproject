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

//Standard authentication routes
Auth::routes();

//check role route user
Route::group(['middleware' => ['auth','role:user']], function () {
     
   
    Route::post('users/detail', 'ApplicantController@storeProfile')
         ->name('profile.store'); 

    Route::get('users/detail', 'ApplicantController@showProfile')
        ->name('profile.show');  

    Route::put('users/upload', 'ApplicantController@uploadCV')
        ->name('cv.upload');   
        
});

//check role route admin
Route::group(['middleware' => ['auth','role:admin']], function () {

    Route::get('dashboard', 'AdminController@index')
        ->name('admin.index');  
   
    Route::get('applicant-profile/{id}', 'AdminController@showProfile')
    ->name('applicant.profile');

    Route::post('admin/change-status', 'AdminController@changeStatusCV')
        ->name('changeStatusCV');

    Route::get('download/{file}', 'AdminController@download')
        ->name('download.cv');

    Route::get('account-management', 'UserController@index')
    ->name('account.index');

    Route::post('users/create', 'UserController@storeUser')
        ->name('users.create');
    
    Route::put('users/update/{id}', 'UserController@update')
        ->name('account.update');

    Route::post('users/delete', 'UserController@destroy')
        ->name('users.delete');

  
    // Route::resource('admin', 'AdminController');

});



