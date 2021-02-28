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

Route::post('/register', '\App\Http\Controllers\AuthController@register')->name('register');

Route::post('/login', '\App\Http\Controllers\AuthController@login')->name('login');
Route::post('/logout', '\App\Http\Controllers\AuthController@logout')->name('logout');
