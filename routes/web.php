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
Route::post('/AddProduct', 'HomeController@AddProduct')->name('AddProduct');


Route::get('/product/{id}',[
    'uses'=>'ProductController@index'
])->name('product');

Route::get('/removeProduct/{id}',[
    'uses'=>'ProductController@removeProduct'
])->name('removeProduct');

Route::post('/product/deelUit','ProductController@deelUit')->name('deelUit');
Route::get('/accepteerLening','HomeController@accepteerLening')->name('accepteerLening');
Route::get('/stopLening','HomeController@stopLening')->name('stopLening');
Route::get('/geefTerug','HomeController@geefTerug')->name('geefTerug');
Route::get('/accepteerRetour','HomeController@accepteerRetour')->name('accepteerRetour');


