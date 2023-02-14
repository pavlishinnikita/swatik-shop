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
    use HasFactory;

    /**
     * Good type constants
     */
    const TYPE_SIMPLE = 1;
    const TYPE_CASE = 2;
    const TYPE_PRIVILEGE = 3;
    const TYPE_SHELLS = 4;
    const GOODS_TYPES = [
        self::TYPE_SIMPLE => 'Товары',
        self::TYPE_CASE => 'Кейсы',
        self::TYPE_PRIVILEGE => 'Привелегии',
        self::TYPE_SHELLS => 'Ракушки',
    ];
}
