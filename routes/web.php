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


Route::get('/excise', function(){
	dd('excise');
});

Route::get('/sales_center', function(){
	dd('sales center');
});

Route::get('/home', 'Admin\AdminController@index');

Route::get('admin', 'Admin\AdminController@index');

//admin
Route::resource('admin/roles', 'Admin\RolesController');
Route::resource('admin/permissions', 'Admin\PermissionsController');
Route::resource('admin/user', 'Admin\UserController');

//generator
Route::get('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@getGenerator']);
Route::post('admin/generator', ['uses' => '\Appzcoder\LaravelAdmin\Controllers\ProcessController@postGenerator']);

Route::resource('admin/test', 'TestController\\TestController');


// Route::get('test', function)
Route::resource('admin/user', 'UserController\\UserController');
Route::resource('admin/category', 'CategoryController\\CategoryController');
Route::resource('admin/products', 'ProductController\\ProductsController');