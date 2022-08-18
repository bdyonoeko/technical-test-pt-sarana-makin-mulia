<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Item>
 */
class ItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'code' => fake()->numerify('ATK####'),
            'name' => fake()->text(10),
            'available' => fake()->randomNumber(2, true),
            'unit' => fake()->randomElement(['Pack', 'Lembar', 'Buah', 'Kg']),
            'description' => fake()->text(50),
            'status' => 'Terpenuhi',
            'location_id' => fake()->numberBetween(1, 10),
        ];
    }
}
