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

// Route::get('/', function () {
//     return view('welcome');
// });

Route::get('/','homeController@index')->name('admin.dashboard');
// upload 
Route::get('/oneservice/campaign','homeController@uploadcampaign')->name('admin.uploadcampaign');
Route::post('/oneservice/upload','homeController@upload')->name('admin.upload');

// data 
Route::get('/oneservice/datawakif','dataController@datawakif')->name('admin.datawakif');
Route::get('/datawakif/donasi/{MobilePhone}', 'dataController@donasi')->name('admin.donasi');
Route::get('/datawakif/history/{id}', 'dataController@history')->name('admin.history');
Route::get('/datawakif/editdonasi/{kwitansi}','dataController@editdonasi')->name('admin.editdonasi');
Route::post('/datawakif/formeditdonasi/{kwitansi}','dataController@formeditdonasi')->name('admin.formeditdonasi');
Route::post('/oneservice/donasi/simpan','dataController@simpandonasi')->name('admin.simpandonasi');
// update wakif 
Route::post('/oneservice/datawakif/wakif/wakifupdate', 'dataController@wakifupdate')->name('admin.wakifupdate');
// update status last call
Route::post('/oneservice/datawakif/wakif/noteupdate', 'dataController@noteupdate')->name('admin.noteupdate');

// pop up
Route::get('/form_customer/form_customer.php','dataController@popupcus')->name('admin.popupcus');