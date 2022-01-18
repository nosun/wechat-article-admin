<?php

namespace App\Jobs;

use App\Models\WechatArticle;
use App\Services\GroupSiteService;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class PushArticle implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels, Batchable;

    public $article;
    public $domain;

    /**
     * Create a new job instance.
     *
     * @param $article
     * @param $domain
     * @return void
     */
    public function __construct($article, $domain)
    {
        $this->article = $article;
        $this->domain = $domain;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $pusher = new GroupSiteService();

        $result = $pusher->transferArticle($this->article, $this->domain);

        if($result){
            $this->article->update([
                'status' => WechatArticle::STATUS_USED,
                'using_site_name' => $this->domain,
            ]);
        }
    }
}
