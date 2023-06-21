<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @category models
 *
 * class Order - representation of order
 */
class Order extends Model
{
    use HasFactory;

    /**
     * Constants
     */
    const STATUS_OPEN = 1;
    const STATUS_PAID = 2;
    const STATUS_ERROR = 3;
    const STATUS_CLOSED = 4;

    const STATUSES = [
        self::STATUS_OPEN => 'Открыт',
        self::STATUS_PAID => 'Оплачен. Готов к доставке',
        self::STATUS_ERROR => 'Ошибка',
        self::STATUS_CLOSED => 'Закрыт',
    ];

    public $table = 'order';

    protected $fillable = [
        'invoice_id',
        'status',
        'details',
    ];

    /**
     * Order goods relation
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function goods()
    {
        return $this->belongsToMany(Good::class, 'order_good')->using(OrderGood::class)->withPivot(['count', 'is_delivered']);
    }

    /**
     * Prepares details field
     *
     * @return Attribute
     */
    public function details(): Attribute
    {
        return Attribute::make(
            get: fn ($value) => json_decode($value, true),
            set: fn ($value) => json_encode($value),
        );
    }
}
