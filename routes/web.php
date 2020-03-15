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

// Route::get('/clear', function(){
// 	Artisan::call('view:clear');
// 	Artisan::call('cache:clear');
// 	Artisan::call('config:cache');
// });

Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('common_login_form');
Route::post('/login', 'Auth\LoginController@handleLogin')->name('common_login_handle');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');


// ************************* Start of USER ROUTES ******************************
Route::prefix('user')->group(function () {
	Route::group(['as' => 'user_'], function(){
		Route::get('/dashboard', 'User\DashboardController@index')->name('dashboard');
	});
});


// ************************* Start of ADMIN ROUTES ******************************
Route::prefix('admin')->group(function () {
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');
	Route::get('/my-profile', 'Admin\DashboardController@editProfile')->name('admin_profile_edit');
	Route::post('/my-profile', 'Admin\DashboardController@updateProfile')->name('admin_profile_update');

	Route::group(['as' => 'admin_user_'], function(){
		Route::get('/all', 'Admin\AdminController@index')->name('list');
	    Route::get('/create', 'Admin\AdminController@create')->name('create');
	    Route::post('/store', 'Admin\AdminController@store')->name('store');
	    Route::get('/edit/{uuid}', 'Admin\AdminController@edit')->name('edit');
	    Route::post('/update/{uuid}', 'Admin\AdminController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'Admin\AdminController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'product', 'as' => 'admin_product_'], function(){
	    Route::get('/all', 'Admin\ProductController@index')->name('list');
	    Route::get('/create', 'Admin\ProductController@create')->name('create');
	    Route::post('/store', 'Admin\ProductController@store')->name('store');
	    Route::get('/edit/{uuid}', 'Admin\ProductController@edit')->name('edit');
	    Route::post('/update/{uuid}', 'Admin\ProductController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'Admin\ProductController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'inventory', 'as' => 'admin_inventory_'], function(){
	    Route::get('/logs/{uuid}', 'Admin\InventoryLogController@index')->name('logs_list');

	    Route::get('/purchase/create/{uuid}', 'Admin\InventoryPurchaseController@create')->name('purchase_create');
	    Route::post('/purchase/store/{uuid}', 'Admin\InventoryPurchaseController@store')->name('purchase_store');
	    
	    Route::get('/transfer/create/{uuid}', 'Admin\InventoryTransferController@create')->name('transfer_create');
	    Route::post('/transfer/store/{uuid}', 'Admin\InventoryTransferController@store')->name('transfer_store');
	});

	Route::group(['prefix' => 'clinic', 'as' => 'admin_clinic_'], function(){
	    Route::get('/all', 'Admin\ClinicController@index')->name('list');
	    Route::get('/create', 'Admin\ClinicController@create')->name('create');
	    Route::post('/store', 'Admin\ClinicController@store')->name('store');
	    Route::get('/edit/{uuid}', 'Admin\ClinicController@edit')->name('edit');
	    Route::post('/update/{uuid}', 'Admin\ClinicController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'Admin\ClinicController@destroy')->name('delete');
	    Route::post('/toggleClinicStatus', 'Admin\ClinicController@toggleClinicStatus')->name('toggle_status');
	});
});


// ************************* Start of CLINIC ROUTES ******************************
Route::prefix('clinic')->group(function () {
	Route::group(['as' => 'clinic_'], function(){
		Route::get('/dashboard', 'Clinic\DashboardController@index')->name('dashboard');
	});
});