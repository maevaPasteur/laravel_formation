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

// Formations
Route::get('/', 'FormationController@index')->name('formations.index');
Route::resource('formations', 'FormationController')->except(['index']);

// Sessions
Route::post('formations/{formation}', 'SessionController@store')->name('sessions.store');

Auth::routes();

// Home
Route::get('/home', 'HomeController@index')->name('home');

// Classrooms
Route::get('/classrooms', 'ClassroomController@index')->name('classrooms.index');
Route::post('/classrooms', 'ClassroomController@store')->name('classrooms.store');
