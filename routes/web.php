<?php

use Illuminate\Support\Facades\Route;

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

//Route::get('/', 'Auth\AuthController@getLogin');
//Route::get('login', 'Auth\AuthController@getLogin');

Auth::routes([
    'register' => false,
    'reset' => false,
    'verify' => false,
]);

Route::group(['middleware' => 'auth'], function () {

//    Route::get('/', 'DashboardController@index')->middleware('role:admin')->name('dashboard');
//    Route::get('/', 'DashboardController@index')->middleware('role:karyawan')->name('dashboard');

    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::get('/edit-profil', 'UserController@editProfile')->name('edit-profile');
    Route::post('/update-profil', 'UserController@updateProfile')->name('update-profile');
    Route::get('/admin/user', 'UserController@index')->middleware('role:admin')->name('admin-index-user');
    Route::get('/admin/user/create', 'UserController@create')->middleware('role:admin')->name('admin-create-user');
    Route::post('/admin/user/store', 'UserController@store')->middleware('role:admin')->name('admin-store-user');
    Route::get('/admin/user/edit/{id}', 'UserController@edit')->middleware('role:admin')->name('admin-edit-user');
    Route::post('/admin/user/update/{id}', 'UserController@update')->middleware('role:admin')->name('admin-update-user');
    Route::post('/admin/user/delete/{id}', 'UserController@destroy')->middleware('role:admin')->name('admin-destroy-user');
});



//Route::get('admin-page', function() {
//    return 'Halaman untuk Admin';
//})->middleware('role:admin')->name('admin.page');
//
//Route::get('user-page', function() {
//    return 'Halaman untuk User';
//})->middleware('role:karyawan')->name('user.page');

Route::get('/home', 'HomeController@index')->name('home');
