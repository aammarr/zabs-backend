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


// //Main Admin
// Route::group(['prefix'=>'admin','middleware'=>'auth.basic','namespace'=>'Admin'],function(){

// });

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

//generator
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Route::resource('admin/test', 'TestController\\TestController');


// Route::get('test', function)
Route::get('/logout','Auth\LoginController@logout');

Route::resource('admin/user', 'UserController\\UserController');
Route::resource('admin/category', 'CategoryController\\CategoryController');
Route::resource('admin/products', 'ProductController\\ProductsController');
Route::get('admin/products/inStock/{id}', 'ProductController\\ProductsController@inStock');
Route::get('admin/products/outStock/{id}', 'ProductController\\ProductsController@outStock');
Route::resource('admin/order', 'OrderController\\OrderController');
Route::resource('admin/contact-us', 'ContactController\\ContactUsController');
Route::resource('admin/settings', 'SettingController\\SettingsController');
Route::resource('admin/banner', 'BannerController\\BannerController');


Route::group(['prefix'=>'admin','middleware'=>'auth.basic','namespace'=>'Admin'],function(){
	// Route::resource('/category', 'CategoryController\\CategoryController');
});

Route::resource('admin/vendor', 'VendorController\\VendorController');
Route::resource('admin/vendor', 'VendorController\\VendorController');