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

Auth::routes();

Route::middleware('auth')->get('/admin', [App\Http\Controllers\AdminController::class, 'index'])->name('admin');
Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::get('/wikipages', [App\Http\Controllers\WikipagesController::class, 'index'])->name('wikipages.index');
Route::get('/wikipages/{id}/parent', [App\Http\Controllers\WikipagesController::class, 'index'])->name('wikipages.parent');
Route::get('/wikipages/{id}/view', [App\Http\Controllers\WikipagesController::class, 'show'])->name('wikipages.show');


Route::middleware('auth')->get('/admin{any}', function () {
    return view('layouts.admin');
})->where('any', '.*');

require_once "api.php";

