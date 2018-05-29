<?php


Route::get('/', function () {
    return view('layout/ex');
})->name('home')->middleware('auth');

Route::get('home', function () {
    return view('layout/ex');
})->name('home')->middleware('auth');

Route::get('tele')->uses('TeleController@index');
Route::get('place/getAjaxRegency')->uses('PlaceController@getAjaxRegency');

Route::get('login')->uses('Auth\LoginController@index')->name('login');
Route::post('login')->uses('Auth\LoginController@check');
Route::resource('banners', 'BannerController');

Route::get('product/getData', 'ProductKodamiController@getData');
Route::resource('product', 'ProductKodamiController');


Route::prefix('vendor')->group(function () {
	Route::get('intern', 'Vendor\InternController@index');
	Route::get('intern/getData', 'Vendor\InternController@getData');
	Route::get('intern/create', 'Vendor\InternController@create');
	Route::get('intern/{id}/edit', 'Vendor\InternController@edit');
	Route::get('intern/destroy/{id}', 'Vendor\InternController@destroy');
	Route::post('intern', 'Vendor\InternController@store');
	Route::post('intern/{id}/edit', 'Vendor\InternController@put');

  	Route::get('koprasi', 'Vendor\KoprasiController@index');
  	Route::get('koprasi/getData', 'Vendor\KoprasiController@getData');
  	Route::get('koprasi/getUnregisteredUser', 'Vendor\KoprasiController@getUnregisteredUser');
  	Route::get('koprasi/{id}/view', 'Vendor\KoprasiController@view');
  	Route::get('koprasi/{id}/process', 'Vendor\KoprasiController@process');
  	Route::post('koprasi/{id}/process', 'Vendor\KoprasiController@store_process');
});


Route::get('salesAndDistribution/getData')->uses('SalesAndDistributionController@getData');
Route::resource('salesAndDistribution', 'SalesAndDistributionController');

Route::get('requestForQuotation/getData')->uses('RequestForQuotationController@getData');
Route::post('requestForQuotation/{requestForQuotation}/edit')->uses('RequestForQuotationController@update');
Route::resource('requestForQuotation', 'RequestForQuotationController');

Route::get('purchase-order/getData')->uses('PurchaseOrderController@getData');
Route::get('purchase-order/ajax_rfq_product/{id}')->uses('PurchaseOrderController@ajax_rfq_product');
Route::post('purchase-order/{purchase-order}/edit')->uses('PurchaseOrderController@update');
Route::resource('purchase-order', 'PurchaseOrderController');

Route::post('upload/image')->uses('UploadController@imageUpload');
