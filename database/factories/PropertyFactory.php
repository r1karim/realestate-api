<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\property;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\property>
 */
class PropertyFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
      $type = $this->faker->randomElement(["h", "a"]);
        return [
            'type' => $type,
            'address' => $this->faker->streetAddress(),
            'size' => $this->faker->numberBetween(30,500),
            'number_of_bedrooms' => $this->faker->numberBetween(1,20),
            'price' => $this->faker->numberBetween(100,5000),
            'geolat' => $this->faker->randomFloat(4, -90, 90),
            'geolng' => $this->faker->randomFloat(4, -180, 180)
        ];
    }
}
