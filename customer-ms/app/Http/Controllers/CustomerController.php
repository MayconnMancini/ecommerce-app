<?php

namespace App\Http\Controllers;

use App\Jobs\CustomerCreated;
use App\Jobs\CustomerDeleted;
use App\Jobs\CustomerUpdated;
use App\Models\Customer;
use App\Models\Order;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CustomerController extends Controller
{

  public function index()
  {
    return Customer::all();
  }

  public function orders()
  {
    return Order::all();
  }

  public function order($id)
  {
    try {
      $order = Order::find($id);

      $array = $order->toArray();

      $array['order_items'] = $order->orderItems->toArray();

      return $array;
    } catch (\Throwable $e) {
      return response([
        'error' => $e->getMessage()
      ], 400);
    }
  }

  public function create()
  {
    //
  }

  /**
   * Store a newly created resource in storage.
   *
   * @param  \Illuminate\Http\Request  $request
   * @return \Illuminate\Http\Response
   */
  public function store(Request $request)
  {
    $customer = Customer::create($request->only('name', 'cpf', 'email'));

    CustomerCreated::dispatch($customer->toArray())->onQueue('customer_topic');
    CustomerCreated::dispatch($customer->toArray())->onQueue('email_topic');

    return response($customer, Response::HTTP_CREATED);
  }

  public function show($id)
  {
    try {
      $customer = Customer::find($id)->first();

      $array = $customer->toArray();

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

      $customer = Customer::find($request->only('id'))->first();

      $customer->update($request->only('name', 'cpf', 'email'));

      CustomerUpdated::dispatch($customer->toArray())->onQueue('customer_topic');

      return response($customer, Response::HTTP_ACCEPTED);
    } catch (\Throwable $e) {
      return response([
        'error' => $e->getMessage()
      ], 400);
    }
  }

  public function destroy($id)
  {
    try {
      $customer = Customer::find($id);
      $customer->delete();

      CustomerDeleted::dispatch(['id' => $customer->id])->onQueue('customer_topic');

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
