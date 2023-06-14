<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @category models
 *
 * class GoodCategory - representation of good category
 */
class GoodCategory extends Model
{
    protected $table = 'good_category';
    use HasFactory;

    protected $fillable = [
        'name',
        'image',
        'type',
    ];
    /**
     * Good category type constants
     */
    const TYPE_SIMPLE = 1;
    const TYPE_COUNTABLE = 2;
    const TYPE_MULTIPLE = 3;

    const TYPE_LABELS = [
        self::TYPE_SIMPLE => 'Простая',
        self::TYPE_COUNTABLE => 'Поштучная',
        self::TYPE_MULTIPLE => 'С подтоварами',
    ];

    /**
     * Relation for goods
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(Good::class,'good_category_id')->with('subscribeDurations');
    }
}
