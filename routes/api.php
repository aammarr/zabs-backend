<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

// --------------Login se pehle-----------------------
Route::group(['prefix'=>'user','middleware'=>'auth.client','namespace'=>'Api'],function(){

    //user signup by email
    Route::put('/signup','UserController@signup');
    Route::post('/login','UserController@login');
    Route::post('/forgetpassword','UserController@forgetPassword');

 
    Route::get('/faqs','UserController@faqs');
    Route::get('/tnc','UserController@tnc');
    Route::get('/privacyPolicy','UserController@privacy_policy');

});




// --------------Login k Baad-----------------------

Route::group(['prefix'=>'user','middleware'=>'ApiAuth','namespace'=>'Api'],function(){

    Route::get('/profile','UserController@myProfile');
    Route::post('/logout','UserController@logout');
    Route::get('/vendors','VendorController@index');
    Route::get('/vendor/{vendor_id}','VendorController@getVendorById');

    Route::get('/{vendor_id}/categories','CategoryController@index');
    
    Route::get('/{vendor_id}/products','ProductController@prodByVendorId');    
    Route::get('/{vendor_id}/products/{category_id}','ProductController@prodByVendorNcategoryId');    
    Route::get('/{vendor_id}/product/{product_id}','ProductController@prodByProdId');    

    Route::get('/cart','CartController@getCart');
    Route::post('/cart','CartController@postCart');
    Route::delete('/cart/{cart_id}','CartController@destroy');

    Route::get('/{vendor_id}/orders','OrderController@getOrders');
    Route::post('/{vendor_id}/order','OrderController@postOrder');

    Route::post('/contact_us','ContactController@index');

    Route::get('/banners','BannerController@index');
    Route::get('/{vendor_id}/banners','BannerController@getBannersByVendorId');

    Route::get('/faqs','UserController@faqs');
    Route::get('/tnc','UserController@tnc');
    Route::get('/privacyPolicy','UserController@privacy_policy');

    Route::get('my-favourites','FavoriteController@getMyFavorites');
    Route::post('my-favourites','FavoriteController@update');

    Route::get('/search/{keyWord}','Api\SearchController@search');
    // Route::get('/user/search','Api\SearchController@searchNumber');

    Route::get('/sms/send/{to}','Api\BindingController@sms');

});

