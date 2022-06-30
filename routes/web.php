<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TestController;
use App\Http\Controllers\TokenController;
use App\Http\Controllers\mailSender;
use App\Http\Controllers\SocialAuthh;

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

Route::get('/',[TestController::class,'home'])->name('home');
Route::post('/get-token',[TokenController::class,'generateToken'])->name('generateToken');
Route::get('/get-token',[TokenController::class,'getToken'])->name('getToken');
Route::post('sendMail',[mailSender::class,'sendMail']);
Route::get('twitter',[SocialAuthh::class,'twitter']);
Route::get('twitterResponse',[SocialAuthh::class,'twitterResponse']);
