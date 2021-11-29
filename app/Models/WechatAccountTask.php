<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatAccountTask extends Model
{
    use HasFactory;
    public $timestamps = false;
    protected $guarded = [];
    protected $fillable = ['__biz'];

    public $table = 'wechat_account_task';

    const IS_ZOMBIE = 1;
    const IS_NORMAL = 0;

    public $states = [
        self::IS_NORMAL => '正常',
        self::IS_ZOMBIE => '停更'
    ];

    public function account()
    {
        return $this->belongsTo(WechatAccount::class, '__biz', '__biz');
    }

}
