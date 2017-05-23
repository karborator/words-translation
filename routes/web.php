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

//Welcome
Route::get('/', function () {
    return view('welcome');
});

// Auth
Route::get('/auth', function () {
    return view('auth');
})->name('auth');

Route::post('/auth', 'AuthController@authenticate');
Route::get('/logout', 'LogoutController@logout');

//Admin
Route::get('/dashboard','DashboardController@dashboard')->name('dashboard');

Route::get('/word-manager/add',function () {
    return view('add-word');
})->name('add-word');
Route::get('/word-manager/get-word','WordManagerController@getWord');
Route::get('/word-manager/{id}', 'WordManagerController@fetch');
Route::get('/word-manager', 'WordManagerController@fetchAll')->name('word-manager');
Route::get('/word-manager/edit/{id}', 'WordManagerController@update');
Route::post('/word-manager/edit/{id}', 'WordManagerController@update');
Route::get('/word-manager/delete/{id}', 'WordManagerController@delete');
Route::post('/word-manager', 'WordManagerController@create');

Route::post('/translate', 'TranslateController@translate');


Route::get('/import-csv', 'ImportController@import')->name('import-csv');

Route::post('/import-csv', 'ImportController@import');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

