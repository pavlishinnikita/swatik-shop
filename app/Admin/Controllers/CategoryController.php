<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\GoodCategory;
use Carbon\Carbon;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Controllers\Dashboard;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Layout\Column;
use Encore\Admin\Layout\Content;
use Encore\Admin\Layout\Row;
use Encore\Admin\Show;
use Nette\Utils\Html;

class CategoryController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Категории товаров';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodCategory());

        $grid->disableExport();

        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', 'ID')->sortable();
        $grid->column('name', 'Название')->sortable();
        $grid->column('image', 'Картинка')->display(function ($image) {
            return Html::el('img', [
                'src' => $image,
            ])->toHtml();
        });
        $grid->column('type', 'Тип')->display(function ($type) {
            return GoodCategory::TYPE_LABELS[$type] ?? 'Неверный тип: ' . $type;
        })->sortable();
        $grid->column('created_at','Создан')->display(function ($data) {
            return date('Y-m-d h:m:s', strtotime($data));
        });
        $grid->column('updated_at','Редактирован')->display(function ($data) {
            return date('Y-m-d h:m:s', strtotime($data));
        });

        // region prepare filters
        $grid->filter(function(Grid\Filter $filter){
            $filter->disableIdFilter();
            $filter->like('name', 'Имя');
            $filter->equal('type', 'Тип')->select(GoodCategory::TYPE_LABELS);
            $filter->between('created_at', 'Дата создания')->date();

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
        $show = new Show(GoodCategory::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', 'Название');
        $show->field('image', 'Картинка');
        $show->field('type', 'Тип')->as(function ($type) {
            return GoodCategory::TYPE_LABELS[$type] ?? 'Неверный тип';
        });
        $show->goods('Товары в категории', function ($good) {
            $good->resource('/admin/good/all-goods');
            $good->id();
            $good->name();
            $good->type()->display(function ($type) {
                return Good::TYPE_LABELS[$type] ?? 'Неверный тип: ' . $type;
            });
            $good->disableExport();
        });
        $show->field('created_at','Создан');
        $show->field('updated_at','Редактирован');

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new GoodCategory);
        $form->text('name', 'Название');
        $form->radio('type', "Тип")->options(GoodCategory::TYPE_LABELS)->default(GoodCategory::TYPE_SIMPLE)->stacked();
        return $form;
    }
}
