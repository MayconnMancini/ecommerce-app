<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class ShipmentStatusUpdated implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    public function __construct($data)
    {
        $this->data = $data;
    }

    public function handle()
    {
        var_dump('Ola - aqui é email-ms');
        var_dump($this->data);

        \Mail::send('shipmentUpdated', ['order' => $this->data], function (Message $message) {
          $message->subject('Seu pedido #'. $this->data['id'] .' foi alterado o status de envio para ' . $this->data['orderStatus']);
          $message->to('admin@admin.com');
      });

      var_dump('enviei um email');
      
    }
}
