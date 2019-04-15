<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| TODO: 
|       - add delete,patch Routes for Products
|       - add my-profile route for User 
|       - add more static content routes
|       - and more...  
|
*/

/*
 *--------------------
 *  Static Content Routes 
 *--------------------
 */
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');
Route::get('/sellers', 'PagesController@enabling_seller_panel');
Route::resource('/posts', 'PostController');
Route::get('/dashboard', 'DashboardController@buyers_panel')->name('dashboard.buyer');
Route::get('/home', 'DashboardController@index');
Route::get('/admin/dashboard', 'DashboardController@sellers_panel')->name('dashboard.seller');


/**
 *===================================================
 *===================================================
 *===           Routes needed for Demo 1          ===
 *===================================================
 *===================================================
 *===   Products   
 *===   User
 *===   Cart
 *===   Checkout
 *===   My Orders
 *===================================================
 *===================================================
 * */


/*
 *--------------------
 *  Product Routes 
 *--------------------
 */
Route::post('admin/dashboard/products', 'ProductController@store')->name('product.store');
Route::get('admin/dashboard/products/create', 'ProductController@create')->name('product.create');
Route::get('/products', 'ProductController@index')->name('product.index');
Route::get('/products/{id}/{name}', 'ProductController@show');

/*
 *--------------------
 *  Cart Routes 
 *--------------------
 */
Route::get('/cart', 'CartController@index')->name('cart.index');
Route::post('/cart', 'CartController@store')->name('cart.store');
Route::patch('/cart', 'CartController@update')->name('cart.updateQty');
Route::delete('/cart/{id}', 'CartController@destroyItem')->name('cart.removeItem');
Route::delete('/cart', 'CartController@destroyCart')->name('cart.clearCart');

/*
 *--------------------
 *  Billing Routes 
 *--------------------
 */
Route::get('/billing/create', 'BillingController@create')->name('billing.create');
Route::post('/billing', 'BillingController@store')->name('billing.store');

/*
 *--------------------
 *  Rating Routes 
 *--------------------
 */
Route::get('/rating/{pid}', 'RatingController@create')->name('rating.create');
Route::get('/rating', 'RatingController@index')->name('rating.create');
Route::post('/rating', 'RatingController@store')->name('rating.store');

/*
 *--------------------
 *  Checkout Routes 
 *--------------------
 */
Route::get('/checkout', 'CheckoutController@index')->name('checkout.index')->middleware('auth');
Route::post('/checkout', 'CheckoutController@store')->name('checkout.store');
Route::get('/guestCheckout', 'CheckoutController@index')->name('guestCheckout.index');
Route::get('/thankyou', 'ConfirmationController@index')->name('confirmation.index');


/*
 *--------------------
 *  Protected Routes 
 *--------------------
 *
 * uses middleware auth
 * 
 */
Route::middleware('auth')->group(function () {
    Route::get('/my-orders', 'OrdersController@index');
    Route::get('/my-orders/{order}', 'OrdersController@show');
});


/*
 *--------------------
 *  Auth Route
 *
 *  used to enable laravel
 *  authentication feature
 * 
 *  @params array[] verify is set to true
 *  for email verification  
 *--------------------
 */
Auth::routes(['verify' => true]);
