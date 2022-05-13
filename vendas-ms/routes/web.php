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

Route::resource('produtos', ProdutoController::class);

//Route::get('/produtos', [ProdutoController::class, 'index'])->name('produtos.index');
//Route::get('/produtos/create', [ProdutoController::class, 'create']);
//Route::get('/produtos/{id}', [ProdutoController::class, 'show'])->name('produtos.show');
//
//Route::put('/produtos/{id}', [ProdutoController::class, 'edit'])->name('produtos.edit');
//Route::post('/produtos', [ProdutoController::class, 'store']);


Route::get('/user', function () {
  return view('user');
});



Route::get('/produtos/{id}', function ($id) {
  return view('produto',['id' => $id]);
});