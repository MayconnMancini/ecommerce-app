<?php

namespace App\Jobs;

use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ProductCreated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }
    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
      
      var_dump("Criei o produto no checkout: ");

      $product = new Product();

      $product->id = $this->data['id'];
      $product->name = $this->data['name'];
      $product->description = $this->data['description'];
      $product->price = $this->data['price'];
      $product->inventory = $this->data['inventory'];

      $product->save();
      
      var_dump($product);
    }
}
