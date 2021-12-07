<?php

namespace App\Services;


use App\Models\WechatArticle;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Http;
use \Illuminate\Support\Facades\Cache;

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

        return Cache::remember('groupsites', 86400, function () {
            $response = Http::get($this->group_site_base_uri . '/groupsites');

            if ($response->status() !== 200) {
                throw new \Exception('failed:' . $response->status());
            }

            $groupsites = json_decode($response->body(), true);

            $data = [];

            if (count($groupsites)) {
                foreach ($groupsites as $row) {
                    $data[$row['id']] = $row['name'];
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
    public function transferArticle(WechatArticle $article, $site_id)
    {
        $response = Http::post($this->group_site_base_uri . '/articles', [
            'title' => $article->title,
            'digest' => $article->digest,
            'thumb' => $article->getThumb(),
            'author' => $article->author,
            'source' => $article->getSource(),
            'content' => $article->getContent(),
            'app_id' => $this->getAppId(),
            'app_content_id' => $article->id,
            'site_id' => $site_id,
            'signature' => $this->getSignature($article),
        ]);

        if ($response->status() !== 200) {
            throw new \Exception('failed:' . $response->status());
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
