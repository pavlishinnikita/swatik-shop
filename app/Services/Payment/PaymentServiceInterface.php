<?php

namespace App\Services\Payment;

use App\Models\Order;

/**
 * @namespace App\Services\Payment
 * @category Services
 *
 * interface PaymentServiceInterface - interface for all payment services
 */
interface PaymentServiceInterface
{
    /**
     * Process for current payment method
     * @param Order $order - app order
     * @param array $extraData - any additional data
     * @return array - array with data after processing
     */
    public function process(Order $order, array $extraData = []) : array;
}
