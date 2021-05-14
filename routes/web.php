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

/** ajax版 */
// 初期表示
Route::get('sample', 'SampleController@index');
// 新規登録
Route::post('sample_insert', 'SampleController@insert');
// 更新
Route::post('sample_update', 'SampleController@update');
// 削除
Route::get('sample_delete', 'SampleController@delete');

/** form版 */
// 初期表示
Route::get('sample_form', 'SampleFormController@index');
// 新規登録
Route::post('sample_form_insert', 'SampleFormController@insert');
// 更新
Route::post('sample_form_update', 'SampleFormController@update');
// 削除
Route::post('sample_form_delete', 'SampleFormController@delete');
