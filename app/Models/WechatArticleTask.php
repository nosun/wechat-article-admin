<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatArticleTask extends Model
{
    use HasFactory;
    public $timestamps = false;

    public $table = 'wechat_article_task';
}
