<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WechatAccount extends Model
{
    use HasFactory;

    public $timestamps = false;
    public $table = 'wechat_account';
    protected $guarded = [];

    /**
     *
     */
    public function addToWechatAccountTask()
    {
        return WechatAccountTask::create([
            '__biz' => $this->__biz
        ]);
    }

    /**
     * relation
     */
    public function accountTask()
    {
        return $this->hasOne(WechatAccountTask::class, '__biz', '__biz');
    }

}
