<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
