<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Weishaypt\EnotIo\Facades\EnotIo;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class EnotController - controller class for manage enot payments
 */
class EnotController extends Controller
{
    /**
     * @param Request $request
     * @return string
     */
    public function hook(Request $request)
    {
        return EnotIo::handle($request);
    }

    /**
     * Search the order in your database and return that order
     * to paidOrder, if status of your order is 'paid'
     *
     * @param Request $request
     * @param $order_id
     * @return bool|mixed
     */
    public function searchOrder(Request $request, $order_id)
    {
        $order = Order::where('id', $order_id)->first();

        if($order && $order['status'] == Order::STATUS_OPEN) {
            $order['_orderSum'] = $order->sum;
            $order['_orderStatus'] = 'paid';
            return $order;
        }

        return false;
    }

    /**
     * When paymnet is check, you can paid your order
     *
     * @param Request $request
     * @param $order
     * @return bool
     */
    public function paidOrder(Request $request, $order)
    {
        $order->status = Order::STATUS_PAID;
        $order->save();
        return true;
    }
}
