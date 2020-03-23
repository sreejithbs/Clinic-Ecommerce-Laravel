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

Route::get('/clear', function(){
	Artisan::call('view:clear');
	Artisan::call('config:clear');
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
});

// Route::get('/', 'Auth\LoginController@showLoginForm')->name('home');
Route::get('/login', 'Auth\LoginController@showLoginForm')->name('common_login_form');
Route::post('/login', 'Auth\LoginController@handleLogin')->name('common_login_handle');
Route::post('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/', 'Site\CartController@index')->name('home');
Route::get('/cart', 'Site\CartController@viewCart')->name('view_cart');
Route::get('/cart/add/{uuid}', 'Site\CartController@addToCart')->name('add_to_cart');
Route::get('/cart/remove/{uuid}', 'Site\CartController@removeFromCart')->name('remove_from_cart');
Route::get('/cart/clear', 'Site\CartController@clearCart')->name('clear_cart');

Route::get('/checkout', 'Site\CheckoutController@createCheckout')->name('checkout_create');
Route::post('/checkout/store', 'Site\CheckoutController@storeCheckout')->name('checkout_store');


// ************************* Start of USER ROUTES ******************************
Route::prefix('user')->group(function () {
	Route::group(['as' => 'user_'], function(){
		Route::get('/login', 'Auth\LoginController@showUserLoginForm')->name('login_form');
		Route::post('/login', 'Auth\LoginController@handleUserLogin')->name('login_handle');
		Route::get('/dashboard', 'User\DashboardController@index')->name('dashboard');
	});
});


// ************************* Start of ADMIN ROUTES ******************************
Route::prefix('admin')->group(function () {
	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');
	Route::get('/my-profile', 'Admin\DashboardController@editProfile')->name('admin_profile_edit');
	Route::post('/my-profile', 'Admin\DashboardController@updateProfile')->name('admin_profile_update');

	Route::group(['as' => 'admin_user_'], function(){
		Route::get('/all', 'Admin\AdminController@index')->name('list')->middleware('can:isSuper');
	    Route::get('/create', 'Admin\AdminController@create')->name('create')->middleware('can:isSuper');
	    Route::post('/store', 'Admin\AdminController@store')->name('store')->middleware('can:isSuper');
	    Route::get('/edit/{uuid}', 'Admin\AdminController@edit')->name('edit')->middleware('can:isSuper');
	    Route::post('/update/{uuid}', 'Admin\AdminController@update')->name('update')->middleware('can:isSuper');
	    Route::delete('/delete/{uuid}', 'Admin\AdminController@destroy')->name('delete')->middleware('can:isSuper');
	});

	Route::group(['prefix' => 'product', 'as' => 'admin_product_'], function(){
	    Route::get('/all', 'Admin\ProductController@index')->name('list');
	    Route::get('/create', 'Admin\ProductController@create')->name('create')->middleware('can:isSuper');
	    Route::post('/store', 'Admin\ProductController@store')->name('store')->middleware('can:isSuper');
	    Route::get('/edit/{uuid}', 'Admin\ProductController@edit')->name('edit');
	    Route::post('/update/{uuid}', 'Admin\ProductController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'Admin\ProductController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'inventory', 'as' => 'admin_inventory_'], function(){
	    Route::get('/logs/{uuid}', 'Admin\InventoryLogController@index')->name('logs_list');
	    Route::get('/view/{uuid}', 'Admin\InventoryLogController@view')->name('log_view');

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

	Route::group(['prefix' => 'clinic/order', 'as' => 'admin_order_clinic_'], function(){
	    Route::get('/all', 'Admin\ClinicOrderController@index')->name('list');
	    Route::get('/view/{uuid}', 'Admin\ClinicOrderController@view')->name('view');
	});
});


// ************************* Start of CLINIC ROUTES ******************************
Route::prefix('clinic')->group(function () {
	Route::get('/dashboard', 'Clinic\DashboardController@index')->name('clinic_dashboard');
	Route::get('/my-profile', 'Clinic\DashboardController@editProfile')->name('clinic_profile_edit');
	Route::post('/my-profile', 'Clinic\DashboardController@updateProfile')->name('clinic_profile_update');

	Route::group(['prefix' => 'inventory', 'as' => 'clinic_inventory_'], function(){
	    Route::get('/all', 'Clinic\InventoryController@index')->name('list');
	    Route::post('/appendProduct', 'Clinic\InventoryController@appendProduct')->name('append_product');
	});

	Route::group(['prefix' => 'sales', 'as' => 'clinic_sales_'], function(){
	    Route::get('/all', 'Clinic\SalesController@index')->name('list');
	    Route::get('/create', 'Clinic\SalesController@create')->name('create');
	    Route::post('/store', 'Clinic\SalesController@store')->name('store');
	    Route::get('/view/{uuid}', 'Clinic\SalesController@view')->name('view');
	});
});