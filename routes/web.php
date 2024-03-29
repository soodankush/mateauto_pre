<?php

use Illuminate\Support\Facades\Route;

// use App\Http\Controllers;
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

Route::get('/old', function () {
    return view('welcome_old');
})->name('home');

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', function () {
    return Redirect::to('https://app.' . $_SERVER['SERVER_NAME'] . '/');
})->name('user.login');

Route::post('store-email', 'App\Http\Controllers\EmailController@storeEmail')->name('email.store');

Route::get('verify_email/{token}', 'App\Http\Controllers\EmailController@verifyPrelaunchEmail')->name('prelaunch.email.verify');

Route::get('callback/{platform}', 'App\Http\Controllers\API\PlatformController@getPlatformCallback')->name('redirect.url');
