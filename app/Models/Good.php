<?php

namespace App\Models;

use App\Models\traits\Subscribable;
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
    use Subscribable;

    protected $fillable = [
        'name',
        'image',
        'description',
        'type',
        'price',
        'label',
        'need_human_action',
    ];

    /**
     * Good type constants
     */
    const TYPE_DEFAULT = 1;
    const TYPE_PRIVILEGE = 2;
    const TYPE_CASE = 3;

    const TYPE_LABELS = [
        self::TYPE_DEFAULT => 'Обычный',
        self::TYPE_PRIVILEGE => 'Привилегия',
        self::TYPE_CASE => 'Кейс',
    ];

    /**
     * The "booting" method of the model.
     *
     * @return void
     */
    protected static function boot()
    {
        parent::boot();

        // auto-sets values on creation
        static::creating(function ($query) {
            $query->description = $query->description ?? '';
        });
    }

    /**
     * Good category relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(GoodCategory::class,'good_category_id');
    }

    /**
     * Good orders relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'order_good')->using(OrderGood::class);
    }

    /**
     * Good command relation
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function commands()
    {
        return $this->hasMany(GoodCommand::class, 'good_id');
    }
}
