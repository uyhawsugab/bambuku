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
    

    Route::group(['prefix' => 'pesanan'], function () {
        Route::get('/index', 'PesananController@index');
        Route::get('/{id_pesanan}/detail', 'DetailPesananController@index')->name('detail.index');
        Route::get('/total/{id}/', 'PesananController@getTotal');
        Route::get('/download-report', 'PesananController@exportToExcel');
        Route::get('/new', 'PesananController@vStore');
        Route::post('/new', 'PesananController@validateStore');
        Route::get('/update/{id}', 'PesananController@vEdit');
        Route::put('/update/{id}', 'PesananController@validateEdit');
        Route::delete('/delete','PesananController@validateDelete');
        Route::get('/json/{id}', 'PesananController@getDataWithJSON');

        Route::get('/{id_pesanan}/detail/new', 'DetailPesananController@vStore')->name('detail.vstore');
        Route::post('/{id_pesanan}/detail/new', 'DetailPesananController@validateStore')->name('detail.store');
        Route::post('/{id_pesanan}/detail/submit', 'DetailPesananController@massInsert')->name('detail.insert');
        Route::get('/{id_pesanan}/detail/update/{id}', 'DetailPesananController@vEdit')->name('detail.vedit');
        Route::put('/{id_pesanan}/detail/update/{id}', 'DetailPesananController@validateEdit')->name('detail.edit');
        Route::delete('/detail/delete','DetailPesananController@validateDelete');
        Route::get('/detail/json/{id}', 'DetailPesananController@getDataWithJSON');
    });

});
