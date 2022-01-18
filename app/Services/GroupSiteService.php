<?php

namespace App\Services;


use App\Models\WechatArticle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use \Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class GroupSiteService
{

    protected $group_site_base_uri;
    public $app_id = 'wechat-article';
    public $app_key = 'spider';

    public function __construct()
    {
        $this->group_site_base_uri = config('app.group_site_api');
    }

    public function getGroupsites()
    {
//        Cache::forget('groupsites');

        return Cache::remember('groupsites', 3600, function () {
            $response = Http::get($this->group_site_base_uri . '/groupsites');

            if ($response->status() !== 200) {
                throw new \Exception('failed:' . $response->status());
            }

            $groupsites = json_decode($response->body(), true);

            $data = [];

            if (count($groupsites)) {
                foreach ($groupsites as $row) {
                    $data[$row['domain']] = $row['name'];
                }
            }

            return $data;
        });
    }

    /**
     * @param $article
     * @return mixed
     * @throws \Exception
     */
    public function transferArticle(WechatArticle $article, $domain)
    {
        Log::info($this->group_site_base_uri);
        $response = Http::withHeaders([
            'accept' => 'application/json'
        ])->post($this->group_site_base_uri . '/articles', [
            'title' => $article->title,
            'digest' => $article->digest,
            'thumb' => $article->getThumb(),
            'author' => $article->author,
            'source' => $article->getSource(),
            'content' => $article->getContent(),
            'app_id' => $this->getAppId(),
            'app_content_id' => $article->id,
            'domain' => $domain,
            'signature' => $this->getSignature($article),
        ]);

        if ($response->status() !== 200) {
            Log::error($response->body());
            return false;
        }

        return json_decode($response->body());
    }

    /**
     *
     */
    protected function getAppId()
    {
        return $this->app_id;
    }

    /**
     * @param $article
     * @return string
     */
    protected function getSignature($article)
    {
        return Hash::make($this->app_key . $this->app_id . $article->id);
    }
}
