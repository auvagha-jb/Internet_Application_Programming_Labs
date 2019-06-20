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

Route::get('/all', 'CarController@allCars');
Route::get('/car/{id}', 'CarController@particularCar');
Route::get('/addCar', 'CarController@addCar');
//Route::post('/newCar', 'CarController@newCar');

Route::get('review/details/{id}', 'ReviewController@fetchReviewedCar');
Route::get('review/{id}', 'ReviewController@fetchReview');

//Resources
Route::resources([
    'cars' => 'CarController',
]);

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');