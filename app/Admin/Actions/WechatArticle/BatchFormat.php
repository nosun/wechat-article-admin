<?php

namespace App\Admin\Actions\WechatArticle;

use Encore\Admin\Actions\BatchAction;
use Illuminate\Database\Eloquent\Collection;


class BatchFormat extends BatchAction
{
    public $name = '批量格式化';

    public function handle(Collection $collection)
    {
        foreach ($collection as $model) {
            if(empty($model->content)){
                $model->format();
            }
        }

        return $this->response()->success('格式化完成')->refresh();
    }
}
