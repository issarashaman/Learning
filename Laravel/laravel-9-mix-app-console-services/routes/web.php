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

Route::get('/console', [App\Http\Controllers\Consoles\ProjectController::class, 'index'])->name('console');

Route::get('/console/projects', [App\Http\Controllers\Consoles\ProjectController::class, 'index'])->name('projects');
Route::get('/console/project/create', [App\Http\Controllers\Consoles\ProjectController::class, 'create'])->name('project-create');
Route::post('/console/project/store', [App\Http\Controllers\Consoles\ProjectController::class, 'store'])->name('project-store');
Route::get('/console/project/{project_id}', [App\Http\Controllers\Consoles\ProjectController::class, 'show'])->name('project-show');
Route::get('/console/project/{project_id}/services', [App\Http\Controllers\Consoles\ProjectController::class, 'show'])->name('project-services');
Route::get('/console/project/{project_id}/roles', [App\Http\Controllers\Consoles\ProjectController::class, 'roles'])->name('project-roles');
Route::get('/console/project/{project_id}/settings', [App\Http\Controllers\Consoles\ProjectController::class, 'edit'])->name('project-settings');
Route::post('/console/project/{project_id}/update', [App\Http\Controllers\Consoles\ProjectController::class, 'update'])->name('project-update');
Route::post('/console/project/{project_id}/delete', [App\Http\Controllers\Consoles\ProjectController::class, 'destroy'])->name('project-destroy');

Route::get('/console/service/create', [App\Http\Controllers\Consoles\ServiceController::class, 'create'])->name('service-create');
Route::get('/console/service/{service_id}', [App\Http\Controllers\Consoles\ServiceController::class, 'show'])->name('service-show');
Route::get('/console/service/{service_id}/basics', [App\Http\Controllers\Consoles\ServiceController::class, 'show'])->name('service-basics');
Route::post('/console/service/{service_id}/update', [App\Http\Controllers\Consoles\ServiceController::class, 'update'])->name('service-update');
Route::post('/console/service/{service_id}/delete', [App\Http\Controllers\Consoles\ServiceController::class, 'destroy'])->name('service-destroy');

Route::post('/console/service/line-login/store', [App\Http\Controllers\Consoles\Services\Line\LineLoginController::class, 'store'])->name('service-line-login-store');
Route::get('/console/service/{service_id}/line-login', [App\Http\Controllers\Consoles\Services\Line\LineLoginController::class, 'edit'])->name('service-line-login-settings');
Route::post('/console/service/{service_id}/line-login/update', [App\Http\Controllers\Consoles\Services\Line\LineLoginController::class, 'update'])->name('service-line-login-update');

Route::post('/console/service/line-messaging-api/store', [App\Http\Controllers\Consoles\Services\Line\LineMessagingAPIController::class, 'store'])->name('service-line-messaging-api-store');
Route::get('/console/service/{service_id}/line-messaging-api', [App\Http\Controllers\Consoles\Services\Line\LineMessagingAPIController::class, 'edit'])->name('service-line-messaging-api-settings');
Route::post('/console/service/{service_id}/line-messaging-api/update', [App\Http\Controllers\Consoles\Services\Line\LineMessagingAPIController::class, 'update'])->name('service-line-messaging-api-update');
