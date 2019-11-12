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

Auth::routes();

Route::get('/','ClientController@show_client_login')->name('client.login');
Route::get('/client/login','ClientController@show_client_login')->name('client.login');


//Authentication
//Route::get('/', 'Auth\LoginController@login');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/home', 'ClientController@index')->name('clients');
    Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

});


//Only Admin
Route::group(['middleware' => ['role:admin']], function () {

    //User
    Route::get('/users', 'UsersController@index')->name('users.list');
    Route::get('/user/add', 'UsersController@add')->name('user.add');
    Route::post('/user/create', 'UsersController@create')->name('user.create');
    Route::delete('/user/{id}/delete', 'UsersController@delete')->name('user.delete');
    Route::get('/user/{id}/edit', 'UsersController@edit')->name('user.edit');
    Route::put('/user/{id}/update', 'UsersController@update')->name('user.update');
    Route::get('/user/{id}/editPassword', 'UsersController@editPassword')->name('user.editPassword');
    Route::put('/user/{id}/updatePassword', 'UsersController@updatePassword')->name('user.updatePassword');
    //Privileges
    Route::get('/privileges', 'PrivilegesController@createPrivileges');
    Route::get('/assign_privileges', 'PrivilegesController@assignPrivileges');
    Route::get('/order/list','OrderController@get_all_orders')->name('order.list');
});

//Admin & Distributor
Route::group(['middleware' => ['role:admin|manufacturer']], function () {

    //Account
    Route::get('/account', 'AccountController@index')->name('account');
    Route::put('/account/{id}/update', 'AccountController@update')->name('account.update');

    //category
    Route::get('/category', 'CategoriesController@index')->name('category.list');
    Route::get('/category/add', 'CategoriesController@add')->name('category.add');
    Route::post('/category/create', 'CategoriesController@create')->name('category.create');
    Route::get('/category/{id}/edit', 'CategoriesController@edit')->name('category.edit');
    Route::put('/category/{id}/update', 'CategoriesController@update')->name('category.update');
    Route::delete('/category/{id}/delete', 'CategoriesyController@delete')->name('category.delete');

    //product
    Route::get('/products', 'ProductController@index')->name('products.list');
    Route::get('/product/add', 'ProductController@add')->name('product.add');
    Route::post('/product/create', 'ProductController@create')->name('product.create');
    Route::delete('/product/{id}/delete', 'ProductController@delete')->name('product.delete');
    Route::get('/product/{id}/edit', 'ProductController@edit')->name('product.edit');
    Route::put('/product/{id}/update', 'ProductController@update')->name('product.update');

    //ManuToSupp
    Route::get('/supplies/all', 'ManuToSuppController@index')->name('supplies.list');
    Route::get('/supplies/add', 'ManuToSuppController@add')->name('supplies.add');
    Route::post('/supplies/create','ManuToSuppController@create')->name('supplies.create');
    Route::get('/supplies/view/{id}', 'ManuToSuppController@view')->name('supplies.view');
    Route::get('/supplies/delete/{id}', 'ManuToSuppController@delete')->name('supplies.delete');

});
Route::group(['middleware' => ['role:admin|supplier']], function () {
    Route::get('/supplies/verified', 'ManuToSuppController@verify')->name('supplies.verify');
    Route::get('/supplies/verified/{id}', 'ManuToSuppController@verfied')->name('supplies.verified');
});
