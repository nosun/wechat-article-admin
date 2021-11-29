<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\WechatArticleTask\AllClear;
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

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->equal('account.account', __('Account'));
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->equal('state', __('Status'))->select(WechatArticleTask::$states);
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('account.account', __('Account'));
        $grid->column('article.title', __('Title'));
        $grid->column('state', __('State'))->display(function($value){
            return WechatArticleTask::$states[$value];
        });

        $grid->tools(function($tools){
            $tools->append(new AllClear());
        });

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
