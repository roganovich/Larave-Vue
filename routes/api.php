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

Route::group([
    'prefix' => '/v1/',], function () {
    // Страницы WIKI
    Route::group(['prefix' => 'wikipages'], function () {
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
        // Загрузить изображение
        Route::post('addimage', [\App\Http\Controllers\Api\V1\WikipagesController::class, 'addimage']);
    });

    // Страницы Users
    Route::group(['prefix' => 'users'], function () {
        // Список, поиск записей
        Route::post('', [\App\Http\Controllers\Api\V1\UsersController::class, 'index']);
        // Создание новой записи
        Route::post('store', [\App\Http\Controllers\Api\V1\UsersController::class, 'store']);
        // Получить данные записи
        Route::get('{id}/get', [\App\Http\Controllers\Api\V1\UsersController::class, 'get']);
        // Получить данные текущего пользователя
        Route::get('curent', [\App\Http\Controllers\Api\V1\UsersController::class, 'curent'])->name('api.v1.users.curent');
        // Обновить запись
        Route::post('{id}/update', [\App\Http\Controllers\Api\V1\UsersController::class, 'update']);
        // Удалить запись
        Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\UsersController::class, 'destroy']);
    });

    // Страницы Permissions
    Route::group(['prefix' => 'permissions'], function () {
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
    Route::group(['prefix' => 'usersroles'], function () {
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

    // Страницы Points
    Route::group(['prefix' => 'points'], function () {
        // Список, поиск записей
        Route::post('', [\App\Http\Controllers\Api\V1\PointsController::class, 'index']);
        // Создание новой записи
        Route::post('store', [\App\Http\Controllers\Api\V1\PointsController::class, 'store']);
        // Получить данные записи
        Route::get('{id}/get', [\App\Http\Controllers\Api\V1\PointsController::class, 'get']);
        // Обновить запись
        Route::post('{id}/update', [\App\Http\Controllers\Api\V1\PointsController::class, 'update']);
        // Удалить запись
        Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\PointsController::class, 'destroy']);
        // Пролучить типы
        Route::get('typeslist', [\App\Http\Controllers\Api\V1\PointsController::class, 'typeslist']);
        // Загрузить изображение
        Route::post('addimages', [\App\Http\Controllers\Api\V1\PointsController::class, 'add_images']);
    });

    // Страницы ProductsBrands
    Route::group(['prefix' => 'products_brands'], function () {
        // Список, поиск записей
        Route::post('', [\App\Http\Controllers\Api\V1\ProductsBrandsController::class, 'index']);
        // Создание новой записи
        Route::post('store', [\App\Http\Controllers\Api\V1\ProductsBrandsController::class, 'store']);
        // Получить данные записи
        Route::get('{id}/get', [\App\Http\Controllers\Api\V1\ProductsBrandsController::class, 'get']);
        // Обновить запись
        Route::post('{id}/update', [\App\Http\Controllers\Api\V1\ProductsBrandsController::class, 'update']);
        // Удалить запись
        Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\ProductsBrandsController::class, 'destroy']);
        // Загрузить изображение
        Route::post('addimages', [\App\Http\Controllers\Api\V1\ProductsBrandsController::class, 'add_images']);
    });


    // Страницы ProductsBrands
    Route::group(['prefix' => 'products_categories'], function () {
        // Список, поиск записей
        Route::post('', [\App\Http\Controllers\Api\V1\ProductsCategoriesController::class, 'index']);
        // Создание новой записи
        Route::post('store', [\App\Http\Controllers\Api\V1\ProductsCategoriesController::class, 'store']);
        // Получить данные записи
        Route::get('{id}/get', [\App\Http\Controllers\Api\V1\ProductsCategoriesController::class, 'get']);
        // Обновить запись
        Route::post('{id}/update', [\App\Http\Controllers\Api\V1\ProductsCategoriesController::class, 'update']);
        // Удалить запись
        Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\ProductsCategoriesController::class, 'destroy']);
        // Загрузить изображение
        Route::post('addimages', [\App\Http\Controllers\Api\V1\ProductsCategoriesController::class, 'add_images']);
    });

    // Страницы Orders
    Route::group(['prefix' => 'orders'], function () {
        // Список, поиск записей
        Route::post('', [\App\Http\Controllers\Api\V1\OrdersController::class, 'index']);
        // Получить данные записи
        Route::get('{id}/get', [\App\Http\Controllers\Api\V1\OrdersController::class, 'get']);
        // Обновить запись
        Route::post('{id}/update', [\App\Http\Controllers\Api\V1\OrdersController::class, 'update']);
        // Удалить запись
        Route::delete('{id}/destroy', [\App\Http\Controllers\Api\V1\OrdersController::class, 'destroy']);
        // Пролучить статусы
        Route::get('statuseslist', [\App\Http\Controllers\Api\V1\OrdersController::class, 'statuseslist']);
        // Загрузить менеджеров
        Route::get('mangerslist', [\App\Http\Controllers\Api\V1\OrdersController::class, 'mangerslist']);
    });


});
