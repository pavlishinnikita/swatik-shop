<?php

namespace App\Services;

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
     * @param array $type - good category types
     * @param array $conditionals - optional conditionals of category
     * @return array - good categories
     */
    public function getCategories(array $type, array $conditionals = []) : array
    {
        return [];
    }
}
