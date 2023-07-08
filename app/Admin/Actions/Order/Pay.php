<?php

namespace App\Admin\Actions\Order;

use App\Models\Order;
use Encore\Admin\Actions\RowAction;
use Illuminate\Database\Eloquent\Model;

class Pay extends RowAction
{
    public $name = 'Сделать оплаченым';

    public function handle(Model $model)
    {
        $model->status = Order::STATUS_PAID;
        $model->save();
        return $this->response()->success('Success message.')->refresh();
    }

}
