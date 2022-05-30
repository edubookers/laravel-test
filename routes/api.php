<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ProductController;
use App\Services\PurchaseService;
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

Route::post('customer', [CustomerController::class, 'create']);
Route::get('product', [ProductController::class, 'get']);

Route::prefix('purchase')->middleware('auth:sanctum')->group(function () {
    Route::get('subscription', [PurchaseService::class, 'getSubscriptions']);
    Route::get('product', [PurchaseService::class, 'getProducts']);
});

