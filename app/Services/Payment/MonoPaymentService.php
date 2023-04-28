<?php

namespace App\Services\Payment;

use App\Models\Order;
use VldmrK\MonoAcquiring\Api;
use VldmrK\MonoAcquiring\Config;
use VldmrK\MonoAcquiring\Query\Invoice\BasketOrder;
use VldmrK\MonoAcquiring\Query\Invoice\CreateQuery;
use VldmrK\MonoAcquiring\Query\Invoice\MerchantPaymInfo;
use Illuminate\Support\Facades\URL;

/**
 * @package App\Services\Payment
 *
 * class MonoPaymentService - class for processing monobank payments
 */
class MonoPaymentService implements PaymentServiceInterface
{
    /**
     * Invoice statuses
     */
    const INVOICE_STATUS_CREATED = "created";
    const INVOICE_STATUS_PROCESSING = "processing";
    const INVOICE_STATUS_HOLD = "hold";
    const INVOICE_STATUS_SUCCESS = "success";
    const INVOICE_STATUS_FAILTURE = "failure";
    const INVOICE_STATUS_RESERVED = "reversed";
    const INVOICE_STATUS_EXPIRED = "expired";

    /**
     * {@inheritDoc}
     */
    public function process(Order $order, array $extraData = []): array
    {
        $redirectPage = Url::to('/congratulation');
        $webHookPage = Url::to('/mono-hook');
        $config = new Config(getenv("MONO_TOKEN"));
        $totalPrice = 0;
        $api = new Api($config);
        $merchantPaymentInfo = new MerchantPaymInfo(
            getenv("MONO_MERCHANT_ID"),
            "Покупка счастья"
        );
        foreach ($order->goods()->withPivot(['count'])->get()->all() as $good) {
            $merchantPaymentInfo->addBasketOrder(
                new BasketOrder($good->name, $good->pivot->count, $good->price, str_starts_with($good->image, 'http') ? $good->image : URL::to($good->image))
            );
            $totalPrice += ($good->pivot->count) * $good->price;
        }
        $query = new CreateQuery(
            $totalPrice,
            $merchantPaymentInfo,
            env('CURRENCY_CODE'),
            $redirectPage,
            $webHookPage
        );
        $result = $api->call($query)->toArray();
        $order->update(['invoice_id' => $result['invoiceId'] ?? '']);
        return $result;
    }
}
