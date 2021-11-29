<?php

namespace App\Admin\Actions\WechatArticleTask;

use App\Models\WechatArticleTask;
use Encore\Admin\Actions\Action;
use Illuminate\Http\Request;

class AllClear extends Action
{
    protected $selector = '.all-clear';

    public function handle(Request $request)
    {
        WechatArticleTask::query()->delete();

        return $this->response()->success('清除成功')->refresh();
    }

    public function dialog()
    {
        $this->confirm('确定删除？');
    }

    public function html()
    {
        return <<<HTML
        <a class="btn btn-sm btn-danger all-clear">清除任务</a>
HTML;
    }
}
