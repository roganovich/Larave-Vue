<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => '/v1/wikipages/'], function(){
    Route::post('', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'index']);
    Route::post('store', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'store']);
    Route::get('{item}/get', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'get']);
    Route::post('{item}/update', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'update']);
    Route::post('{item}/destroy', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'destroy']);

    Route::get('parentlist', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'parentlist']);


});

