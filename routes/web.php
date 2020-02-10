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

Route::get('/', function () {
    return view('welcome');
});

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
});


// ************************* Start of CLINIC ROUTES ******************************
Route::prefix('clinic')->group(function () {
	Route::get('/login', 'Auth\LoginController@showClinicAdminLoginForm')->name('clinic_login');
	Route::post('/login', 'Auth\LoginController@clinicAdminLogin');
	Route::get('/register', 'Auth\RegisterController@showClinicAdminRegisterForm')->name('clinic_register');
	Route::post('/register', 'Auth\RegisterController@createClinicAdmin');

	Route::get('/dashboard', 'Clinic\DashboardController@index')->name('clinic_dashboard');
});