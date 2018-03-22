<?php


Route::get('/', function () {
    return view('layout/ex');
})->name('home')->middleware('auth');

Route::get('home', function () {
    return view('layout/ex');
})->name('home')->middleware('auth');

Route::get('tele')->uses('TeleController@index');

Route::get('login')->uses('Auth\LoginController@index')->name('login');
Route::post('login')->uses('Auth\LoginController@check');
Route::resource('banners', 'BannerController');