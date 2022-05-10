<?php

namespace Database\Factories;

use App\Models\Produto;
use App\Models\Venda;
use Illuminate\Database\Eloquent\Factories\Factory;

class Venda_itemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
      $produto_id = Produto::all()->random()->id;  
      $produto = Produto::find($produto_id);
      $quantidade = $this->faker->randomNumber(2, false);
      $subtotal = $quantidade * $produto['valor'];
        return [
          'id' => $this->faker->uuid(),
          'venda_id' => Venda::all()->random()->id,
          'produto_id' =>  $produto_id,
          'quantidade' => $quantidade,
          'preco' => $produto['valor'],
          'subtotal' => $subtotal,
          'created_at' => now(),
        ];
    }
}
