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

/* Route::get('/', function () {
    return view('welcome');
}); */
Route::get('/', [App\Http\Controllers\TestingController::class, 'index']);
Route::get('/lpse', [App\Http\Controllers\LpseController::class, 'index']);
Route::get('/lpse/create', [App\Http\Controllers\LpseController::class, 'create']);
Route::get('/lpse/delete', [App\Http\Controllers\LpseController::class, 'delete']);
