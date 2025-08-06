<?php

// database/factories/WeightTargetFactory.php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class WeightTargetFactory extends Factory
{
    public function definition()
    {
        return [
            'user_id' => 1, // Seederで後から$user->idに上書きするので仮でOK
            'target_weight' => $this->faker->randomFloat(1, 40, 120),
        ];
    }
}
