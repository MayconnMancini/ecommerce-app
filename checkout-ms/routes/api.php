<?php

use App\Http\Controllers\OrderController;
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
/*
Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
*/

Route::prefix('checkout')->group(function () {
  //Route::get('links/{code}', [LinkController::class, 'show']);
  Route::post('orders/store', [OrderController::class, 'store']);
  Route::get('orders', [OrderController::class, 'index']);

  Route::get('orders/products', [OrderController::class, 'products']);
  Route::get('orders/customers', [OrderController::class, 'customers']);
  
  Route::get('orders/{id}', [OrderController::class, 'show']);

  Route::get('orders/orders/{user_id}', [OrderController::class, 'user_orders']);
});