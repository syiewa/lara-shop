<?php

/*
  |--------------------------------------------------------------------------
  | Application Routes
  |--------------------------------------------------------------------------
  |
  | Here is where you can register all of the routes for an application.
  | It's a breeze. Simply tell Laravel the URIs it should respond to
  | and give it the controller to call when that URI is requested.
  |
 */
Route::pattern('kumis', '.+');

Route::get('home', 'HomeController@index');

Route::controllers([
    'auth' => 'Auth\AuthController',
    'password' => 'Auth\PasswordController',
]);

// Backend Route
Route::group(['prefix' => 'backend'], function() {
    // Route Products
    Route::group(['namespace' => 'backend\Products'], function() {
        Route::resource('product', 'ProductCtrl');
        Route::resource('category', 'CategoryCtrl');
        Route::resource('image', 'ImageCtrl');
        Route::post('meta/product', ['as' => 'backend.product.meta', 'uses' => 'ProductCtrl@metaProduct']);
    });
    // Page Route
    Route::group(['namespace' => 'backend\Page'], function() {
        Route::resource('page', 'PageCtrl');
    });
    // Widget Route
    Route::group(['namespace' => 'backend\Widget'], function() {
        Route::resource('slideshow', 'SlideshowCtrl');
    });
});
// API route
Route::group(['prefix' => 'api'], function() {
    Route::controller('ongkir', 'OngkirCtrl');
    Route::group(['namespace' => 'backend\Products'], function() {
        Route::get('product', ['as' => 'api.product', 'uses' => 'ProductCtrl@getProduct']);
        Route::get('category', ['as' => 'api.category', 'uses' => 'CategoryCtrl@getCat']);
        Route::post('category', ['as' => 'api.postcat', 'uses' => 'CategoryCtrl@getCat']);
    });
    Route::group(['namespace' => 'backend\Page'], function() {
        Route::get('page/{position}', ['as' => 'api.page', 'uses' => 'PageCtrl@getPage']);
        Route::post('page', ['as' => 'api.postpage', 'uses' => 'PageCtrl@getPage']);
    });
    Route::group(['namespace' => 'backend\Widget'], function() {
        Route::get('slideshow', ['as' => 'api.slideshow', 'uses' => 'SlideshowCtrl@getSlide']);
        Route::post('slideshow', ['as' => 'api.postslideshow', 'uses' => 'SlideshowCtrl@getSlide']);
    });
});

Route::group(['namespace' => 'Front'], function() {
    Route::get('/', 'PageCtrl@index');
    Route::get('checkout', 'PageCtrl@checkout');
    Route::post('/checkout', 'PageCtrl@postcheckout');
    Route::get('/product/{kumis}', 'PageCtrl@show');
    Route::get('/{kumis}', 'PageCtrl@show');
});
