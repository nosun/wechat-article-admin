<?php

namespace App\Admin\Controllers;

use App\Models\WechatArticleTask;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatArticleTaskController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公众号文章任务';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatArticleTask());

        $grid->model()->orderByDesc('id');

        $grid->column('id', __('Id'));
        $grid->column('__biz', __('Biz'));
        $grid->column('sn', __('Sn'));
        $grid->column('state', __('State'));
        return $grid;
    }

    /**
     * Make a show builder.
     *
     * @param mixed $id
     * @return Show
     */
    protected function detail($id)
    {
        $show = new Show(WechatArticleTask::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sn', __('Sn'));
        $show->field('article_url', __('Article url'));
        $show->field('state', __('State'));
        $show->field('__biz', __('  biz'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WechatArticleTask());

        $form->text('sn', __('Sn'));
        $form->text('article_url', __('Article url'));
        $form->number('state', __('State'));
        $form->text('__biz', __('  biz'));

        return $form;
    }
}
