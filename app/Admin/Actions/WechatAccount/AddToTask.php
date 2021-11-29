<?php

namespace App\Admin\Actions\WechatAccount;

use App\Models\WechatAccount;
use Encore\Admin\Actions\RowAction;

class AddToTask extends RowAction
{
    public $name = '加入任务';

    public function handle(WechatAccount $model)
    {
        if(!$model->accountTask){
            $model->addToWechatAccountTask();
            return $this->response()->success('加入成功')->refresh();
        }

        return $this->response()->warning('已经在任务中')->refresh();
    }

}
