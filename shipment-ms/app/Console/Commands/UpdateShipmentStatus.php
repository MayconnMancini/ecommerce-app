<?php

namespace App\Console\Commands;

use App\Jobs\ShipmentStatusUpdated;
use App\Models\Order;
use Illuminate\Console\Command;

class UpdateShipmentStatus extends Command
{

  protected $signature = 'update';

  public function handle()
  {

    $shipmentStatus = ["NOVO", "EM SEPARAÇÃO", "AGUARDANDO COLETA", "ENVIADO", "ENTREGUE"];

    while (true) {

      var_dump("=============COMEÇANDO AQUI====================");
      // buscar os pedidos do bd com status diferente de entregue
      $orders = Order::where('orderStatus', '<>', 'ENTREGUE')->get();
  
      var_dump("QUANTIDADE DE PEDIDOS");
      var_dump(count($orders));

      if (count($orders) > 0) {
        foreach ($orders as $order) {

          var_dump("Atualizando o pedido");
          var_dump($order->id);
          var_dump($order->orderStatus);

          for ($i = 0; $i < count($shipmentStatus) - 1; $i++) {

            if ($order->orderStatus == $shipmentStatus[$i]) {

              $order->orderStatus = $shipmentStatus[$i + 1];

              var_dump("Atualizei o pedido");
              var_dump($order->orderStatus);

              $order->save();

              $array = $order->toArray();
              // disparar job de shipmentUpdated para o topico
              ShipmentStatusUpdated::dispatch($array)->onQueue('shipment-updated_topic');
			  ShipmentStatusUpdated::dispatch($array)->onQueue('email_topic');
              break;
            }
          }
          var_dump("==================================================================");
        }
      }
      var_dump(count($orders));
      
      sleep(60);
    }
  }
}
