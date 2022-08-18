<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TransactionItem>
 */
class TransactionItemFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            // 'request_date' => fake()->date('d-m-Y'). ' ' . fake()->time('H:i:s'),
            'request_date' => fake()->date('Y-m-d H:i:s'),
            'user_id' => fake()->numberBetween(1, 10),
        ];
    }
}
