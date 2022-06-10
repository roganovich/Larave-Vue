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
Route::get('/wikipages/{id}', [App\Http\Controllers\WikipagesController::class, 'show'])->name('wikipages.show');

Route::get('/points', [App\Http\Controllers\PointsController::class, 'index'])->name('points.index');
Route::get('/points/{slug}', [App\Http\Controllers\PointsController::class, 'show'])->name('points.show');

Route::get('/products', [App\Http\Controllers\ProductsController::class, 'index'])->name('products.index');
Route::get('/products/{brand_slug}/{product_slug}', [App\Http\Controllers\ProductsController::class, 'show'])->name('products.show');

Route::get('/basket', [App\Http\Controllers\BasketController::class, 'index'])->name('basket.index');
Route::get('/basket/{product}/{point}/add', [App\Http\Controllers\BasketController::class, 'add'])->name('basket.add');
Route::get('/basket/{identifier}/plus', [App\Http\Controllers\BasketController::class, 'plus'])->name('basket.plus');
Route::get('/basket/{identifier}/minus', [App\Http\Controllers\BasketController::class, 'minus'])->name('basket.minus');
Route::get('/basket/{identifier}/delete', [App\Http\Controllers\BasketController::class, 'delete'])->name('basket.delete');

Route::middleware('auth')->get('/admin{any}', function () {
    return view('layouts.admin');
})->where('any', '.*');

require_once "api.php";

