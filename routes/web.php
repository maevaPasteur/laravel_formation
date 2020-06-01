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
Route::post('/classrooms', 'ClassroomController@store')->name('classrooms.store');

// Categories
Route::get('/categories', 'CategoryController@index')->name('categories.index');
Route::post('/categories', 'CategoryController@store')->name('categories.store');

// Users
Route::get('/users', 'UserController@index')->name('users.index')->middleware('auth');
Route::put('/users/{user}/verification', 'UserController@validateUser')->name('users.validateUser')->middleware('auth');
Route::resource('users', 'UserController')->except(['index']);

// Sessions
Route::get('/sessions', 'SessionController@index')->name('sessions.index')->middleware('auth');
Route::delete('/sessions/{session}', 'SessionController@destroy')->name('sessions.destroy');

// DOCUMENTATION

// To set a route visible only by VERIFIED user && admin or teacher (a teacher not verified can't view this page, so)

// Route::middleware('can:viewall')->group(function () { 
//   YOUR ROUTE
//   ex : Route::delete('/sessions/{session}', 'SessionController@destroy')->name('sessions.destroy');
// });

// To set a route visible only by
