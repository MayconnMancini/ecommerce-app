<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;
    use \App\Traits\TraitUuid;

    public function vendas()
    {
        return $this->belongsToMany("App\Models\Venda", 'venda_item')->withPivot(
          'id',  
          'quantidade',
          'preco',
          'subtotal'
        );
    }
}