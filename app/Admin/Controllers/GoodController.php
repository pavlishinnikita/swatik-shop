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

class GoodController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Товары';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new Good);
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
            return Good::TYPE_LABELS[$type] ?? 'Неверный тип: ' . $type;
        })->sortable();
        $grid->column('price','Цена')->sortable();
        $grid->column('category', 'Название категории')->display(function ($category) {
            return "({$category['id']})" . $category['name'];
        });
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
            $filter->equal('type', 'Тип')->select(Good::TYPE_LABELS);
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
        $show = new Show(Good::findOrFail($id));

        $show->field('id', 'ID');
        $show->field('name', 'Название');
        $show->field('image', 'Картинка')->image();
        $show->field('type', 'Тип');
        $show->field('price','Цена');
        $show->field('description', 'Описание')->unescape();
        $show->category('Категория', function ($category) {
            $category->id();
            $category->name();
            $category->type()->as(function ($type) {
                return GoodCategory::TYPE_LABELS[$type] ?? 'Неверный тип: ' . $type;
            });
        });
        $show->command('Команда доставки', function ($command) {
            $command->command('Команда');
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
        $test = GoodCategory::query()->get(['id', 'name'])->mapWithKeys(function ($item) {
            return [$item['id'] => "({$item['id']}){$item['name']}"];
        })->all();
        $form = new Form(new Good);

        $form->display('id', 'ID');
        $form->text('name', 'Название');
        $form->radio('type', __('Type'))->options(Good::TYPE_LABELS)->default(Good::TYPE_DEFAULT)->stacked();
        $form->decimal('price', 'Цена');
        $form->select('good_category_id', 'Категория')->options($test);
        $form->tmeditor('description')->options(['lang' => 'fr', 'height' => 500]);

        return $form;
    }
}