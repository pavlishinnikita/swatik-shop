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
            return [
                'id' => $order->id,
                '_orderSum' => $order->price,
                '_orderStatus' => 'open',
                'invoice_number' => $request->post('intid'),
            ];
        }

        return false;
    }

    /**
     * When payment is check, you can paid your order
     *
     * @param Request $request
     * @param $order
     * @return bool
     */
    public function paidOrder(Request $request, $order)
    {
        $invoiceNumber = $orderData['invoice_number'] ?? '';
        $order = Order::where('id', $order['id'])->first();
        $order->status = Order::STATUS_PAID;
        $order->invoice_id = $invoiceNumber;
        $order->save();
        return true;
    }
}
