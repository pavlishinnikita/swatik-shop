<?php

namespace App\Admin\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Good;
use App\Models\GoodCategory;
use App\Models\GoodCommand;
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

class CommandController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'Команды';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new GoodCommand);
        $grid->disableExport();
        $grid->model()->orderBy('id', 'desc');
        $grid->column('id', 'ID')->sortable();
        $grid->good('Товар')->display(function ($good) {
            return '(' . $good['id'] . ') ' . $good['name'] . ' ' . $good['label'];
        });
        $grid->column('command', 'Команда')->sortable();

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
        $show = new Show(GoodCommand::findOrFail($id));

        $show->field('id', 'ID');
        $show->good('Товар')->as(function ($good) {
            return '(' . $good['id'] . ') ' . $good['name'];
        });
        $show->field('command', 'Команда');
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
        $test = Good::query()->get(['id', 'name'])->mapWithKeys(function ($item) {
            return [$item['id'] => "({$item['id']}){$item['name']}"];
        })->all();
        $form = new Form(new GoodCommand);

        $form->display('id', 'ID');
        $form->text('command', 'Команда'); // need to add tip with additional info
        $form->select('good_id', 'Товар')->options($test);

        return $form;
    }
}
