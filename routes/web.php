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
    // Customer Appointments Routes
    Route::get('/appointment', 'AppointmentController@index_u')->name('appointment')
        ->middleware('auth');
    Route::get('/appointment/create', 'AppointmentController@create')->name('appointment.create')
        ->middleware('auth');
    Route::post('/appointment/store', 'AppointmentController@store')->name('appointment.store')
        ->middleware('auth');
    Route::get('/appointment/appointment-{appointment}', 'AppointmentController@show')->name('appointment.show')
        ->middleware('auth');
    // Customer Appointment Messages Routes
    Route::post('/appointment/appointment-{appointment}/reply', 'AppointmentController@reply')->name('appointment.reply')
        ->middleware('auth');

    // Customer Notifications Routes
    Route::post('/notification', 'NotificationController@index_u')->name('notification')
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

    // Admin Appointments Routes
    Route::get('/appointment', 'AppointmentController@index_a')->name('admin.appointment')
        ->middleware('auth:admin');
    Route::get('/appointment/appointment-{appointment}', 'AppointmentController@show')->name('admin.appointment.show')
        ->middleware('auth:admin');
    Route::post('/appointment/appointment-{appointment}/done', 'AppointmentController@done')->name('admin.appointment.done')
        ->middleware('auth:admin');
    // Admin Appointment Messages Routes
    Route::post('/appointment/appointment-{appointment}/reply', 'AppointmentController@reply')->name('admin.appointment.reply')
        ->middleware('auth:admin');

    // Admin Profile Routes
    Route::get('/profile', 'AdminController@edit')->name('admin.profile');
    Route::put('/profile', 'AdminController@update')->name('admin.profile');

    // Log Out Route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
