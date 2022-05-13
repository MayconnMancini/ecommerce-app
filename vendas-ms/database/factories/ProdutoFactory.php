<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ProdutoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
          'id' => $this->faker->uuid(),
          'nome' => $this->faker->words(2, true),
          'descricao' => $this->faker->paragraph(),
          'preco' => $this->faker->randomFloat(2, 1, 9999),
          'estoque' => $this->faker->randomNumber(5, false),
          'created_at' => now(),
          
        ];
    }
}
