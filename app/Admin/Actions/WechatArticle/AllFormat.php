<?php

namespace App\Admin\Actions\WechatArticle;

use App\Models\WechatArticle;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class AllFormat extends Action
{
    protected $selector = '.all-format';

    public function handle(Request $request)
    {
        $articles = WechatArticle::query()
            ->where('format_status',WechatArticle::STATUS_PENDING)
            ->take(500)
            ->get();

        $total = $articles->count();

        if ($total) {
            foreach ($articles as $article) {
                $article->format();
            }
        }

        return $this->response()->success('一共更新了' . $total . '文章')->refresh();
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-success all-format">全部格式化</a>
HTML;
    }
}
