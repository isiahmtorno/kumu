<?php

use App\Http\Controllers\GitHubController;
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

Route::group(['namespace' => 'App\Http\Controllers\Auth'], function () {
    Route::post('/register', 'RegisterController@register');
    Route::post('/login', 'AuthenticationController@login');
});

Route::middleware(['auth:api'])->group(function () {
    Route::post('/logout', 'App\Http\Controllers\Auth\AuthenticationController@logout');
    Route::post('/github', GitHubController::class);
});