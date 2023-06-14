<?php

namespace App\Models\traits;

use App\Models\EntitySubscription;
use App\Models\SubscriptionDuration;

trait Subscribable
{
    /**
     * Good subscriptions relation
     * @return \Illuminate\Database\Eloquent\Relations\hasManyThrough
     */
    public function subscribeDurations()
    {

        return $this->belongsToMany(
            SubscriptionDuration::class,
            'entity_subscription',
            'entity_id',
        )->withPivot('price');
    }
}
