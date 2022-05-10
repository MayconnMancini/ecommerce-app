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

use App\Http\Controllers\VendaController;
use App\Http\Controllers\ProdutoController;


Route::get('/', function () {
  return view('welcome');
});

Route::get('/vendas', [VendaController::class, 'index']);
Route::get('/vendas/create', [VendaController::class, 'create']);
Route::post('/vendas', [VendaController::class, 'store']);


Route::get('/produtos', [ProdutoController::class, 'index']);


Route::get('/user', function () {
  return view('user');
});



Route::get('/produtos/{id}', function ($id) {
  return view('produto',['id' => $id]);
});