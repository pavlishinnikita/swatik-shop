<?php

namespace App\Services\Payment;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Support\Facades\URL;
use Weishaypt\EnotIo\Facades\EnotIo;

/**
 * Class EnotPaymentService - handling payments from enot.io
 */
class EnotPaymentService implements PaymentServiceInterface
{

    /**
     * Currency constant
     */
    const CURRENCY_UAH = 'UAH';
    const CURRENCY_USD = 'USD';
    const CURRENCY_EUR = 'EUR';
    const CURRENCY_RUB = 'RUB';

    /**
     * Invoice statuses constant
     */
    const INVOICE_STATUS_SUCCESS = 'success';

    /**
     * Prepares url for payment
     * @param array $paymentInfo
     * @return string
     */
    protected function preparePaymentUrl(array $paymentInfo) : string
    {
        return EnotIo::getPayUrl($paymentInfo['amount'], $paymentInfo['order_id'], null, null, [
            'info' => 'Покупка счастья',
            'time' => Carbon::now(),
        ]);
    }

    /**
     * @param $paymentMethod
     * @return string
     */
    protected function preparePaymentType ($paymentMethod) {
        if (!is_numeric($paymentMethod)) {
            return 'cd';
        }
        return match ((int)$paymentMethod) {
            Payment::PAYMENT_METHOD_QIWI => 'qw',
            Payment::PAYMENT_METHOD_IO => 'ya',
            default => 'cd'
        };
    }

    /**
     * {@inheritDoc}
     */
    public function process(Order $order, array $extraData = []): array
    {
        return [
            'pageUrl' => $this->preparePaymentUrl([
                'amount' => $order['price'],
                'order_id' => $order->id,
                'payment_id' => $this->preparePaymentType($order->details['paymentMethod']) // payment type
            ])
        ];
    }
}
