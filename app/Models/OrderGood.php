<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * @package App\Models
 * @category models
 *
 * class OrderGood - representation of good model
 */
class OrderGood extends Pivot
{
    use HasFactory;

    public $timestamps = false;
    protected $table = 'order_good';
    protected $fillable = [
        'count',
        'is_delivered'
    ];
}
