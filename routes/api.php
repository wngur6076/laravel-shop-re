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
use App\Http\Controllers\MyProductsController;
use App\Http\Controllers\PasswordsController;
use App\Http\Controllers\PurchaseHistoryController;
use App\Http\Controllers\SalesAuthorityController;
use App\Http\Controllers\SalesHistoryController;
use App\Http\Controllers\SocialController;

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
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
    Route::get('/refresh', [AuthController::class, 'refresh']);
    Route::post('/confirm', [AuthController::class, 'confirm']);

    Route::post('/social/{provider}', [SocialController::class, 'store']);

    Route::post('/remind', [PasswordsController::class, 'postRemind']);
    Route::post('/reset', [PasswordsController::class, 'postReset']);

    Route::group(['middleware' => 'auth:api'], function(){
        Route::get('/user', [AuthController::class, 'user']);
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

Route::group(['middleware' => 'auth:api'], function() {
    Route::get('/tags/{slug}/products', [ProductsController::class, 'index']);

    Route::get('/products', [ProductsController::class, 'index']);
    Route::get('/products/{product}', [ProductsController::class, 'show']);
    Route::apiResource('/products', ProductsController::class)->except(['index', 'show'])->middleware('isAdmin');

    Route::get('/orders/{product}', [OrdersController::class, 'show']);
    Route::post('/orders/{product}', [OrdersController::class, 'store']);

    Route::get('/super/accept', [ChargeAcceptController::class, 'index'])->middleware('isSuper');
    Route::post('/super/accept', [ChargeAcceptController::class, 'store'])->middleware('isSuper');

    Route::get('/super/authority', [SalesAuthorityController::class, 'index'])->middleware('isSuper');
    Route::post('/super/authority', [SalesAuthorityController::class, 'store'])->middleware('isSuper');
    Route::get('/super/authority/{user}', [SalesAuthorityController::class, 'show'])->middleware('isSuper');

    Route::get('/admin/sales', [SalesHistoryController::class, 'index'])->middleware('isAdmin');
    Route::get('/admin/sales/{product}', [SalesHistoryController::class, 'show'])->middleware('isAdmin');

    Route::get('/my-products', [MyProductsController::class, 'index'])->middleware('isAdmin');
    Route::get('/my-products/{product}', [MyProductsController::class, 'show'])->middleware('isAdmin');

    Route::get('/charges/history', ChargeHistoryController::class);
    Route::get('/purchase/history', [PurchaseHistoryController::class, 'index']);
    Route::get('/purchase/history/{hash}', [PurchaseHistoryController::class, 'show']);

    Route::post('/charges', [ChargesController::class, 'store']);

    Route::post('/products/{product}/favorites', [FavoritesController::class, 'store']);
    Route::delete('/products/{product}/favorites', [FavoritesController::class, 'destroy']);
});
