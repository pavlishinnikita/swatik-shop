<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @category models
 *
 * class GoodCommand - representation of good command
 */
class GoodCommand extends Model
{
    protected $table = 'good_command';
    protected $fillable = [
        'command',
    ];

    const SUBSCRIBE_SUBCOMMAND_NAME = 'subscribe_subcommand';
    const SUBSCRIBE_SUBCOMMANDS = [
        SubscriptionDuration::VALUE_FOREVER => 'set',
        'others' => 'addtemp',
    ];

    /**
     * Good command good
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function good()
    {
        return $this->belongsTo(Good::class, 'good_id');
    }
}
