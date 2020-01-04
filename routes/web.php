<?php

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

Route::get('/', function () {
    return redirect('/login');
});

Auth::routes();





Route::get('/home', 'Admin\AdminController@index');
Route::get('admin', 'Admin\AdminController@index');


//admin
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/user', 'Admin\UserController');


Route::get('/change_password', function(){
	return view('changePassword');
});
Route::post('/admin/change_password','UserController\\UserController@changePasssword');




// Route::get('test', function)
Route::get('/logout','Auth\LoginController@logout');


// Route::resource('admin/category', 'CategoryController\\CategoryController');
// Route::resource('admin/products', 'ProductController\\ProductsController');
// Route::resource('admin/contact-us', 'ContactController\\ContactUsController');
// Route::resource('admin/settings', 'SettingController\\SettingsController');
// Route::resource('admin/banner', 'BannerController\\BannerController');
// Route::resource('admin/order', 'OrderController\\OrderController');

// //Main Admin
Route::group(['prefix'=>'admin','middleware'=>'auth.basic'],function(){
	
	Route::resource('/user', 'UserController\\UserController');
	Route::resource('/vendor', 'VendorController\\VendorController');
	Route::resource('/contact-us', 'ContactController\\ContactUsController');
	Route::resource('/order', 'OrderController\\AdminOrderController');

});


//vendor Admin 
Route::group(['prefix'=>'vendor','middleware'=>'vendor.auth'],function(){

	Route::resource('/category', 'CategoryController\\CategoryController');
	Route::resource('/products', 'ProductController\\ProductsController');
	Route::resource('/contact-us', 'ContactController\\ContactUsController');
	Route::resource('/settings', 'SettingController\\SettingsController');
	Route::resource('/banner', 'BannerController\\BannerController');	
	Route::resource('/order', 'OrderController\\OrderController');
	Route::get('/order/{order_id}/accept', 'OrderController\\OrderController@acceptOrder');
	Route::get('/order/{order_id}/reject', 'OrderController\\OrderController@rejectOrder');

	Route::get('/products/inStock/{id}', 'ProductController\\ProductsController@inStock');
	Route::get('/products/outStock/{id}', 'ProductController\\ProductsController@outStock');
});


//generator
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Route::resource('admin/test', 'TestController\\TestController');