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

//Route::get('/', function () {
//    return view('welcome');
//});
//
//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');

Route::get('/', 'QrController@index')->name('qr_builder');
Route::post('/qr-build', 'QrController@quBuild')->name('doQr');

Route::get('/email', 'QrController@email')->name('qr_email');
Route::post('/email', 'QrController@doEmail')->name('do_email');

Route::get('/phone', 'QrController@phone')->name('qr_phone');
Route::post('/phone', 'QrController@doPhone')->name('do_phone');

Route::get('/sms', 'QrController@sms')->name('qr_sms');
Route::post('/sms', 'QrController@doSms')->name('do_sms');

Route::get('/wifi', 'QrController@wifi')->name('qr_wifi');
Route::post('/wifi', 'QrController@doWifi')->name('do_wifi');
