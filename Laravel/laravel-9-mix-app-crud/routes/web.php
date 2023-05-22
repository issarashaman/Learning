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

Route::get('/', function () {
    return view('pages.welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\Pages\HomeController::class, 'index'])->name('home');

Route::get('/about', function () {
    return view('pages.about');
});

Route::get('/console', [App\Http\Controllers\ConsolesController::class, 'index']);

Route::get('/console/{path}', [App\Http\Controllers\ConsolesController::class, 'index'])->where('path', '(.*)');
