<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\WechatArticle\AllFormat;
use App\Admin\Actions\WechatArticle\BatchFormat;
use App\Admin\Actions\WechatArticle\BatchPush;
use App\Admin\Actions\WechatArticle\Format;
use App\Admin\Actions\WechatArticle\Push;
use App\Models\WechatArticle;
use Encore\Admin\Controllers\AdminController;
use Encore\Admin\Form;
use Encore\Admin\Grid;
use Encore\Admin\Show;

class WechatArticleController extends AdminController
{
    /**
     * Title for current resource.
     *
     * @var string
     */
    protected $title = '公众号文章';

    /**
     * Make a grid builder.
     *
     * @return Grid
     */
    protected function grid()
    {
        $grid = new Grid(new WechatArticle());

        $grid->model()->orderByDesc('id');

        $grid->filter(function ($filter) {
            $filter->disableIdFilter();
            $filter->column(1 / 2, function ($filter) {
                $filter->equal('account.account', __('Account'));
                $filter->like('title', __('Title'));
                $filter->where(function ($query) {
                    switch ($this->input) {
                        case '1':
                            // custom complex query if the 'yes' option is selected
                            $query->where('copyright_stat', 11);
                            break;
                        case '2':
                            $query->where('copyright_stat', 100);
                            break;
                        case '3':
                            $query->where('copyright_stat', '>', 100);
                            break;
                    }
                }, __('Copyright status'))->select([
                    '' => 'All',
                    '1' => '原创',
                    '2' => '非原',
                    '3' => '转载',
                ]);

                $filter->equal('status', __('Status'))->select(WechatArticle::$states);
                $filter->equal('id', __('Id'));
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->like('author', __('Author'));
                $filter->lt('read_num', __('Read num'));
                $filter->between('publish_time', __('Publish time'))->datetime();
                $filter->equal('format_status', __('Format status'))->select(WechatArticle::$format_states);
                $filter->equal('using_site_name', __('Using site name'));
            });
        });

        $grid->column('id', __('Id'))->display(function ($value) {
            return generateLink($this->url, $value, '_blank');
        });
        $grid->column('account.account', __('Account'));
        $grid->column('title', __('Title'))->display(function ($value) {
            return generateLink(route('admin.wechat-articles.show', ['wechat_article' => $this->id]),
                $value, '_blank'
            );
        })->width(320);
        $grid->column('read_num', __('Read num'))->sortable();
//        $grid->column('like_num', __('Like num'))->sortable();
        $grid->column('status', __('Status'))->select(WechatArticle::$states);
        $grid->column('using_site_name', __('Using site name'))->display(function ($value) {
            return $value ?: '待分配';
        });
//        $grid->column('copyright_stat', __('Copyright status'))->display(function ($value) {
//            return WechatArticle::getCopyRight($value);
//        });
//        $grid->column('author', __('Author'));
        $grid->column('publish_time', __('Publish time'))->sortable()->display(function ($value) {
            return substr($value, 0, 10);
        });

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableView();
            $actions->add(new Format());
            $actions->add(new Push());
        });

        $grid->disableBatchActions(false);

        $grid->batchActions(function ($actions) {
            $actions->add(new BatchFormat());
            $actions->add(new BatchPush());
        });

        $grid->tools(function ($tools) {
            $tools->append(new AllFormat());
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
        $show = new Show(WechatArticle::findOrFail($id));

        $show->field('title', __('Title'))->html();
        $show->field('content.content', __('Content'))->html();

        return $show;
    }

    /**
     * Make a form builder.
     *
     * @return Form
     */
    protected function form()
    {
        $form = new Form(new WechatArticle());

        // 第一列占据1/2的页面宽度
        $form->column(1 / 2, function ($form) {
            $form->text('title', __('Title'))->setWidth(10);
            $form->UEditor('content.content_html', __('Content html'))->setWidth(10);
        });

        $form->column(1 / 2, function ($form) {
            $form->text('author', __('Author'))->setWidth(10);
            $form->UEditor('content.content', __('Content'))->setWidth(10);
            $form->hidden('status');
        });

        $form->disableReset();

        return $form;
    }
}
