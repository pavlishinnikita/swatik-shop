<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @package App\Models
 * @category models
 *
 * class ExchangeRate - representation of exchange rates
 */
class ExchangeRate extends Model
{
    use HasFactory;

    public $table = 'exchange_rate';

    protected $fillable = [
        'base_currency_iso_code',
        'exchange_currency_iso_code',
        'exchange_rate',
        'created_at',
        'updated_at',
    ];

    const CURRENCY_UAH = '980';
    const CURRENCY_USD = '840';
    const CURRENCY_EUR = '978';
    const CURRENCY_RUB = '643';

    const AVAILABLE_CURRENCY_CODES = [
        self::CURRENCY_UAH => 'UAH',
        self::CURRENCY_USD => 'USD',
        self::CURRENCY_EUR => 'EUR',
        self::CURRENCY_RUB => 'RUB',
    ];
}
