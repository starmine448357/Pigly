<?php

// database/factories/WeightLogFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightLogFactory extends Factory
{
    public function definition()
    {
        return [
            'date' => $this->faker->dateTimeBetween('-2 months', 'now')->format('Y-m-d'),
            'weight' => $this->faker->randomFloat(1, 40, 120),
            'meal_calories' => $this->faker->numberBetween(1500, 3500),
            'exercise_time' => $this->faker->time('H:i'),            'exercise_content' => $this->faker->text(30),
        ];
    }
}
