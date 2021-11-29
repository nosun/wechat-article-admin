<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatArticleTask extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table = 'wechat_article_task';

    const STATUS_PENDING = 0;
    const STATUS_CRAWLING = 1;
    const STATUS_FINISHED = 2;

    public static $states = [
        self::STATUS_PENDING => '待爬取',
        self::STATUS_CRAWLING => '正爬取',
        self::STATUS_FINISHED => '已爬取',
    ];

    public function article()
    {
        return $this->hasOne(WechatArticle::class, 'sn', 'sn');
    }

    public function account()
    {
        return $this->belongsTo(WechatAccount::class, '__biz', '__biz');
    }
}
