<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
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
          'name' => $this->faker->words(2, true),
          'description' => $this->faker->paragraph(),
          'price' => $this->faker->randomFloat(2, 1, 9999),
          'inventory' => $this->faker->randomNumber(5, false),
          'created_at' => now(),
        ];
    }
}
