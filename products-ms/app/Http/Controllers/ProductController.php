<?php

namespace App\Http\Controllers;

use App\Jobs\ProductCreated;
use App\Jobs\ProductDeleted;
use App\Jobs\ProductUpdated;
use App\Models\Product;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ProductController extends Controller
{

  public function index()
  {
    return Product::all();
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {
    $product = Product::create($request->only('name', 'description', 'price', 'inventory'));

    ProductCreated::dispatch($product->toArray())->onQueue('products_topic');

    return response($product, Response::HTTP_CREATED);
  }

  public function show($id)
  {
    try {
      $product = Product::find($id)->first();

      $array = $product->toArray();

      return $array;
    } catch (\Throwable $e) {
      return response([
        'error' => $e->getMessage()
      ], 400);
    }
  }

  public function edit($id)
  {
    //
  }

  public function update(Request $request)
  {
    try {

      $product = Product::find($request->only('id'))->first();

      $product->update($request->only('name', 'description', 'price', 'inventory'));

      ProductUpdated::dispatch($product->toArray())->onQueue('products_topic');

      return response($product, Response::HTTP_ACCEPTED);
    } catch (\Throwable $e) {
      return response([
        'error' => $e->getMessage()
      ], 400);
    }
  }

  public function destroy($id)
  {
    try {
      $product = Product::find($id);
      $product->delete();

      ProductDeleted::dispatch(['id' => $product->id])->onQueue('products_topic');

      return response([
        'msg' => "Sucesso"
      ], Response::HTTP_ACCEPTED);
    } catch (\Throwable $e) {
      return response([
        'error' => $e->getMessage()
      ], 400);
    }
  }
}
