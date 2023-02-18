<?php

namespace App\Services;


use App\Models\Order;

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
        $order = new Order();
        $order->details = $this->prepareOrderDetails($data);
        $order->saveOrFail();
        $order->goods()->attach($data['good_id'], ['count' => 1]);
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
}
