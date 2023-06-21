<?php

namespace App\Services\Payment;

use App\Models\Payment;

/**
 * @package App\Services\Payment
 * @category services
 *
 * class PaymentServiceFactory - factory class for creating specific payment service
 */
class PaymentServiceFactory
{
    /**
     * Creates specific payment service
     *
     * @param int $paymentMethod
     * @param int $paymentType
     * @return PaymentServiceInterface|null
     */
    public static function build(int $paymentMethod, int $paymentType) : ?PaymentServiceInterface
    {
        $service = null;

        if ($paymentType === Payment::PAYMENT_TYPE_UA) {
            $service = new MonoPaymentService();
        } else {
            $service = new EnotPaymentService();
        }

        return $service;
    }
}
