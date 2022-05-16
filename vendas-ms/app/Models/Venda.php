<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
  use HasFactory;
  use \App\Traits\TraitUuid;

  protected $datas = ['dataEvento'];

/*
  public function cliente()
  {
    return $this->belongsTo("App\Models\Cliente");
  }
*/
  public function produtos()
  {
    return $this->belongsToMany("App\Models\Produto", 'venda_item')->withPivot( 
      'id',
      'quantidade',
      'preco',
      'subtotal'
     );
  }

  public function calcularTotal(Collection $itens)
  {

    $total = 0;

    foreach ($itens as $i) {

      $total = $total + ($i->preco * $i->pivot->quantidade);
    }

    return $total;
  }
}
