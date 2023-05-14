<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Good;
use App\Models\GoodCategory;
use Database\Factories\GoodFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        GoodCategory::factory(5)->create()->each(function ($goodCategory) {
            if ($goodCategory->type === GoodCategory::TYPE_MULTIPLE) {
                $goodsCount = 10;
            } else {
                $goodsCount = 1;
            }
            Good::factory($goodsCount)
                ->create([
                    'good_category_id' => $goodCategory->id,
                ]);
        });
    }
}
