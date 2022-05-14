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
Route::get('/inquiry', function () {
    return view('inquiry');
})->name('inquiry');

Route::resource('/wheel', App\Http\Controllers\SpokeLengthListController::class)
    ->only('index', 'create', 'store', 'edit', 'destroy', 'update')->middleware('auth');
Route::resource('/hub', App\Http\Controllers\HubController::class)
    ->only('index', 'create', 'store', 'edit', 'destroy', 'update')->middleware('auth');
Route::resource('/rim', App\Http\Controllers\RimController::class)
    ->only('index', 'create', 'store', 'edit', 'destroy', 'update')->middleware('auth');
Route::post('/rim/input', [App\Http\Controllers\RimController::class, 'inputFormData'])->middleware('auth')->name('rim.input');
Route::post('/hub/input', [App\Http\Controllers\HubController::class, 'inputFormData'])->middleware('auth')->name('hub.input');

Route::post('/register', [App\Http\Controllers\Auth\RegisterController::class, 'register'])->name('register');
Route::post('/register/mail', [App\Http\Controllers\Auth\RegisterController::class, 'sendRegisteredMail'])->name('register.mail');
Route::post('/length', [App\Http\Controllers\CalcController::class, 'calc'])->name('calc');
Route::post('/tensionDiff', [App\Http\Controllers\CalcTensionDiffController::class, 'calcTensionDiff'])->name('tensionDiff');
Route::post('/inquiry', [App\Http\Controllers\InquiryController::class, 'sendInquiry']);

Auth::routes();
