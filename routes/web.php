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
	Artisan::call('cache:clear');
	Artisan::call('config:cache');
});

Route::get('/', 'Auth\LoginController@showAdminLoginForm')->name('home');

Auth::routes();

// ************************* Start of USER ROUTES ******************************
Route::prefix('user')->group(function () {
	Route::get('/dashboard', 'User\DashboardController@index')->name('user_dashboard');
});


// ************************* Start of ADMIN ROUTES ******************************
Route::prefix('admin')->group(function () {
	Route::get('/login', 'Auth\LoginController@showAdminLoginForm')->name('admin_login');
	Route::post('/login', 'Auth\LoginController@adminLogin');
	Route::get('/register', 'Auth\RegisterController@showAdminRegisterForm')->name('admin_register');
	Route::post('/register', 'Auth\RegisterController@createAdmin');

	Route::get('/dashboard', 'Admin\DashboardController@index')->name('admin_dashboard');

	Route::group(['prefix' => 'product', 'as' => 'admin_product_'], function(){
	    Route::get('/all', 'Admin\ProductController@index')->name('list');
	    Route::get('/create', 'Admin\ProductController@create')->name('create');
	    Route::post('/store', 'Admin\ProductController@store')->name('store');
	    Route::get('/edit/{uuid}', 'Admin\ProductController@edit')->name('edit');
	    Route::post('/update/{uuid}', 'Admin\ProductController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'Admin\ProductController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'clinic', 'as' => 'admin_clinic_'], function(){
	    Route::get('/all', 'Admin\ClinicController@index')->name('list');
	    Route::get('/create', 'Admin\ClinicController@create')->name('create');
	    Route::post('/store', 'Admin\ClinicController@store')->name('store');
	    Route::get('/edit/{uuid}', 'Admin\ClinicController@edit')->name('edit');
	    Route::post('/update/{uuid}', 'Admin\ClinicController@update')->name('update');
	    Route::delete('/delete/{uuid}', 'Admin\ClinicController@destroy')->name('delete');
	});

	Route::group(['prefix' => 'inventory/purchase', 'as' => 'admin_inventory_purchase_'], function(){
	    Route::get('/all', 'Admin\InventoryPurchaseController@index')->name('list');
	    Route::get('/create', 'Admin\InventoryPurchaseController@create')->name('create');
	    Route::post('/store', 'Admin\InventoryPurchaseController@store')->name('store');
	    Route::post('/storeSupplier', 'Admin\InventoryPurchaseController@storeSupplier')->name('store_supplier');
	});

});


// ************************* Start of CLINIC ROUTES ******************************
Route::prefix('clinic')->group(function () {
	Route::get('/login', 'Auth\LoginController@showClinicAdminLoginForm')->name('clinic_login');
	Route::post('/login', 'Auth\LoginController@clinicAdminLogin');
	Route::get('/register', 'Auth\RegisterController@showClinicAdminRegisterForm')->name('clinic_register');
	Route::post('/register', 'Auth\RegisterController@createClinicAdmin');

	Route::get('/dashboard', 'Clinic\DashboardController@index')->name('clinic_dashboard');
});