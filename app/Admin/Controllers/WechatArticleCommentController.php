<?php

namespace App\Admin\Controllers;

use App\Models\WechatArticleComment;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatArticleCommentController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'WechatArticleComment';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatArticleComment());

        $grid->column('id', __('Id'));
        $grid->column('comment_id', __('Comment id'));
        $grid->column('nick_name', __('Nick name'));
        $grid->column('logo_url', __('Logo url'));
        $grid->column('content', __('Content'));
        $grid->column('create_time', __('Create time'));
        $grid->column('content_id', __('Content id'));
        $grid->column('like_num', __('Like num'));
        $grid->column('is_top', __('Is top'));
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
        $show = new Show(WechatArticleComment::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('comment_id', __('Comment id'));
        $show->field('nick_name', __('Nick name'));
        $show->field('logo_url', __('Logo url'));
        $show->field('content', __('Content'));
        $show->field('create_time', __('Create time'));
        $show->field('content_id', __('Content id'));
        $show->field('like_num', __('Like num'));
        $show->field('is_top', __('Is top'));
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
        $form = new Form(new WechatArticleComment());

        $form->text('comment_id', __('Comment id'));
        $form->text('nick_name', __('Nick name'));
        $form->text('logo_url', __('Logo url'));
        $form->text('content', __('Content'));
        $form->datetime('create_time', __('Create time'))->default(date('Y-m-d H:i:s'));
        $form->text('content_id', __('Content id'));
        $form->number('like_num', __('Like num'));
        $form->number('is_top', __('Is top'));
        $form->datetime('spider_time', __('Spider time'))->default(date('Y-m-d H:i:s'));
        $form->text('__biz', __('  biz'));

        return $form;
    }
}
