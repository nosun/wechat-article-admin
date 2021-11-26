<?php

namespace App\Admin\Controllers;

use App\Models\WechatAccount;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatAccountController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公众号账号';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatAccount());

        $grid->column('id', __('Id'));
        $grid->column('account', __('Account'));
        $grid->column('__biz', __('Biz'));
        $grid->column('qr_code', __('Qr code'))->image('',100);
        $grid->column('spider_time', __('Spider time'));

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
        $show = new Show(WechatAccount::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('__biz', __('  biz'));
        $show->field('account', __('Account'));
        $show->field('head_url', __('Head url'));
        $show->field('summary', __('Summary'));
        $show->field('qr_code', __('Qr code'));
        $show->field('verify', __('Verify'));
        $show->field('spider_time', __('Spider time'));

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WechatAccount());

        $form->text('__biz', __('  biz'));
        $form->text('account', __('Account'));
        $form->text('head_url', __('Head url'));
        $form->text('summary', __('Summary'));
        $form->text('qr_code', __('Qr code'));
        $form->text('verify', __('Verify'));
        $form->datetime('spider_time', __('Spider time'))->default(date('Y-m-d H:i:s'));

        return $form;
    }
}
