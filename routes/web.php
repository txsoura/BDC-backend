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

Route::group(['prefix' => 'auth/user', 'middleware' => 'auth:sanctum'], function () {
    Route::get('/', 'MeController@me');
    Route::get('constructions/{id}', 'MeController@construction')->middleware('x.company');
});
