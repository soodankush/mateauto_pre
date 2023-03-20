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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('auth:sanctum')->get('/user/logout', 'App\Http\Controllers\API\AuthController@userLogout')->name('user.logout');

Route::get('/login', 'App\Http\Controllers\API\AuthController@getLogin')->name('login');
Route::post('/register', 'App\Http\Controllers\API\AuthController@register');
Route::post('/login', 'App\Http\Controllers\API\AuthController@login');
Route::get('/{platform}/user/login', 'App\Http\Controllers\API\PlatformController@getLoginUrl')->middleware('auth:sanctum');

Route::get('/twitter/bookmarks', 'App\Http\Controllers\API\Platform\TwitterController@getBookmarks')->middleware('auth:sanctum');
Route::get('/twitter/tweets', 'App\Http\Controllers\API\Platform\TwitterController@getTweets')->middleware('auth:sanctum');
Route::get('/twitter/profile', 'App\Http\Controllers\API\Platform\TwitterController@getMyProfile')->middleware('auth:sanctum');