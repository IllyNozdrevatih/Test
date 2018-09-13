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
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/city','CitiesController@getCities')->name('city');
Route::get('/region','RegionsController@getRegions')->name('region');
Route::get('/user','UserController@checkEmail')->name('email');
Route::get('/user/index','UserController@index')->name('users');
