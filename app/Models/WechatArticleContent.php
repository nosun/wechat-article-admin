<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Services\WechatArticleFormatService;

class WechatArticleContent extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'wechat_article';
    protected $guarded = [];

    public function getContent()
    {
        $content = WechatArticleFormatService::format($this->content_html);

        return $content;
    }

    public function format()
    {
        $this->update([
            'content' => $this->getContent()
        ]);
    }
}
