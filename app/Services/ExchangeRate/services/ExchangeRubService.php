<?php

namespace App\Services\ExchangeRate\services;

use App\Models\ExchangeRate;
use App\Services\ExchangeRate\ExchangeRateBaseService;
use Illuminate\Support\Facades\Http;

/**
 * @package App\Services\ExchangeRate\services
 * @category services
 *
 * class ExchangeRubService - exchange base rub to other currencies
 */
class ExchangeRubService extends ExchangeRateBaseService
{
    /**
     * {@inheritDoc}
     */
    public function getRates(array $params): array
    {
         $response = Http::get('https://www.cbr-xml-daily.ru/latest.js');
         if (!$response->ok()) {
            return [];
         }
        return [
            ExchangeRate::CURRENCY_UAH => $response->json()['rates']['UAH'] ?? 1,
        ];
    }
}
