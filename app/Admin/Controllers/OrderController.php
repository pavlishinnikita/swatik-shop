<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\Order\Pay;
use App\Http\Controllers\Controller;
use App\Models\ExchangeRate;
use App\Models\Good;
use App\Models\GoodCategory;
use App\Models\Order;
use App\Models\Payment;
use App\Services\ExchangeRate\ExchangeRateBaseService;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Grid\Displayers\DropdownActions;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Nette\Utils\Html;

class OrderController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Заказы';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Order);
        $grid->disableCreateButton();
        $grid->disableExport();
        // region prepare columns
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', 'ID')->sortable();
        $grid->column('invoice_id', '№ инвойса');
        $grid->column('details', 'Детали заказа')->view('admin/details_column');
        $grid->goods("Товары в заказе")->display(function ($goods) {
            $goods = array_map(function ($good) {
                $deliveredLabel = $good['pivot']['is_delivered'] == 1 ? 'label-success' : 'label-danger';
                return "<div class='label $deliveredLabel'><span>({$good['id']}){$good['name']}</span>-<span>{$good['pivot']['count']}</span></div>";
            }, $goods);

            return join('&nbsp;', $goods);
        });
        $grid->column('failure_reason', 'Причина отказа');
        $grid->column('price', 'Сумма')->sortable();
        $grid->column('price_exchanged', 'Сумма (с учетом перевода)')->display(function ($price) {
            return ExchangeRateBaseService::preparePriceWithCurrentCurrency($this->price, ExchangeRate::CURRENCY_UAH);
        });
        $grid->column('status', 'Статус')->display(function ($status) {
            return Order::STATUSES[$status] ?? 'Неверный статус';
        });
        $grid->column('created_at','Создан')->display(function ($data) {
            return date('Y-m-d h:m:s', strtotime($data));
        });
        $grid->column('updated_at','Редактирован')->display(function ($data) {
            return date('Y-m-d h:m:s', strtotime($data));
        });
        //#endregion
        // region prepare filters
        $grid->filter(function(Grid\Filter $filter){
            $filter->disableIdFilter();
            $filter->equal('invoice_id', '№ инвойса');
            $filter->equal('status', 'Статус')->select(Order::STATUSES);
            $filter->between('created_at', 'Дата оформления')->datetime();

        });
        //#endregion
        // region prepare row actions
        $grid->actions(function (DropdownActions $actions) use ($grid) {
            $actions->disableDelete();
            $actions->disableEdit();
            $actions->add(new Pay());
        });
        //#endregion
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed   $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(Order::findOrFail($id));
        $show->field('id');
        $show->field('invoice_id', '№ инвойса');
        $show->field('price','Цена');
        $show->field('created_at','Создан');
        $show->field('updated_at','Обновлен');
        $show->field('status', 'Статус')->as(function ($status) {
            return Order::STATUSES[$status] ?? 'Неверный статус';
        });

        $show->panel()
            ->tools(function ($tools) {
                $tools->disableEdit();
                $tools->disableDelete();
            });

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new Order);
        return $form;
    }
}
