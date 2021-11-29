<?php

namespace App\Admin\Controllers;

use App\Models\WechatAccountTask;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatAccountTaskController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公众号账号任务';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatAccountTask());

        $grid->column('id', __('Id'));
        $grid->column('account.account', __('Biz'));
        $grid->column('last_publish_time', __('Last publish time'));
        $grid->column('last_spider_time', __('Last spider time'));
        $grid->column('is_zombie', __('Is zombie'));

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
        $show = new Show(WechatAccountTask::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('__biz', __('  biz'));
        $show->field('last_publish_time', __('Last publish time'));
        $show->field('last_spider_time', __('Last spider time'));
        $show->field('is_zombie', __('Is zombie'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WechatAccountTask());

        $form->text('__biz', __('Biz'));
        $form->datetime('last_publish_time', __('Last publish time'))->default(date('Y-m-d H:i:s'));
        $form->datetime('last_spider_time', __('Last spider time'))->default(date('Y-m-d H:i:s'));
        $form->number('is_zombie', __('Is zombie'));

        return $form;
    }
}
