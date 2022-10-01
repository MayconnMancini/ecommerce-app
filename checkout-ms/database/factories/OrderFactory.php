<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
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
          'user_id' => $this->faker->uuid(),
          'payment_id' => $this->faker->uuid(),
          'date' => $this->faker->dateTimeThisYear(),
          'total' => 0,
          'created_at' => now(),
        ];
    }
}
