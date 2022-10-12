<?php

use App\Http\Controllers\CustomerController;
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

Route::prefix('customers')->group(function () {

  Route::post('customers/store', [CustomerController::class, 'store']);
  Route::put('customers/update', [CustomerController::class, 'update']);

  Route::get('customers', [CustomerController::class, 'index']);
  Route::get('customers/{customer}', [CustomerController::class, 'show']);
  
  Route::delete('customers/{customer}', [CustomerController::class, 'destroy']);

  Route::get('customers/orders', [CustomerController::class, 'orders']);
  Route::get('customers/order/{$id}', [CustomerController::class, 'order']);  
});