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
// Permission route
Entrust::routeNeedsPermission('backend/*', ['backend'], redirect(''));

//Route::get('test', function() {
//    $url = 'http://leesummithighschool.rschoolteams.com/';
//    $apaya = [];
//    $client = new Goutte\Client();
//    $crawler = $client->request('GET', $url);
//    $client->getClient()->setDefaultOption('config/curl/' . CURLOPT_TIMEOUT, 60);
//    $activities = $crawler->filter('ul[class="dropdown-menu sub-menu"] > li[class="dropdown"]')->each(function ($node) {
//        $act = $node->filter('a[class="dropdown-toggle"]')->text();
//        $type = $node->filter('ul li a')->each(function($child) {
//            $url = 'http://fargosouthhighschool.rschoolteams.com/';
//            return ['sub' => trim($child->text()), 'url' => $url . $child->attr('href')];
//        });
//        $data[$act] = $type;
//        return [$act => $type];
//    });
//    foreach ($activities as $key => $val) {
//        foreach ($val as $taek => $kamp) {
//            $apaya[$taek] = $kamp;
//        }
//    }
//    $table = new Goutte\Client();
//    foreach ($apaya as $key => $val) {
//        foreach ($val as $url) {
//            $batman = $table->request('GET', $url['url']);
//            $table->getClient()->setDefaultOption('config/curl/' . CURLOPT_TIMEOUT, 60);
//            dd($batman->filter('table[class="table table-bordered table-striped"]'));
//        }
//    }
//});
//Route::get('as', function() {
//    $url = 'https://serve-ssl.rschooltoday.com/secure4/gkcsconference/g5-bin/setup.cgi?ssl=1&G5button=7&G5tab=1&G5location=internet';
//    $client = new Goutte\Client();
//    $crawler = $client->request('GET', $url);
//    $form = $crawler->selectButton('Login')->form(array(
//        'G5Login_username' => 'chad.hertzog',
//        'G5Login_password' => 'chad.hertzog',
//    ));
//    $crawler = $client->submit($form);
//    echo $crawler->html();
//});
Route::pattern('kumis', '.+');
//Route::get('backend', function() {
//    return 'telo';
//});
//Route::get('home', 'HomeController@index');
//
//Route::controllers([
//    'auth' => 'Auth\AuthController',
//    'password' => 'Auth\PasswordController',
//]);
Route::controllers((['password' => 'backend\LoginCtrl']));
Route::get('login', ['as' => 'login.index', 'uses' => 'backend\LoginCtrl@index']);
Route::get('login/{provider?}', 'backend\LoginCtrl@auth');
Route::get('account/{provider?}', 'backend\LoginCtrl@auth');
Route::post('login', ['as' => 'do.login', 'uses' => 'backend\LoginCtrl@doLogin']);
Route::post('register', ['as' => 'register', 'uses' => 'backend\LoginCtrl@postRegister']);
Route::get('register/success', ['as' => 'register.success', 'uses' => 'Front\PageCtrl@registerSuccess']);
Route::get('logout', function() {
    Auth::logout();
    return redirect('');
});
Route::get('activated/{code}', 'Front\PageCtrl@activateAccount');
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
    // User route
    Route::group(['namespace' => 'backend\Users'], function() {
        Route::resource('user', 'UserCtrl');
        Route::resource('role', 'RoleCtrl');
        Route::get('permission', ['as' => 'perm', 'uses' => 'RoleCtrl@getPerm']);
        Route::post('permission', ['as' => 'perm.post', 'uses' => 'RoleCtrl@storePerm']);
    });
// Options Route
    Route::group(['namespace' => 'backend\Options'], function() {
        Route::controller('options', 'OptionsCtrl');
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
    Route::group(['namespace' => 'backend\Users'], function() {
        Route::get('user', ['as' => 'api.user', 'uses' => 'UserCtrl@getUser']);
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
    Route::group(['prefix' => 'customer'], function() {
        Route::get('login', 'PageCtrl@postcheckout');
        Route::get('account', 'PageCtrl@getAccount');
    });
    Route::get('checkout', 'PageCtrl@checkout');
    Route::group(['prefix' => 'checkout'], function() {
        Route::post('login', 'PageCtrl@postcheckout');
        Route::get('shipping', 'PageCtrl@shipping');
        Route::post('shipping', 'PageCtrl@postShipping');
        Route::get('payment', 'PageCtrl@getPayment');
        Route::get('payment-description/{id}', 'PageCtrl@getPaymentDescription');
        Route::get('review','PageCtrl@getReviewPayment');
        Route::post('postorder','PageCtrl@postOrder');
        Route::get('complete', 'PageCtrl@getOrderComplete');
    });
    Route::get('/product/{kumis}', 'PageCtrl@show');
    Route::get('/{kumis}', 'PageCtrl@show');
});
