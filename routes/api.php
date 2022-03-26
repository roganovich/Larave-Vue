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

// Страницы WIKI
Route::group(['prefix' => '/v1/wikipages/'], function () {
    // Список, поиск записей
    Route::post('', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'index']);
    // Создание новой записи
    Route::post('store', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'store']);
    // Получить данные записи
    Route::get('{id}/get', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'get']);
    // Обновить запись
    Route::post('{id}/update', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'update']);
    // Удалить запись
    Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'destroy']);
    // Пролучить категории
    Route::get('parentlist', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'parentlist']);
    // Пролучить категории
    Route::post('addimage', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'addimage']);
});

// Страницы Users
Route::group(['prefix' => '/v1/users/'], function () {
    // Список, поиск записей
    Route::post('', [\App\Http\Controllers\Api\V1\UsersController::class, 'index']);
    // Создание новой записи
    Route::post('store', [\App\Http\Controllers\Api\V1\UsersController::class, 'store']);
    // Получить данные записи
    Route::get('{id}/get', [\App\Http\Controllers\Api\V1\UsersController::class, 'get']);
    // Обновить запись
    Route::post('{id}/update', [\App\Http\Controllers\Api\V1\UsersController::class, 'update']);
    // Удалить запись
    Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\UsersController::class, 'destroy']);
});

// Страницы Permissions
Route::group(['prefix' => '/v1/permissions/'], function () {
    // Список, поиск записей
    Route::post('', [\App\Http\Controllers\Api\V1\PermissionsController::class, 'index']);
    // Получить данные записи
    Route::get('{id}/get', [\App\Http\Controllers\Api\V1\PermissionsController::class, 'get']);
    // Обновить запись
    Route::post('{id}/update', [\App\Http\Controllers\Api\V1\PermissionsController::class, 'update']);
    // Полный список
    Route::get('list', [\App\Http\Controllers\Api\V1\PermissionsController::class, 'list']);
    // Сохранить права для роли
    Route::post('{id}/saveroles', [\App\Http\Controllers\Api\V1\PermissionsController::class, 'saveroles']);

});

// Страницы UsersRoles
Route::group(['prefix' => '/v1/usersroles/'], function () {
    // Список, поиск записей
    Route::post('', [\App\Http\Controllers\Api\V1\UsersRolesController::class, 'index']);
    // Создание новой записи
    Route::post('store', [\App\Http\Controllers\Api\V1\UsersRolesController::class, 'store']);
    // Получить данные записи
    Route::get('{id}/get', [\App\Http\Controllers\Api\V1\UsersRolesController::class, 'get']);
    // Обновить запись
    Route::post('{id}/update', [\App\Http\Controllers\Api\V1\UsersRolesController::class, 'update']);
    // Полный список
    Route::get('list', [\App\Http\Controllers\Api\V1\UsersRolesController::class, 'list']);
    // Удалить запись
    Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\UsersRolesController::class, 'destroy']);
});
