<?php

namespace App\Services\ExchangeRate;

use App\Models\Order;

/**
 * @namespace App\Services\Payment
 * @category Services
 *
 * interface ExchangeRateServiceInterface - interface for all exchange rate services
 */
interface ExchangeRateServiceInterface
{
    /**
     * Gets rates from any place and returns it as array
     * @param array $params
     * @return array - array with keys as iso codes and rates as value
     */
    public function getRates(array $params) : array;
}
