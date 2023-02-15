<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoodCategory extends Model
{
    protected $table = 'good_category';
    use HasFactory;

    /**
     * Good category type constants
     */
    const TYPE_SIMPLE = 1;
    const TYPE_COUNTABLE = 2;
    const TYPE_MULTIPLE = 3;

    /**
     * Relation for goods
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(Good::class,'good_category_id');
    }
}
