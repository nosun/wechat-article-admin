<?php

namespace App\Admin\Controllers;

use App\Admin\Actions\WechatArticle\AllFormat;
use App\Admin\Actions\WechatArticle\BatchFormat;
use App\Admin\Actions\WechatArticle\Format;
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
                $filter->equal('account', __('Account'));
                $filter->like('title', __('Title'));
                $filter->where(function ($query) {
                    switch ($this->input) {
                        case '1':
                            // custom complex query if the 'yes' option is selected
                            $query->where('copyright_status', 11);
                            break;
                        case '2':
                            $query->where('copyright_status', 100);
                            break;
                        case '3':
                            $query->where('copyright_status', '>', 100);
                            break;
                    }
                }, __('Copyright status'))->select([
                    '' => 'All',
                    '1' => '原创',
                    '2' => '非原',
                    '3' => '转载',
                ]);

                $filter->equal('status', __('Status'))->select(WechatArticle::$states);
            });

            $filter->column(1 / 2, function ($filter) {
                $filter->like('author', __('Author'));
                $filter->gt('read_num', __('Read num'));
                $filter->between('publish_time', __('Publish time'))->datetime();
                $filter->equal('format_status', __('Format status'))->select(WechatArticle::$format_states);
            });
        });

        $grid->column('id', __('Id'));
        $grid->column('title', __('Title'))->display(function ($value) {
            return generateLink(route('admin.wechat-articles.show', ['wechat_article' => $this->id]),
                $value, '_blank'
            );
        })->width(320);
        $grid->column('read_num', __('Read num'))->sortable();
        $grid->column('like_num', __('Like num'))->sortable();
        $grid->column('account', __('Account'));
        $grid->column('status', __('Status'))->display(function ($value) {
            return WechatArticle::$states[$value];
        });
        $grid->column('copyright_status', __('Copyright status'))->display(function ($value) {
            return WechatArticle::getCopyRight($value);
        });
        $grid->column('author', __('Author'));
        $grid->column('publish_time', __('Publish time'))->sortable()->display(function ($value) {
            return substr($value, 0, 10);
        });

        $grid->disableCreateButton();

        $grid->actions(function ($actions) {
            $actions->disableDelete();
            $actions->disableView();
            $actions->add(new Format());
        });

        $grid->disableBatchActions(false);
        $grid->batchActions(function ($actions) {
            $actions->add(new BatchFormat());
            $actions->disableDelete();
        });

        $grid->tools(function($tools){
            $tools->append(new AllFormat());
        });

        return $grid;
    }

//    /**
//     * Show interface.
//     *
//     * @param mixed   $id
//     * @param Content $content
//     *
//     * @return Content
//     */
//    public function show($id, Content $content)
//    {
//        $article = WechatArticle::find($id);
//        return $content
//            ->title($this->title())
//            ->description($this->description['show'] ?? trans('admin.show'))
//            ->body(new Box('文章详情', view('admin.wechat-articles.show', ['article' => $article])));
//    }

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
        $show->field('content', __('Content'))->html();

        $show->panel()->tools(function ($tools) {
            $tools->disableDelete();
        });

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
            $form->UEditor('content_html', __('Content html'))->setWidth(10);
        });

        $form->column(1 / 2, function ($form) {
            $form->text('author', __('Author'))->setWidth(10);
            $form->UEditor('content', __('Content'))->setWidth(10);
            $form->select('status', __('Status'))
                ->options(WechatArticle::$states)
                ->setWidth(4);
        });

        $form->tools(function ($tools) {
            $tools->disableDelete();
        });

        $form->disableReset();

        return $form;
    }
}
