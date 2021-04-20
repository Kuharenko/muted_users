<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::resource('posts', \App\Http\Controllers\PostController::class);
Route::resource('users', \App\Http\Controllers\UserController::class);

Route::post('mute', [\App\Http\Controllers\MuteController::class, 'store']);
Route::get('{user}/muted', [\App\Http\Controllers\MuteController::class, 'show']);
