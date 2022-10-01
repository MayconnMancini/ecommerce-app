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

  public function show(Product $product)
  {
    return $product;
  }

  public function edit($id)
  {
    //
  }

  public function update(Request $request, Product $product)
  { 
    $product->update($request->only('name', 'description', 'price', 'inventory'));

    //ProductUpdated::dispatch($product->toArray())->onQueue('ambassador_topic');
    ProductUpdated::dispatch($product->toArray())->onQueue('products_topic');

    return response($product, Response::HTTP_ACCEPTED);
  }

  public function destroy(Product $product)
  {
    $product->delete();

    //ProductDeleted::dispatch(['id' => $product->id])->onQueue('ambassador_topic');
    ProductDeleted::dispatch(['id' => $product->id])->onQueue('products_topic');
    
    return response(null, Response::HTTP_NO_CONTENT);
  }
}
