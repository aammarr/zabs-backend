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

    Route::get('/{vendor_id}/categories','CategoryController@index');

    Route::get('/{vendor_id}/products','ProductController@prodByVendorId');    
    Route::get('/{vendor_id}/products/{category_id}','ProductController@prodByVendorNcategoryId');    
    Route::get('/{vendor_id}/product/{product_id}','ProductController@prodByProdId');    

    Route::get('/cart','CartController@getCart');
    Route::post('/cart','CartController@postCart');
    Route::delete('/cart/{cart_id}','CartController@destroy');

    Route::get('/faqs','UserController@faqs');
    Route::get('/tnc','UserController@tnc');
    Route::get('/privacyPolicy','UserController@privacy_policy');


    Route::get('/user/search/{keyWord}','Api\SearchController@search');
    Route::post('/user/bindplate','Api\BindingController@index');
    // Route::get('/user/search','Api\SearchController@searchNumber');

    Route::get('/sms/send/{to}','Api\BindingController@sms');

});

