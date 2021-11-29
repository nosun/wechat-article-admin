<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatArticle extends Model
{
    use HasFactory;

    public $table = 'wechat_article_list';
    public $timestamps = false;
    protected $guarded = [];

    const STATUS_PENDING = 0;
    const STATUS_USED = 1;
    const STATUS_DROPPED = -1;

    const STATUS_FORMAT = 1;

    public static $states = [
        self::STATUS_PENDING => '待用',
        self::STATUS_USED => '选用',
        self::STATUS_DROPPED => '弃用',
    ];

    public static $format_states = [
        self::STATUS_PENDING => '未',
        self::STATUS_FORMAT => '已',
    ];

    public function account()
    {
        return $this->belongsTo(WechatAccount::class, '__biz', '__biz');
    }

    public function content()
    {
        return $this->hasOne(WechatArticleContent::class, 'sn', 'sn');
    }

    public function dynamic()
    {
        return $this->hasOne(WechatArticleDynamic::class, 'sn', 'sn');
    }

    public static function getCopyRight($copyright_status)
    {
        switch ($copyright_status) {
            case 11:
                return '原创';
            case 100:
                return '非原';
            case 101:
            case 201:
            case 202:
                return '转载';
            default:
                return '未知';
        }
    }

    public function format()
    {
        $data = [
            'format_status' => self::STATUS_FORMAT
        ];

        if ($this->dynamic) {
            $data['read_num'] = $this->dynamic->read_num;
            $data['like_num'] = $this->dynamic->like_num;
            $data['comment_count'] = $this->dynamic->comment_count;
        }

        $this->update($data);

        if($this->content){
            $this->content->format();
        }
    }
}
