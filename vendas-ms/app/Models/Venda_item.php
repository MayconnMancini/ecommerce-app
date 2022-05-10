<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda_item extends Model
{
    use HasFactory;
    use \App\Traits\TraitUuid;

    protected $table = 'vendas_item';
}
