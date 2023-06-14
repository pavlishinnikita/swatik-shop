<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @package App\Models
 * @category models
 *
 * class SubscriptionDuration - representation of subscription duration
 */
class SubscriptionDuration extends Model
{
    protected $table = 'subscription_duration';
    use HasFactory;

    const VALUE_FOREVER = '';

    protected $fillable = [
        'value',
        'label',
    ];
}
