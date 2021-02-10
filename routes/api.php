<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ChargeAcceptController;
use App\Http\Controllers\ChargeHistoryController;
use App\Http\Controllers\ChargesController;
use App\Http\Controllers\TagsController;
use App\Http\Controllers\OrdersController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\FavoritesController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\SalesHistoryController;

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

Route::get('/tags', TagsController::class);

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('refresh', [AuthController::class, 'refresh']);

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('user', [AuthController::class, 'user']);
        Route::post('logout', [AuthController::class, 'logout']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/tags/{slug}/products', [ProductsController::class, 'index']);

    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{product}', [ProductsController::class, 'show']);
    Route::apiResource('/products', ProductsController::class)->except(['index', 'show'])->middleware('isAdmin');

    Route::get('orders/{product}', [OrdersController::class, 'show']);
    Route::post('orders/{product}', [OrdersController::class, 'store']);

    Route::get('/admin/accept', [ChargeAcceptController::class, 'index'])->middleware('isAdmin');
    Route::post('/admin/accept', [ChargeAcceptController::class, 'store'])->middleware('isAdmin');

    Route::get('/admin/sales', [SalesHistoryController::class, 'index'])->middleware('isAdmin');
    Route::get('/admin/sales/{product}', [SalesHistoryController::class, 'show'])->middleware('isAdmin');

    Route::get('/charges/history', ChargeHistoryController::class);
    Route::get('/purchase/history', [PurchaseHistoryController::class, 'index']);
    Route::get('/purchase/history/{hash}', [PurchaseHistoryController::class, 'show']);

    Route::post('/charges', [ChargesController::class, 'store']);

    Route::post('/products/{product}/favorites', [FavoritesController::class, 'store']);
    Route::delete('/products/{product}/favorites', [FavoritesController::class, 'destroy']);
});