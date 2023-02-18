<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @package App\Models
 * @category models
 *
 * class Good - representation of good
 */
class Good extends Model
{
    protected $table = 'good';
    use HasFactory;

    /**
     * Good type constants
     */
    const TYPE_DEFAULT = 1;
    const TYPE_PRIVILEGE = 2;
    const TYPE_CASE = 3;

    /**
     * Good category relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(GoodCategory::class,'id');
    }

    /**
     * Good orders relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_good');
    }
}
