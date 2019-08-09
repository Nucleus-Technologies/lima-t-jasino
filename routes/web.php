<?php
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

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

Route::get('/', 'PagesController@index')->name('home');

// Customer & Visitor Routes

Auth::routes();

Route::prefix('users')->group(function() {
    // Customer Outfits Routes
    Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create')
    ->middleware('auth');

    // Log Out Route
    Route::post('/logout', 'Auth\LoginController@log_out')->name('user.logout');
});

// Admin Routes

Route::prefix('admin')->group(function() {
    // Log In Routes
    Route::get('/login', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login');

    // Dashboard Route
    Route::get('/dashboard', 'AdminController@index')->name('admin.dashboard');

    // Admin Outfits Routes
    Route::get('/outfit', 'OutfitController@index')->name('admin.outfit');
    Route::get('/outfit/create', 'OutfitController@create')->name('admin.outfit.create');
    Route::post('/outfit', 'OutfitController@store')->name('admin.outfit.store');
    Route::get('/outfit/{outfit}', 'OutfitController@show')->name('admin.outfit.show');

    // Admin Profile Routes
    Route::get('/profile', 'AdminController@edit')->name('admin.profile');
    Route::put('/profile', 'AdminController@update')->name('admin.profile');

    // Log Out Route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
