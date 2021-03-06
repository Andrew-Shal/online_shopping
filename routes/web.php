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

/*
 *--------------------
 *  Static Content Routes   ->  By  AS pages incomplete
 *--------------------
 */
Route::get('/about', 'PagesController@about')->name('page.about');
Route::get('/contact', 'PagesController@contact')->name('page.contact');


/**
 * 
 * --------------------
 * Landing Page     ->  By  AS completed on 21/04/19
 * --------------------
 * 
 */
Route::get('/', 'PagesController@index');


/**
 * 
 * --------------------
 * Shop Pages     ->  By  AS completed on 21/04/19
 * --------------------
 * 
 */
Route::group(['prefix' => 'shop'], function () {
    Route::get('/', 'ShopController@index')->name('shop.index');
    Route::get('/products', 'ShopController@productList')->name('shop.product.list');
    Route::get('/products/search', 'ShopController@productSearch')->name('shop.product.search');
    Route::get('/product/{p_id}/{p_slug}', 'ShopController@productDetail')->name('shop.product.detail');
});


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

        Route::get('/', 'SellerController@index')->name('seller_home');                         //get seller dashboard 
        Route::resource('/product', 'ProductController');                                       //seller's product resource CRUD
        Route::get('/product/{id}/{slug}', 'ProductController@show')->name('product.id_slug');  //seller's {resource} show
        Route::resource('/posts', 'PostController');                                            //seller's {resource} CRUD
        Route::get('/billing', 'BillingController@index_seller')->name('seller.billing.index');               //get billing information
        Route::get('/billing/edit', 'BillingController@edit_seller')->name('seller.billing.edit');            //get edit page for billing information
        Route::put('/billing/edit', 'BillingController@update')->name('seller.billing.update');        //update billing information
        Route::get('/myprofile', 'MyProfileController@index_seller')->name('seller.profile.index');           //
        Route::get('/myprofile/edit', 'MyProfileController@edit_seller')->name('seller.profile.edit');        //
        Route::put('/myprofile', 'MyProfileController@update')->name('seller.profile.update');         //
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

    Route::get('/', 'BuyerController@index')->name('buyer_home');
    Route::get('/myprofile', 'MyProfileController@index_buyer')->name('buyer.profile.index');
    Route::get('/myprofile/edit', 'MyProfileController@edit_buyer')->name('buyer.profile.edit');
    Route::put('/myprofile', 'MyProfileController@update')->name('buyer.profile.update');
    Route::get('/sellers', 'PagesController@enabling_seller_panel')->name('about.seller.enable');       //static page, about sellers panel
    Route::get('/billing', 'PagesController@enabling_seller_panel')->name('about.seller.enable');       //static page, about sellers panel
    Route::get('/billing', 'BillingController@index_buyer')->name('buyer.billing.index');               //get billing information
    Route::get('/billing/edit', 'BillingController@edit_buyer')->name('buyer.billing.edit');            //get edit page for billing information
    Route::put('/billing/edit', 'BillingController@update')->name('buyer.billing.update');        //update billing information
});
















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
//Route::get('/recommendation', 'RecommendationController@create')->name('recommendation.create');




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
