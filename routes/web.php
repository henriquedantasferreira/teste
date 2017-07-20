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

Route::get('/', 'HomeController@welcome');
Route::get('/helloworld', 'HomeController@helloworld')->name('helloworld');
Route::get('/outracoisa', 'HomeController@outracoisa')->name('outracoisa');
Route::get('/outraoutracoisa','HomeController@outraoutracoisa')->name('outraoutracoisa');
Route::post('/formresult', 'HomeController@formresult')->name('formresult');
Route::get('/registeredusers', 'newController@registeredusers')->name('registeredusers');


//Route::get('/outraoutracoisa?name="Jose"', 'HomeController@outraoutracoisa')->name('outraoutracoisa');

