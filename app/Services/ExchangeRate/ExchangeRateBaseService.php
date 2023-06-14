<?php

namespace App\Services\ExchangeRate;

use App\Models\ExchangeRate;
use App\Models\Order;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

/**
 * @namespace App\Services\Payment
 * @category Services
 *
 * class ExchangeRateBaseService - base class with save method for storing rates
 */
abstract class ExchangeRateBaseService implements ExchangeRateServiceInterface
{
    /**
     * Save exchange rates
     * @param array $params
     * @return bool
     */
    public function save(array $params) : bool
    {
        $rates = $this->getRates($params);

        if (empty($rates)) {
            return false;
        }
        DB::beginTransaction();
        try {
            foreach ($rates as $code => $rate) {
                $exchangeRateModel = new ExchangeRate([
                    'base_currency_iso_code' => $params['currentCurrency'],
                    'exchange_currency_iso_code' => $code,
                    'exchange_rate' => $rate,
                ]);
                $exchangeRateModel->save();
            }
            DB::commit();
            return true;
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return false;
    }

    /**
     * Prepares price with current day exchange rate
     * @param float $price - current price
     * @return float - prepared price
     */
    public static function preparePriceWithCurrentCurrency(float $price, string $currencyTo) : float
    {
        $rate = ExchangeRate::query()->where([
            'base_currency_iso_code' => env('CURRENCY_CODE'),
            'exchange_currency_iso_code' => $currencyTo,
            'is_default' => 0
        ])
            ->whereDate('created_at', '=', Carbon::today()->toDateString())
            ->limit(1)
            ->get()
            ->first();

        if (empty($rate['exchange_rate'])) {
            $defaultRate = ExchangeRate::query()->where([
                'base_currency_iso_code' => env('CURRENCY_CODE'),
                'exchange_currency_iso_code' => $currencyTo,
                'is_default' => 1
            ])
                ->limit(1)
                ->get()
                ->first();
            $rate['exchange_rate'] = $defaultRate['exchange_rate'] ?? 1;
        }

        return $rate['exchange_rate'] * $price;
    }
}
