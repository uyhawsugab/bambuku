<?php

use Illuminate\Support\Facades\Route;

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

Route::get('/template', function(){
    return view('template');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/signin', 'AuthController@viewSignIn');
    Route::post('/signin', 'AuthController@validateSignIn');
    Route::get('/logout', 'AuthController@logout');
});


Route::group(['middleware' => ['check.signin']], function () {
    
    Route::get('/index', 'DashboardController@index');
    Route::get('/', function(){
    return redirect('/index');
    });


    Route::group(['prefix' => 'barang'], function () {
        Route::get('/index', 'BarangController@home');
        Route::get('/new', 'BarangController@vAdd');
        Route::post('/new', 'BarangController@validateAdd');
        Route::get('/update/{id}', 'BarangController@vEdit');
        Route::put('/update/{id}', 'BarangController@validateEdit');
        Route::delete('/delete', 'BarangController@validateDelete');
        Route::get('/json/{id}', 'BarangController@getWithJson');
    });
    

});
