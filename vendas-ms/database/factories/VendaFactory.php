<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class VendaFactory extends Factory
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
          'usuario_id' => $this->faker->uuid(),
          'pagamento_id' => $this->faker->uuid(),
          'total' => 0,
          'created_at' => now(),
        ];
    }
}
