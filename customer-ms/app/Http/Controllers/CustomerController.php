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
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Customer::all();
    }

    public function orders()
    {
        return Order::all();
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
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

      CustomerCreated::dispatch($customer->toArray())->onQueue('checkout_topic');
  
      return response($customer, Response::HTTP_CREATED);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Customer $customer)
    {
      return $customer;
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    public function update(Request $request, Customer $customer)
    {
      $customer->update($request->only('name', 'cpf', 'email'));

      //ProductUpdated::dispatch($product->toArray())->onQueue('ambassador_topic');
      CustomerUpdated::dispatch($customer->toArray())->onQueue('checkout_topic');
  
      return response($customer, Response::HTTP_ACCEPTED);
    }

    public function destroy(Customer $customer)
    {
      $customer->delete();

      //ProductDeleted::dispatch(['id' => $product->id])->onQueue('ambassador_topic');
      CustomerDeleted::dispatch(['id' => $customer->id])->onQueue('checkout_topic');
      
      return response(null, Response::HTTP_NO_CONTENT);
    }
}
