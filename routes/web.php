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

/* Route::get('/', function () {
    return view('welcome');
}); */

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::group(['middleware' => ['auth']], function () {
    Route::resource('category', 'CategoryController')->except([
        'show'
    ]);

    Route::resource('component', 'ComponentController')->except([
        'show'
    ]);

    Route::resource('customer', 'CustomerController')->except([
        'show'
    ]);

    Route::resource('inventory', 'InventoryController')->except([
        'show'
    ]);

    Route::resource('material', 'MaterialController')->except([
        'show'
    ]);

    Route::resource('process', 'ProcessController')->except([
        'show'
    ]);

    Route::resource('user', 'UserController')->except([
        'show'
    ]);

    Route::resource('permission', 'PermissionController')->except([
        'show'
    ]);

    Route::resource('role', 'RoleController')->except([
        'show'
    ]);

    Route::resource('project', 'ProjectController')->except([
        'show'
    ]);

    Route::resource('cardwork', 'CardWorkController')->except([
        'show'
    ]);

    Route::resource('officer', 'OfficerController')->except([
        'show'
    ]);
});
