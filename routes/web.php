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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/employee-tree', 'EmployeeController@tree');
Route::get('/employee', 'EmployeeController@index')->name('employee.index');
Route::get('/employee/create', 'EmployeeController@create')->name('employee.create');
Route::post('/employee', 'EmployeeController@store')->name('employee.store');
Route::get('/employee/{employee}/edit', 'EmployeeController@edit')->name('employee.edit');
Route::put('/employee/{employee}', 'EmployeeController@update')->name('employee.update');
Route::get('/employee/{employee}/show', 'EmployeeController@show')->name('employee.show');
Route::delete('/employee/{employee}', 'EmployeeController@destroy')->name('employee.destroy');

Route::get('/employee-superviser', 'EmployeeController@superviser');
