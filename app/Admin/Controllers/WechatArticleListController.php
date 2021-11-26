<?php

namespace App\Admin\Controllers;

use App\Models\WechatArticleList;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatArticleListController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = 'WechatArticleList';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatArticleList());

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'));
        $grid->column('digest', __('Digest'));
        $grid->column('url', __('Url'));
        $grid->column('source_url', __('Source url'));
        $grid->column('cover', __('Cover'));
        $grid->column('subtype', __('Subtype'));
        $grid->column('is_multi', __('Is multi'));
        $grid->column('author', __('Author'));
        $grid->column('copyright_stat', __('Copyright stat'));
        $grid->column('duration', __('Duration'));
        $grid->column('del_flag', __('Del flag'));
        $grid->column('type', __('Type'));
        $grid->column('publish_time', __('Publish time'));
        $grid->column('sn', __('Sn'));
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
        $show = new Show(WechatArticleList::findOrFail($id));

        $show->field('id', __('Id'));
        $show->field('title', __('Title'));
        $show->field('digest', __('Digest'));
        $show->field('url', __('Url'));
        $show->field('source_url', __('Source url'));
        $show->field('cover', __('Cover'));
        $show->field('subtype', __('Subtype'));
        $show->field('is_multi', __('Is multi'));
        $show->field('author', __('Author'));
        $show->field('copyright_stat', __('Copyright stat'));
        $show->field('duration', __('Duration'));
        $show->field('del_flag', __('Del flag'));
        $show->field('type', __('Type'));
        $show->field('publish_time', __('Publish time'));
        $show->field('sn', __('Sn'));
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
        $form = new Form(new WechatArticleList());

        $form->text('title', __('Title'));
        $form->text('digest', __('Digest'));
        $form->url('url', __('Url'));
        $form->text('source_url', __('Source url'));
        $form->image('cover', __('Cover'));
        $form->number('subtype', __('Subtype'));
        $form->number('is_multi', __('Is multi'));
        $form->text('author', __('Author'));
        $form->number('copyright_stat', __('Copyright stat'));
        $form->number('duration', __('Duration'));
        $form->number('del_flag', __('Del flag'));
        $form->number('type', __('Type'));
        $form->datetime('publish_time', __('Publish time'))->default(date('Y-m-d H:i:s'));
        $form->text('sn', __('Sn'));
        $form->datetime('spider_time', __('Spider time'))->default(date('Y-m-d H:i:s'));
        $form->text('__biz', __('  biz'));

        return $form;
    }
}
