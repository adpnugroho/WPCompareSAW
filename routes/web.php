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

Route::get('/','DashboardController@index');
Route::get('/alternatif','AlternatifController@index');
Route::get('/kriteria','KriteriaController@index');
Route::get('/evaluasi','EvaluasiController@index');
Route::get('/grafik','GrafikController@index');

Route::post('/alternatif/save','AlternatifController@save');
Route::post('/alternatif/get','AlternatifController@get');
Route::post('/alternatif/update','AlternatifController@update');
Route::post('/alternatif/delete','AlternatifController@delete');

Route::post('/kriteria/get','KriteriaController@get');
Route::post('/kriteria/update','KriteriaController@update');

Route::post('/evaluasi/get','EvaluasiController@get');
Route::post('/evaluasi/update','EvaluasiController@update');
Route::get('/evaluasi/list','EvaluasiController@data');
Route::get('/evaluasi/mat','EvaluasiController@dataMatriks');

Route::get('/table/alternatif','AlternatifController@data');
Route::get('/table/kriteria','KriteriaController@data');
Route::get('/table/wp','EvaluasiController@dataWP');
Route::get('/table/saw','EvaluasiController@dataSAW');

Route::get('/data/grafik','GrafikController@grafik');
Route::get('/test','TestController@test');