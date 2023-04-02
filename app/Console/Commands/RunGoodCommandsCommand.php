<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\OrderGood;
use App\Services\CommandService;
use Illuminate\Console\Command;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Arr;
use Symfony\Component\Console\Command\Command as ConsoleCommand;

class RunGoodCommandsCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'good-commands:run';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Runs command for specific goods and deliver good to buyer';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(CommandService $commandService)
    {
        try {
            $orders = Order::query()
                ->where(['status' => Order::STATUS_PAYED])
                ->with(['goods', 'goods.command'])
                ->whereHas('goods', function($query) {
                    $query->where('is_delivered', '=', 0);
                })
                ->get()
                ->all();
            $failedGoodsIds = [];
            $failedOrdersIds = [];
            $successOrdersIds = [];
            foreach ($orders as $order) {
                $processResult = $commandService->processGoodCommands($order['goods'], $order['details']);
                if (!empty($processResult)) {
                    $failedGoodsIds[] = $processResult;
                    $failedOrdersIds[] = $order['id'];
                } else {
                    $successOrdersIds[] = $order['id'];
                }
            }
            //#region update orders
            Order::query()
                ->whereIn('id', $failedOrdersIds)
                ->where(['status' => Order::STATUS_PAYED])
                ->update(['status' => Order::STATUS_ERROR]);
            Order::query()
                ->whereIn('id', $successOrdersIds)
                ->where(['status' => Order::STATUS_PAYED])
                ->update(['status' => Order::STATUS_CLOSED]);
            OrderGood::query()
                ->whereNotIn('good_id', Arr::flatten($failedGoodsIds, 1))
                ->whereIn('order_id', $successOrdersIds)
                ->update(['is_delivered' => 1]);
            //#endregion
        } catch (\Exception $e) {
            // notify developers
            return ConsoleCommand::FAILURE;
        }
        return ConsoleCommand::SUCCESS;
    }
}
