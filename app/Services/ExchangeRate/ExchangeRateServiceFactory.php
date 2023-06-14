<?php

namespace App\Services\ExchangeRate;

use App\Models\ExchangeRate;
use App\Models\Payment;
use App\Services\ExchangeRate\ExchangeRateServiceInterface;
use App\Services\ExchangeRate\services\ExchangeRubService;

/**
 * @package App\Services\Payment
 * @category services
 *
 * class ExchangeRateServiceFactory - factory class for creating specific exchange rate service
 */
class ExchangeRateServiceFactory
{
    /**
     * Creates specific exchange rate service
     *
     * @param string $currentCurrency
     * @return ExchangeRateBaseService|null
     * @throws \Exception
     */
    public static function build(string $currentCurrency) : ?ExchangeRateServiceInterface
    {
        if (!in_array($currentCurrency, array_keys(ExchangeRate::AVAILABLE_CURRENCY_CODES))) {
            throw new \Exception("Current currency ($currentCurrency) hasn't support yet");
        }

        $service = null;

        switch ($currentCurrency) {
            case ExchangeRate::CURRENCY_RUB:
                $service = new ExchangeRubService();
                break;
            default:
                break;
        }

        if (empty($service)) {
            throw new \Exception("Can't get currency service for the currency $currentCurrency");
        }
        return $service;
    }
}
