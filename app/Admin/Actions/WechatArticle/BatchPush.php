<?php

namespace App\Admin\Actions\WechatArticle;

use App\Jobs\PushArticle;
use App\Services\GroupSiteService;
use Encore\Admin\Actions\BatchAction;
use Illuminate\Bus\Batch;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;

class BatchPush extends BatchAction
{
    public $name = '批量推送';

    public function handle(Collection $collection, $request)
    {
        $domain = $request->post('domain');
        $tasks = [];

        foreach ($collection as $article) {
            $tasks[] = new PushArticle($article, $domain);
        }

        $batch = Bus::batch($tasks)->then(function (Batch $batch) {
            Log::info("article push success, batch id is:" . $batch->id);
        })->catch(function (Batch $batch, \Exception $e) {
            Log::error("article push failed, batch id is " . $batch->id . $e->getMessage());
        })->dispatch();

        $message = $this->getSuccessMessage($batch);

        return $this->response()->success($message)->refresh();
    }

    public function form()
    {
        $groupsites = (new GroupSiteService())->getGroupsites();

        if ($groupsites) {
            $this->select('domain', '选择站点')
                ->options($groupsites)
                ->rules('required');
        }
    }


    /**
     * 获取消息
     *
     * @param $batch
     * @return string
     */

    public function getSuccessMessage($batch)
    {
        $push_success_total = $batch->totalJobs - $batch->failedJobs;
        return "已经推送给 " . (string)$push_success_total . ' 文';
    }

}
