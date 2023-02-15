<?php

namespace Database\Factories;

use App\Models\Good;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Good>
 */
class GoodFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {
        $title = $this->faker->text(20);
        return [
            'name' => $title,
            'image' => "//dummyimage.com/250x250?text=" . urlencode($title),
            'type' => $this->faker->randomElement([
                Good::TYPE_DEFAULT,
                Good::TYPE_PRIVILEGE,
                Good::TYPE_CASE,
            ]),
            'price' => $this->faker->randomFloat(8, 999, 0),
        ];
    }
}
