<?php

namespace App\Models;

/**
 * @package App\Models
 * @category models
 *
 * class Payment - representation of order
 */
class Payment
{
    const PAYMENT_TYPE_UA = 1;
    const PAYMENT_TYPE_OTHER = 2;

    const PAYMENT_METHOD_MC = 1;
    const PAYMENT_METHOD_VISA = 2;
    const PAYMENT_METHOD_WORLD = 3;
    const PAYMENT_METHOD_MTC = 4;
    const PAYMENT_METHOD_QIWI = 5;
    const PAYMENT_METHOD_IO = 6;

    const PAYMENT_METHODS = [
        self::PAYMENT_METHOD_MC => 'MasterCard',
        self::PAYMENT_METHOD_VISA => 'Visa',
        self::PAYMENT_METHOD_WORLD => 'Мир',
        self::PAYMENT_METHOD_MTC => 'MTC',
        self::PAYMENT_METHOD_QIWI => 'Киви',
        self::PAYMENT_METHOD_IO => 'IO',
    ];

    const PAYMENT_TYPES = [
        self::PAYMENT_TYPE_UA => 'Для Украины',
        self::PAYMENT_TYPE_OTHER => 'Остальные',
    ];
}
