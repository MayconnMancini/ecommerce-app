<?php

namespace App\Jobs;

use App\Models\Customer;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CustomerCreated implements ShouldQueue
{
  use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

  public $data;

  public function __construct($data)
  {
      $this->data = $data;
  }
    public function handle()
    {
      var_dump('mensagem do customer-ms');

      $customer = new Customer();

      $customer->id = $this->data['id'];
      $customer->name = $this->data['name'];
      $customer->cpf = $this->data['cpf'];
      $customer->email = $this->data['email'];
      $customer->created_at = $this->data['created_at'];
      $customer->created_at = $this->data['updated_at'];

      $customer->save();

      var_dump($customer);

    }
}
