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

Route::get('/', function () {
    return view('welcome');
});
Route::get('/admin', 'Auth\LoginController@showLoginForm');
Route::post('admin/login', 'Auth\LoginController@login')->name('admin.login');
// Authentication 
Auth::routes();
Route::group( ['prefix' => 'admin', 'middleware' => ['admin']], function () {
    Route::get('home', 'Admin\HomeController@index')->name('admin.home');
    Route::get('user', 'Admin\UserController@index')->name('admin.user');
    Route::put('user/update/{id}', 'Admin\UserController@update')->name('admin.user.update');
    Route::get('password/change', function () {
        return view('admin.auth.passwords.password');
    })->name('admin.password.form');
    Route::post('password/change', 'Admin\HomeController@changePassword')->name('admin.password.change');
});