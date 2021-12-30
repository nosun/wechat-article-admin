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

        $site_name = $request->post('site_name');

        try {
            $pusher->transferArticle($article, $site_name);
            $article->update([
                'status' => WechatArticle::STATUS_USED,
                'using_site_name' => $site_name,
            ]);
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
            $this->select('site_name', '选择站点')
                ->options($groupsites)
                ->rules('required');
        }
    }

}
