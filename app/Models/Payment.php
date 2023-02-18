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

    const PAYMENT_METHODS = [
        self::PAYMENT_METHOD_MC => '',
        self::PAYMENT_METHOD_VISA => '',
        self::PAYMENT_METHOD_WORLD => '',
        self::PAYMENT_METHOD_MTC => '',
        self::PAYMENT_METHOD_QIWI => '',
    ];
}
