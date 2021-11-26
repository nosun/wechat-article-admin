<?php

namespace App\Admin\Controllers;

use App\Models\WechatArticleDynamic;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatArticleDynamicController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'WechatArticleDynamic';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatArticleDynamic());

        $grid->column('id', __('Id'));
        $grid->column('sn', __('Sn'));
        $grid->column('read_num', __('Read num'));
        $grid->column('like_num', __('Like num'));
        $grid->column('comment_count', __('Comment count'));
        $grid->column('spider_time', __('Spider time'));
        $grid->column('__biz', __('  biz'));

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
        $show = new Show(WechatArticleDynamic::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('sn', __('Sn'));
        $show->field('read_num', __('Read num'));
        $show->field('like_num', __('Like num'));
        $show->field('comment_count', __('Comment count'));
        $show->field('spider_time', __('Spider time'));
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
        $form = new Form(new WechatArticleDynamic());

        $form->text('sn', __('Sn'));
        $form->number('read_num', __('Read num'));
        $form->number('like_num', __('Like num'));
        $form->number('comment_count', __('Comment count'));
        $form->datetime('spider_time', __('Spider time'))->default(date('Y-m-d H:i:s'));
        $form->text('__biz', __('  biz'));

        return $form;
    }
}
