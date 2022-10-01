<?php

namespace App\Jobs;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCompleted implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $data;

  public function __construct($data)
  {
    $this->data = $data;
  }

  public function handle()
  {

    $order = new Order();

    $order->id = $this->data['id'];
    $order->user_id = $this->data['user_id'];
    $order->payment_id = $this->data['payment_id'];
    $order->date = $this->data['date'];
    $order->total = $this->data['total'];
    $order->orderStatus = $this->data['orderStatus'];
    $order->paymentStatus = $this->data['paymentStatus'];
    $order->created_at = $this->data['created_at'];
    $order->created_at = $this->data['updated_at'];

    $order->save();

    //OrderItem::insert($this->data['order_items']);

    foreach ($this->data['order_items'] as $item) {

      $orderItem = new OrderItem();

      $orderItem->id = $item['id'];
      $orderItem->order_id = $item['order_id'];
      $orderItem->product_id = $item['product_id'];
      $orderItem->price = $item['price'];
      $orderItem->quantity = $item['quantity'];
      $orderItem->subtotal = $item['subtotal'];

      $orderItem->created_at = $item['created_at'];
      $orderItem->created_at = $item['updated_at'];

      $orderItem->save();
    }

    var_dump($order);
  }
}
