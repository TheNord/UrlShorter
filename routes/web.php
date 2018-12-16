<?php

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

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/cabinet', 'CabinetController@index')->name('cabinet.index');
Route::get('/cabinet/links', 'CabinetController@links')->name('cabinet.links');


Route::post('/shorter', 'ShorterController@store')->name('shorter.store');
Route::get('/shorter/{link}', 'ShorterController@show')->name('shorter.show');

Route::get('/shorter/detail/{link}', 'ShorterController@showFull')->name('shorter.detail');

Route::get('/shorter/statistic/{link}', 'ShorterController@statistic')->name('shorter.statistic');

Route::get('/{link}', 'ShorterController@redirectUrl');