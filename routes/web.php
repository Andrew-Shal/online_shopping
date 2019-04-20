<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| TODO: 
|       n/a - work in progress
|
|
|
|@Route::resource('/ResourceName','ControllerName@webMethod') 
|    - gives the route '/ResourceName' CRUD capability
|   routes eg.
|       GET      /admin/dashboard/{resourceName}                //get all {resourceName} view
|       GET      /admin/dashboard/{resourceName}/{id}           //get a {resourceName} {id} view
|       GET      /admin/dashboard/{resourceName}/create         //create a {resourceName} view
|       POST     /admin/dashboard/{resourceName}                //Create a {resourceName}
|       PUT      /admin/dashboard/{resourceName}/{id}           //modify a {resourceName} with {id}
|       DELETE   /admin/dashboard/{resourceName}/{id}           //remove a {resourceName} with {id}
|
|
|
|@Route::group('prefixName', function(){collection of Route::}) 
|   - group a collection of routes, all routes must be accessed by prefixName '/prefixName/{resourceName}'
|
|
|@Route::middlware('middlewareName')->group(function(){collection of Route::})  
|   -  before accessing the route, client must first pass through the middleware
|
|
|@Route::{CRUD}('resourceName','ControllerName@webMethod')
|   - a specific crud operation get,post,put,patch,delete
|
|   
|@->name('name of route')
|   -   provides a custom and for the route so the route could be accessed by route('name of route')      
|
|
|@CRUD          -   get,post,put,delete,patch
|@webMethod     -   function in a specified controller to perform some operation, web methods are public
|@Controller    -   the class that contains a group of webMethods,utitlity functions,helpers, that provides operations for a specific resource 
|
|
*/

/**
 * 
 * --------------------
 *  Seller Routes     ->  By  AS completed on 19/04/19
 * --------------------
 *
 * user has to be authenicated, verified, and enabled sellers panel
 * 
 */
Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'verified', 'seller.enabled']], function () {
    //access    /admin/dashboard/{resource}

    Route::group(['prefix' => 'dashboard'], function () {

        Route::get('/', 'SellerController@index')->name('seller_home');         //get seller dashboard 
        Route::resource('/product', 'ProductController');                       //seller's {resource} CRUD
        Route::get('/product/{id}/{name}', 'ProductController@show');           //seller's {resource} show
        Route::resource('/posts', 'PostController');                            //seller's {resource} CRUD
        //Route::put('/posts/{id}', 'PostController@update');                            //seller's {resource} CRUD
        //Route::get('/posts', 'PostController@index');                            //seller's {resource} CRUD
        //Route::get('/posts/{id}/edit', 'PostController@edit');                            //seller's {resource} CRUD
    });
});


/**
 * 
 * --------------------
 *  Buyer Routes     ->  By  AS completed on 19/04/19
 * --------------------
 *
 * user has to be authenicated, and verified
 * 
 */
Route::group(['prefix' => 'dashboard', 'middleware' => ['auth', 'verified']], function () {
    //access    /dashboard/{resource}

    Route::get('/', 'BuyerController@index')->name('buyer_home');                                       //get buyer dashboard
    Route::get('/sellers', 'PagesController@enabling_seller_panel')->name('about.seller.enable');       //static page, about sellers panel
});















/*
 *--------------------
 *  Static Content Routes 
 *--------------------
 */
Route::get('/', 'PagesController@index');
Route::get('/about', 'PagesController@about');
Route::get('/services', 'PagesController@services');

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
 *  Recomendation Routes 
 *--------------------
 */
Route::get('/recommendation', 'RecommendationController@create')->name('recommendation.create');




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
//Route::middleware('auth')->group(function () {
//    Route::get('/my-orders', 'OrdersController@index');
//    Route::get('/my-orders/{order}', 'OrdersController@show');
//});


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
