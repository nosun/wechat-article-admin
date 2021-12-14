<?php

namespace App\Observers;

use App\Models\WechatArticle;
use App\Models\WechatArticleContent;

class WechatArticleObserver
{
    /**
     * Handle the WechatArticle "created" event.
     *
     * @param  \App\Models\WechatArticle $wechatArticle
     * @return void
     */
    public function created(WechatArticle $wechatArticle)
    {
        //
    }

    /**
     * Handle the WechatArticle "updated" event.
     *
     * @param  \App\Models\WechatArticle $wechatArticle
     * @return void
     */
    public function updated(WechatArticle $wechatArticle)
    {
        //
    }

    /**
     * Handle the WechatArticle "deleted" event.
     *
     * @param  \App\Models\WechatArticle $wechatArticle
     * @return void
     */
    public function deleted(WechatArticle $wechatArticle)
    {
        // 同时删除 content 记录
        $wechatArticle->content()->delete();
        $wechatArticle->dynamic()->delete();
    }

    /**
     * Handle the WechatArticle "restored" event.
     *
     * @param  \App\Models\WechatArticle $wechatArticle
     * @return void
     */
    public function restored(WechatArticle $wechatArticle)
    {
        //
    }

    /**
     * Handle the WechatArticle "force deleted" event.
     *
     * @param  \App\Models\WechatArticle $wechatArticle
     * @return void
     */
    public function forceDeleted(WechatArticle $wechatArticle)
    {
        //
    }
}
