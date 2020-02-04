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

// Route::resource('/trabajadores', 'TrabajadoresController')->middleware('auth');

Route::resource('/api/trabajadores', 'TrabajadoresController')->middleware('auth');

Route::post('/api/trabajadores/upload', 'TrabajadoresController@fileStore')->middleware('auth');

// Route to handle page reload in Vue except for api routes
Route::get('/trabajadores/{any?}', function (){
    return view('home');
})->where('any', '^(?!api\/)[\/\w\.-]*')->middleware('auth');

