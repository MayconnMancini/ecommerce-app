<?php

namespace App\Console\Commands;

use App\Jobs\OrderCompleted;
use Illuminate\Console\Command;

class ProduceCommand extends Command
{
    protected $signature = 'produce';

    public function handle()
    {
        //$order = Order::find($id);
        
        $msg = ['Teste de Job'];
        
        OrderCompleted::dispatch($msg)->onQueue('email_topic');
    }
}
