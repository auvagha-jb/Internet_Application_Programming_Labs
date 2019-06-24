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
Route::get('/student', 'studentController@create')->name('student');
Route::get('/all/students', 'studentController@allStudents');
Route::get('/fees', 'feesController@create')->name('fees');
Route::post('/student', 'studentController@store')->name('studentcreate');
Route::post('/fees', 'feesController@store')->name('feedeposit');

Route::get('Jerry/search', 'feesController@index')->name('paid');
Route::get('/search','feesController@search');
Route::get('/find/{student_no}','feesController@view'); 
Route::post('/find','feesController@find');

