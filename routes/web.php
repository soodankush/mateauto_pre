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
})->name('home');

Route::post('store-email', 'App\Http\Controllers\EmailController@storeEmail')->name('email.store');

Route::get('verify_email/{token}', 'App\Http\Controllers\EmailController@verifyPrelaunchEmail')->name('prelaunch.email.verify');