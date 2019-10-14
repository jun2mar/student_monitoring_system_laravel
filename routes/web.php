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
    return view('pages.home');
});

Auth::routes();

Route::get('/account/dashboard', 'AccountController@index')->name('accnt_dashboard');
Route::get('/account/profile', 'AccountController@profile')->name('accnt_profile');
Route::post('/account/profile/submit_update', 'AccountController@profile_submit_update')->name('accnt_profile_submit_update');
