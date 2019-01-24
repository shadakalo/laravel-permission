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


Route::resource('/role/user','UserRoleController');
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/role/roleHasPermission','RoleController@roleHasPermission');
Route::post('/role/assignPermission/{id}','RoleController@assignPermission');
Route::resource('/role','RoleController');
Route::resource('/fake1','fakeController');
Route::resource('/fake2','fake2Controller');
