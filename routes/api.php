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

//Api's
Route::get('/all_category', 'ApiController@category');
Route::get('/all_color', 'ApiController@color');
Route::get('/all_sub_category', 'ApiController@subCategory');

//Client Authentication
Route::post('/client_login', 'ApiController@client_authentication');
Route::group(['middleware' => ['client']], function () {
    Route::get('/all_products', 'ApiController@product');
    Route::post('/order', 'ApiController@order');
    Route::post('/get_order', 'ApiController@get_orders');
    Route::post('/get_all_orders', 'ApiController@get_all_orders');
});
