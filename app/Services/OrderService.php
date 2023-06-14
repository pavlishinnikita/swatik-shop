<?php

namespace App\Services;


use App\Models\Good;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

/**
 * @package App\Services
 * @category Services
 *
 * class OrderService - service class for working with orders
 */
class OrderService
{
    /**
     * Create orders from data
     * @param array $data - data for order
     * @return Order - created order
     * @throws \Throwable
     */
    public function createOrder(array $data) : Order
    {
        DB::beginTransaction();
        try {
            $order = new Order();
            $order->details = $this->prepareOrderDetails($data);
            $order->saveOrFail();
            $totalPrice = 0.0;

            $goods = Good::query()
                ->with('subscribeDurations')
                ->whereIn('id', is_array($data['good_id']) ? $data['good_id'] : [$data['good_id']])
                ->get()
                ->all();

            foreach ($goods as $orderGood) {
                $periodIndex = array_search($order->details['duration'] ?? '', array_column($orderGood['subscribeDurations']->toArray(), 'value'));
                if ($periodIndex === false) {
                    $price = $orderGood['price'];
                } else {
                    $price = $orderGood['subscribeDurations'][$periodIndex]['pivot']['price'];
                }
                $count = intval($data['count'] ?? 1);
                $order->goods()->attach($orderGood['id'], [
                    'count' => $count,
                    'price' => $price,
                ]);
                $totalPrice += ($price * $count);
            }
            $order->price = $totalPrice;
            $order->save();
            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
        }
        return $order;
    }

    /**
     * Prepares details data for order
     * @param array $data - original data from client
     * @return array - prepared data
     */
    protected function prepareOrderDetails(array $data) : array
    {
        $detailsData = $data;
        unset($detailsData['step']);
        unset($detailsData['_token']);
        unset($detailsData['good_id']);
        return $detailsData;
    }

    /**
     * Finds order by invoiceId
     * @param string $invoiceId - invoice id for searching
     * @return Order|null
     */
    public function getOrderByInvoiceId(string $invoiceId) : ?Order
    {
        return Order::query()->with('goods')->where(['invoice_id' => $invoiceId])->get()->first();
    }
}
