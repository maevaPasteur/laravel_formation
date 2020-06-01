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

Auth::routes();

// Formations
Route::get('/', 'FormationController@index')->name('formations.index');
Route::resource('formations', 'FormationController')->except(['index']);

// Sessions
Route::post('formations/{formation}', 'SessionController@store')->name('sessions.store');
Route::get('sessions/{session}', 'SessionController@show')->name('sessions.show');
Route::get('sessions/inscription/{session}', 'SessionController@inscription')->name('sessions.inscription');

// Profile
Route::get('profile', 'ProfileController@index')->name('profile.index');
Route::patch('profile/{profile}', 'ProfileController@update')->name('profile.update');
Route::resource('profile', 'ProfileController', ['only'=> ['index','update','destroy']]);


// Home
Route::get('/home', 'HomeController@index')->name('home');

// Classrooms
Route::middleware('can:is-admin')->group(function () {
    Route::get('/classrooms', 'ClassroomController@index')->name('classrooms.index');
});
Route::post('/classrooms', 'ClassroomController@store')->name('classrooms.store');

// Categories
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::post('/categories', 'CategoryController@store')->name('categories.store');

// Users
Route::get('/users', 'UserController@index')->name('users.index');

Auth::routes();
