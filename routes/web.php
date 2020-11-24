<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great! 
*/

Route::get('/', function () {
    return view('welcome');
});

Route::get('signUp', 'user\UserController@signUp')->name('SignUp');

Route::get('login', 'Auth\LoginController@login')->name('Login');
Route::post('loginUser', 'Auth\LoginController@loginUser');
Route::post('createUser', 'Auth\RegisterController@create');

Route::get('AdminDashboard', 'admin\AdminController@AdminDashboard')->name('AdminDashboard');
Route::get('dashboard', 'admin\AdminController@dashboard')->name('Dashboard');
Route::get('createNew', 'admin\AdminController@createNew')->name('User');
Route::post('createUserAjax', 'admin\AdminController@createUserAjax');
Route::get('salary', 'admin\AdminController@salary')->name('Salary');
Route::post('salaryCal', 'admin\AdminController@salaryCal');

Route::get('logout/{role}', 'admin\AdminController@logout');
