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

Route::get('/', 'PagesController@index');

Route::get('/films', 'FilmsController@list');
Route::get('/timetables', 'TimetablesController@list');
Route::get('/timetables/{code}', 'TimetablesController@list');

Route::get('/films/{code}', 'FilmsController@show');
Route::get('/timetables/order/{id}', 'TimetablesController@show');

Route::group(['middleware' => ['checkRole'], 'prefix' => 'admin'], function () {
    Route::resource('/halls', 'HallsController');
    Route::resource('/films', 'FilmsController');
    Route::resource('/timetables', 'TimetablesController');
    Route::resource('/orders', 'OrdersController');
    Route::resource('/users', 'UsersController');
    Route::resource('/images', 'ImagesController');
});
Route::group(['middleware' => ['auth']], function () {
    Route::get('/home/orders/{id}', 'PagesController@order');
});

Route::get('/api/makeOrder/{id}', 'OrdersController@make');
Route::post('/api/addOrder', 'OrdersController@store');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
