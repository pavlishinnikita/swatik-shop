<?php

namespace Database\Factories;

use App\Models\Order;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Order>
 */
class OrderFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        return [
            'status' => $this->faker->randomElement([Order::STATUS_OPEN, Order::STATUS_CLOSED]),
            'details' => json_encode(['nickname' => $this->faker->name(), 'email' => $this->faker->email()]),
        ];
    }
}
