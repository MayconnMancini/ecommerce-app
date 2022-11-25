<?php

namespace App\Jobs;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class OrderCreated implements ShouldQueue
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
      $order->customer_id = $this->data['user_id'];
      $order->date = $this->data['date'];
      $order->total = $this->data['total'];
      $order->orderStatus = $this->data['orderStatus'];
      $order->created_at = $this->data['created_at'];
      $order->created_at = $this->data['updated_at'];
  
      $order->save();

  
      var_dump($order);
    }
}
