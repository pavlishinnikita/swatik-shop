<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

/**
 * @package App\Models
 * @category models
 *
 * class EntitySubscription - representation of entities subscription
 */
class EntitySubscription extends Model
{
    protected $table = 'entity_subscription';
    use HasFactory;

    protected $fillable = [
        'entity_id',
        'subscription_duration_id',
        'entity_type',
        'price',
    ];
}
