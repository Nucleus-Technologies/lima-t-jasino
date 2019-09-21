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

// Website Pages

Route::get('/', 'PagesController@index')->name('home');
Route::get('/collection', 'PagesController@collection')->name('collection');
Route::get('/collection/men', 'PagesController@men_collection')->name('collection.men');
Route::get('/collection/women', 'PagesController@women_collection')->name('collection.women');
Route::get('/collection/weddings', 'PagesController@weddings_collection')->name('collection.weddings');

// Admin Regions & Cities Routes
Route::get('/regions', 'RegionCityController@regions')->name('regions');
Route::get('/region-{region}/cities', 'RegionCityController@cities')->name('region.cities');

// Customer & Visitor Routes

Auth::routes();

Route::prefix('users')->group(function() {
    // Customer Appointments Routes
    Route::get('/appointment', 'AppointmentController@index')->name('appointment')
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
    Route::get('/notification', 'NotificationController@index')->name('notification')
        ->middleware('auth');
    Route::put('/notification/notification-{notification}/read', 'NotificationController@read')->name('notification.read')
        ->middleware('auth');
    Route::get('/notification/refresh', 'NotificationController@refresh')->name('notification.refresh')
        ->middleware('auth');

    // Customer Outfits Routes
    Route::get('/outfit/shop', 'OutfitController@index')->name('outfit.shop');
    Route::get('/outfit/search', 'OutfitController@search')->name('outfit.search');
    Route::get('/outfit/{outfit}', 'OutfitController@show')->name('outfit.show');

    // Customer Cart Routes
    Route::get('/cart', 'CartController@index')->name('cart');
    Route::post('/cart/outfit-{outfit}/store', 'CartController@store')->name('cart.outfit.store');
    Route::delete('/cart/line-{cart}/destroy', 'CartController@destroy')->name('cart.line.destroy');
    Route::get('/cart/refresh', 'CartController@refresh')->name('cart.refresh');
    Route::get('/cart/icon/refresh', 'CartController@refresh_icon')->name('cart.icon.refresh');
    Route::put('/cart/line-{cart}/quantity/update', 'CartController@update_quantity')->name('cart.line.quantity.update');

    // Customer Wishlist Routes
    Route::get('/wishlist', 'WishlistController@index')->name('wishlist');
    Route::post('/wishlist/outfit-{outfit}/store', 'WishlistController@store')->name('wishlist.outfit.store');
    Route::delete('/wishlist/line-{wishlist}/destroy', 'WishlistController@destroy')->name('wishlist.line.destroy');
    Route::get('/wishlist/refresh', 'WishlistController@refresh')->name('cart.refresh');

    // Payment Checkout Routes
    Route::get('/payment/checkout/address_details', 'CheckoutController@index')->name('payment.checkout.address_details')
        ->middleware('auth');
    Route::get('/payment/checkout/address_details/refresh-nz', 'CheckoutController@refresh_nz')->name('payment.checkout.address_details.nz')
        ->middleware('auth');
    Route::get('/payment/checkout/address_details/refresh-inz', 'CheckoutController@refresh_inz')->name('payment.checkout.address_details.inz')
        ->middleware('auth');
    Route::post('/payment/checkout/delivery_method', 'AddressController@store')->name('payment.checkout.address_details.store')
        ->middleware('auth');
    Route::post('/payment/checkout/delivery_method_', 'AddressController@chosen')->name('payment.checkout.address_details.chosen')
        ->middleware('auth');
    Route::get('/payment/checkout/delivery_method', 'CheckoutController@delivery_method')->name('payment.checkout.delivery_method')
        ->middleware('auth');
    Route::get('/payment/checkout/delivery_method/relaypoint/region-{region}-city-{city}', 'RelayPointController@load')
        ->name('payment.checkout.delivery_method.relaypoint.load')
        ->middleware('auth');
    Route::get('/payment/checkout/order_inner-{relayPoint}/refresh', 'CheckoutController@refresh_order_inner')
        ->name('payment.checkout.order_inner.refresh')
        ->middleware('auth');
    Route::post('/payment/checkout/delivery_method/store', 'OrderController@store')->name('payment.checkout.delivery_method.store')
        ->middleware('auth');
    Route::get('/payment/checkout/payment_mode', 'CheckoutController@payment_mode')->name('payment.checkout.payment_mode')
        ->middleware('auth');
    Route::post('/payment/checkout/payment_mode', 'PaymentController@store')->name('payment.checkout.payment_mode.store')
        ->middleware('auth');
    Route::get('/payment/checkout/confirmation-{order}-{payment}', 'CheckoutController@confirmation')->name('payment.checkout.confirmation')
        ->middleware('auth');

    // Customer Orders Routes
    Route::get('/order', 'OrderController@index')->name('order')->middleware('auth');
    Route::get('/order/order-{order}', 'OrderController@show')->name('order.show')->middleware('auth');

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
    Route::get('/outfit', 'OutfitController@index')->name('admin.outfit')
        ->middleware('auth:admin');
    Route::get('/outfit/create', 'OutfitController@create')->name('admin.outfit.create')
        ->middleware('auth:admin');
    Route::post('/outfit', 'OutfitController@store')->name('admin.outfit.store')
        ->middleware('auth:admin');
    Route::get('/outfit/{outfit}', 'OutfitController@show')->name('admin.outfit.show')
        ->middleware('auth:admin');

    // Admin Appointments Routes
    Route::get('/appointment', 'AppointmentController@index')->name('admin.appointment')
        ->middleware('auth:admin');
    Route::get('/appointment/appointment-{appointment}', 'AppointmentController@show')->name('admin.appointment.show')
        ->middleware('auth:admin');
    Route::post('/appointment/appointment-{appointment}/done', 'AppointmentController@done')->name('admin.appointment.done')
        ->middleware('auth:admin');
    // Admin Appointment Messages Routes
    Route::post('/appointment/appointment-{appointment}/reply', 'AppointmentController@reply')->name('admin.appointment.reply')
        ->middleware('auth:admin');

    // Admin Notifications Routes
    Route::get('/notification', 'NotificationController@index')->name('admin.notification')
        ->middleware('auth:admin');
    Route::put('/notification/notification-{notification}/read', 'NotificationController@read')->name('admin.notification.read')
        ->middleware('auth:admin');
    Route::get('/notification/refresh', 'NotificationController@refresh')->name('admin.notification.refresh')
        ->middleware('auth:admin');

    // Admin Regions & Cities Routes
    Route::get('/region_city', 'RegionCityController@index')->name('admin.region_city')
        ->middleware('auth:admin');
    Route::post('/region_city/store', 'RegionCityController@store')->name('admin.region_city.store')
        ->middleware('auth:admin');

    // Admin Regions & Cities Routes
    Route::get('/relaypoint', 'RelayPointController@index')->name('admin.relaypoint')
        ->middleware('auth:admin');
    Route::post('/relaypoint/store', 'RelayPointController@store')->name('admin.relaypoint.store')
        ->middleware('auth:admin');
    Route::get('/relaypoint/relaypoint-{relayPoint}', 'RelayPointController@show')->name('admin.relaypoint.show')
        ->middleware('auth:admin');

    // Admin Orders Routes
    Route::get('/order', 'OrderController@index')->name('admin.order')->middleware('auth:admin');
    Route::get('/order/order-{order}', 'OrderController@show')->name('admin.order.show')->middleware('auth:admin');

    // Admin Profile Routes
    Route::get('/profile', 'AdminController@edit')->name('admin.profile');
    Route::put('/profile', 'AdminController@update')->name('admin.profile');

    // Log Out Route
    Route::post('/logout', 'Auth\AdminLoginController@logout')->name('admin.logout');
});
