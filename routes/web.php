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
    return view('input');
})->name('input');

Route::resource('/myDatabase', App\Http\Controllers\SpokeLengthListController::class)->middleware('auth');
Route::resource('/hub', App\Http\Controllers\HubController::class)->middleware('auth');
Route::resource('/rim', App\Http\Controllers\RimController::class)->middleware('auth');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/length', [App\Http\Controllers\CalcController::class, 'calc'])->name('calc');

Auth::routes();
