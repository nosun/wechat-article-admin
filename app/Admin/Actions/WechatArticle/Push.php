<?php

namespace App\Admin\Actions\WechatArticle;

use App\Models\WechatArticle;
use App\Services\GroupSiteService;
use Encore\Admin\Actions\RowAction;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class Push extends RowAction
{
    public $name = '推送';

    public function handle(WechatArticle $article, Request $request)
    {
        $pusher = new GroupSiteService();

        $site_id = $request->post('site_id');

        try {
            $pusher->transferArticle($article, $site_id);
            return $this->response()->success("成功推送")->refresh();
        } catch (\Exception $exception) {
            Log::error($exception->getTraceAsString());
            return $this->response()->error($exception->getMessage())->refresh();
        }
    }

    public function form()
    {
        $groupsites = (new GroupSiteService())->getGroupsites();

        if ($groupsites) {
            $this->select('site_id', '选择站点')
                ->options($groupsites)
                ->rules('required');
        }
    }

}
