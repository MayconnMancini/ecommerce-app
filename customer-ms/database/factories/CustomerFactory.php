<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CustomerFactory extends Factory
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
          'cpf' => $this->faker->randomNumber(11, true),
          'email' => $this->faker->email(),
          'created_at' => now(),
        ];
    }
}
