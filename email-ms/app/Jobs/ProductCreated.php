<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Mail\Message;
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

    public function handle()
    {
        var_dump('Ola - aqui é email-ms');
        var_dump($this->data);

        \Mail::send('productCreated', ['product' => $this->data], function (Message $message) {
          $message->subject('Um produto #'. $this->data['id'] .'foi cadastrado com sucesso');
          $message->to('admin@admin.com');
      });

      var_dump('enviei um email');
      
    }
}
