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

Route::get('/programmer', function () {
    return view('programmer');
});

Route::get('/urpuzzel1', function () {
    return view('urpuzzel1');
});

Route::get('/urpuzzel2', function () {
    return view('urpuzzel2');
});
