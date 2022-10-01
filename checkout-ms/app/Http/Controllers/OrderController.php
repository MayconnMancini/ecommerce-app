<?php

namespace App\Http\Controllers;

use App\Jobs\OrderCompleted;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\Product;
use App\Models\OrderItem;

use Illuminate\Support\Str;
use PhpParser\Node\Stmt\TryCatch;

class OrderController extends Controller
{

  public function index()
  {
    return Order::all();
    //return Product::all();
  }

  public function products()
  {
    //return Order::all()->toJson();
    return Product::all();
  }

  public function create()
  {
    //
  }

  public function store(Request $request)
  {

    try {
      //\DB::beginTransaction();

      $order = new Order();

      $order->user_id = "Implementar";
      $order->payment_id = "Implementar";
      $order->date = now();
      $order->total = 0;
      $order->orderStatus = 'NOVO';
      $order->paymentStatus = 'PENDENTE DE PAGAMENTO';

      $order->save();

      foreach ($request->input('items') as $item) {

        $product = Product::find($item['product_id']);

        $orderItem = new OrderItem();

        $orderItem->id = Str::uuid();
        $orderItem->order_id = $order->id;
        $orderItem->product_id = $product->id;
        //$orderItem->name = $product->name;
        $orderItem->price = $product->price;
        $orderItem->quantity = $item['quantity'];
        $orderItem->subtotal = $product->price * $item['quantity'];

        $orderItem->save();

        $order->total = $order->total + $orderItem->subtotal;
        /*
            $lineItems[] = [
                'name' => $product->title,
                'description' => $product->description,
                'images' => [
                    $product->image
                ],
                'amount' => 100 * $product->price,
                'currency' => 'usd',
                'quantity' => $item['quantity']
            ];
            */
      }

      /*
        $stripe = Stripe::make(env('STRIPE_SECRET'));

        $source = $stripe->checkout()->sessions()->create([
            'payment_method_types' => ['card'],
            'line_items' => $lineItems,
            'success_url' => env('CHECKOUT_URL') . '/success?source={CHECKOUT_SESSION_ID}',
            'cancel_url' => env('CHECKOUT_URL') . '/error'
        ]);

        $order->transaction_id = $source['id'];
        
        */

      $order->save();


      //\DB::commit();

      $array = $order->toArray();

      $array['order_items'] = $order->orderItems->toArray();

      OrderCompleted::dispatch($array)->onQueue('email_topic');
      OrderCompleted::dispatch($array)->onQueue('customer_topic');

      return response([
        'msg' => 'success',
        //'Total Order' => $order->total,
        'order' => $order->toArray(),
        //'items' => $order->orderItems->toArray()

      ], 200);
    } catch (\Throwable $e) {
      //\DB::rollBack();
      return response([
        'error' => $e->getMessage()
      ], 400);
    }
  }

  public function show($id)
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

  public function edit($id)
  {
    //
  }

  public function update(Request $request, $id)
  {
    //
  }

  public function destroy($id)
  {
    //
  }
}
