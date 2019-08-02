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

Route::resource('/category', 'CategoryController')->except([
    'show'
]);

Route::resource('/component', 'ComponentController')->except([
    'show'
]);

Route::resource('/customer', 'CustomerController')->except([
    'show'
]);

Route::resource('/inventory', 'InventoryController')->except([
    'show'
]);

Route::resource('/material', 'MaterialController')->except([
    'show'
]);

Route::resource('/process', 'ProcessController')->except([
    'show'
]);
