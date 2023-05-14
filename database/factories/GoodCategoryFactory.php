<?php

namespace Database\Factories;

use App\Models\GoodCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\GoodCategory>
 */
class GoodCategoryFactory extends Factory
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
                GoodCategory::TYPE_SIMPLE,
                GoodCategory::TYPE_COUNTABLE,
                GoodCategory::TYPE_MULTIPLE,
            ]),
        ];
    }
}
