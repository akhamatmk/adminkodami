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

Route::post('banners/{id}/edit')->uses('BannerController@put');
Route::get('banners/destroy/{id}')->uses('BannerController@destroy');
Route::resource('banners', 'BannerController');

Route::post('advertisement/{id}/edit')->uses('AdvertisementController@put');
Route::get('advertisement/destroy/{id}')->uses('AdvertisementController@destroy');
Route::resource('advertisement', 'AdvertisementController');

Route::post('our-product/{id}/edit')->uses('OurProductController@put');
Route::get('our-product/destroy/{id}')->uses('OurProductController@destroy');
Route::resource('our-product', 'OurProductController');

Route::post('bank/{id}/edit')->uses('BankController@put');
Route::get('bank/destroy/{id}')->uses('BankController@destroy');
Route::resource('bank', 'BankController');

Route::post('specialoffer/{id}/edit')->uses('SpecialOfferProductController@put');
Route::get('specialoffer/destroy/{id}')->uses('SpecialOfferProductController@destroy');
Route::resource('specialoffer', 'SpecialOfferProductController');

Route::get('product/getData', 'ProductKodamiController@getData');
Route::resource('product', 'ProductKodamiController');

Route::get('category/ajaxGetChild', 'CategoryController@ajaxGetChild');
Route::get('category/criteria', 'CategoryController@criteria');
Route::get('category/spesification', 'CategoryController@spesification');


Route::get('transaction/saldo/change/{id}/{type}', 'Transaction\SaldoController@change');
Route::resource('transaction/saldo', 'Transaction\SaldoController');

Route::get('transaction', 'TransactionController@index');
Route::get('transaction/ajax', 'TransactionController@ajax');
Route::get('transaction/change/{id}/{type}', 'TransactionController@change');

Route::resource('landing/page/category/product', 'LandingPageCategoryProductController');

Route::resource('landing/page/category/product/{id}/detail', 'LandingPageCategoryProductDetailController');
Route::get('landing/page/category/product/{id}/detail/delete/{id_sub}', 'LandingPageCategoryProductDetailController@destroy');

Route::post('vendor/{id_koprasi}/product/{id}/change/status', 'Vendor\ProductController@change_status');
Route::get('vendor/{id_koprasi}/product/{id}/detail', 'Vendor\ProductController@detail');
Route::resource('vendor/{id}/product', 'Vendor\ProductController');

Route::post('vendor/{id}/change/status', 'VendorController@change_status');
Route::resource('vendor', 'VendorController');
Route::get('vendor/{id}/detail', 'VendorController@detail');


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
