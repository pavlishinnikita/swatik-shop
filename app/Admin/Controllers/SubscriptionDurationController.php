<?php

namespace App\Admin\Controllers;

use App\Models\SubscriptionDuration;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;
use function __;

/**
 * @package App\Http\Controllers
 * @category controllers
 *
 * class SubscriptionController - controller class for operations with entity subscriptions durations available in the app
 */
class SubscriptionDurationController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Подписки товаров';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new SubscriptionDuration());
        $grid->disableExport();
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', 'ID')->sortable();
        $grid->column('value', 'Значение')->sortable();
        $grid->column('label', 'Отображаемое имя')->sortable();

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
        $show = new Show(SubscriptionDuration::findOrFail($id));
        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new SubscriptionDuration());
        $form->text('label', 'Отображаемое имя');
        $form->text('value', 'Значение');
        return $form;
    }
}
