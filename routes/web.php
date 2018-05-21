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

Route::get('product/getData', 'ProductKodamiController@getData');
Route::resource('product', 'ProductKodamiController');

Route::get('vendor/getData')->uses('VendorController@getData');
Route::resource('vendor', 'VendorController');

Route::get('salesAndDistribution/getData')->uses('SalesAndDistributionController@getData');
Route::resource('salesAndDistribution', 'SalesAndDistributionController');

Route::get('requestForQuotation/getData')->uses('RequestForQuotationController@getData');
Route::post('requestForQuotation/{requestForQuotation}/edit')->uses('RequestForQuotationController@update');
Route::resource('requestForQuotation', 'RequestForQuotationController');

Route::get('purchase-order/getData')->uses('PurchaseOrderController@getData');
Route::get('purchase-order/ajax_rfq_product/{id}')->uses('PurchaseOrderController@ajax_rfq_product');
Route::post('purchase-order/{purchase-order}/edit')->uses('PurchaseOrderController@update');
Route::resource('purchase-order', 'PurchaseOrderController');