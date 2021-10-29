<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

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

Route::get('items', [App\Http\Controllers\Api\ItemController::class, 'index']);
Route::get('items/{id}', [App\Http\Controllers\Api\ItemController::class, 'getItemById']);
Route::post('items/add', [\App\Http\Controllers\Api\ItemController::class, 'store']);
Route::put('items/edit/{id}', [\App\Http\Controllers\Api\ItemController::class, 'update']);
Route::put('items/supplier/{id}', [\App\Http\Controllers\Api\ItemController::class, 'addSupplierToItem']);
Route::delete('items/delete/{id}', [\App\Http\Controllers\Api\ItemController::class, 'destroy']);

Route::post('user/orders/add', [\App\Http\Controllers\Api\UserOrderController::class, 'store']);
Route::get('user/orders/{id}', [\App\Http\Controllers\Api\UserOrderController::class, 'showUserOrder']);
Route::put('user/orders/status/{id}', [\App\Http\Controllers\Api\UserOrderController::class, 'updateStatus']);

Route::get('suppliers', [\App\Http\Controllers\Api\SupplierController::class, 'index']);
Route::post('suppliers/add', [\App\Http\Controllers\Api\SupplierController::class, 'store']);

Route::post('uploadImage', [\App\Http\Controllers\Api\UploadController::class, 'upload']);

Route::post('restock/add', [\App\Http\Controllers\Api\RestockOrderController::class, 'store']);
Route::get('restock', [\App\Http\Controllers\Api\RestockOrderController::class, 'showRestockOrder']);
Route::put('restock/status/{id}', [\App\Http\Controllers\Api\RestockOrderController::class, 'updateStatus']);

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class, 'login']);
    Route::post('logout', [AuthController::class, 'logout']);
    Route::post('register', [AuthController::class, 'register']);
    Route::post('me', [AuthController::class, 'me']);
});
