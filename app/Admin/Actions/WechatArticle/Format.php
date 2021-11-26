<?php

namespace App\Admin\Actions\WechatArticle;

use App\Models\WechatArticle;
use Encore\Admin\Actions\RowAction;

class Format extends RowAction
{
    public $name = '格式化';

    public function handle(WechatArticle $model)
    {
        $model->format();

        return $this->response()->success('更新成功')->refresh();
    }

}
