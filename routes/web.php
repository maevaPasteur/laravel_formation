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

Route::get('/', 'FormationController@index')->name('formations.index');
Route::resource('formations', 'FormationController')->except(['index']);

Route::post('/sessions/{formation}', 'SessionController@store')->name('sessions.store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');


