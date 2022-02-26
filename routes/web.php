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

Route::get('/length', function () {
    return view('length');
})->name('length');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/length', [App\Http\Controllers\CalcController::class, 'calc'])->name('calc');

Auth::routes();
