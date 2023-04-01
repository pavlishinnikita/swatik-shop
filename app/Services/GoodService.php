<?php

namespace App\Services;

use App\Models\Good;
use App\Models\GoodCategory;
use \Illuminate\Database\Eloquent\Collection;

/**
 * @package App\Services
 * @category Services
 *
 * class GoodService - service class for working with goods and good categories
 */
class GoodService
{
    /**
     * Returns categories depending on type
     * @param array $conditions - optional conditionals of category
     * @return array|Collection - good categories
     */
    public function getCategories(array $conditions = []) : array | Collection
    {
        return GoodCategory::query()->with('goods')->where($conditions)->get()->all();
    }

    /**
     * Returns categories depending on type
     * @param array $conditions - optional conditionals of category
     * @return array|Collection - good categories
     */
    public function getGood(array $conditions = []) : array | Collection
    {
        return Good::query()->with('category')->where($conditions)->get()->all();
    }

    /**
     * Returns modal view depending on different conditions
     * @param GoodCategory $goodCategory - category with goods for get view for
     * @return string
     */
    public function getGoodView(GoodCategory $goodCategory) : string
    {
        $goodCount = count($goodCategory['goods'] ?? []);
        if ($goodCategory['type'] == GoodCategory::TYPE_MULTIPLE) {
            return '_partials/good_type_goods';
        }

        return '_partials/good_details';
    }
}
