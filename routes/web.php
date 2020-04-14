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

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');
Route::get('/admin/login', 'Admin\LoginController@showLoginForm')->name('admin.login');
Route::post('/admin/login', 'Admin\LoginController@login');

Route::prefix('dashboard')->namespace('User')->middleware('auth')->group(function() {
    Route::get('/', 'HomeController@index')->name('user.home');
});

Route::prefix('admin')->namespace('Admin')->middleware('admin')->group(function() {
    Route::get('/', 'AdminController@index')->name('admin.home');
    Route::get('/register', 'RegisterController@showRegisterForm')->name('admin.register');
    Route::post('/register', 'RegisterController@create');
    Route::post('/logout', 'LoginController@logout')->name('admin.logout');
});
