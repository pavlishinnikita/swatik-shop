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
    protected $signature = 'good-commands:run {--undelivered}';

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
            $isForUndelivered = $this->option('undelivered');
            $orders = Order::query()
                ->with(['goods' => function($query) {
                    $query->wherePivot('is_delivered', 0);
                }])
                ->where(['status' => $isForUndelivered ? Order::STATUS_CLOSED : Order::STATUS_PAYED])
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
            if (!empty($failedOrdersIds)) {
                logger()->error('There are failed orders:', $failedOrdersIds);
            }
            //#region update orders
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
            logger()->error('Error during delivering goods:' . $e->getMessage());
            return ConsoleCommand::FAILURE;
        }
        return ConsoleCommand::SUCCESS;
    }
}
