<?php

namespace App\Admin\Extensions\Nav;

use Illuminate\Contracts\Support\Renderable;

class DropDown implements Renderable
{
    public function render()
    {
        return <<<HTML
<li class="dropdown">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-th"></i>
    </a>
    <ul class="dropdown-menu" style="padding: 0;box-shadow: 0 2px 3px 0 rgba(0,0,0,.2);">
        <li>
           <div class="box box-solid" style="width: 300px;margin-bottom: 0;">
            <!-- /.box-header -->
            <div class="box-body">
              <a class="btn btn-app" href="/admin/articles">
                <i class="fa fa-bullhorn"></i> 新闻
              </a>
              <a class="btn btn-app" href="/admin/articles">
                <i class="fa fa-codiepie"></i> 案例
              </a>
              <a class="btn btn-app" href="/admin/pages">
                <i class="fa fa-files-o"></i> 单页
              </a>
              <a class="btn btn-app" href="/admin/banners">
                <i class="fa fa-fa"></i> 横幅
              </a>
              <a class="btn btn-app" href="/admin/friend-links">
                <i class="fa fa-link"></i> 友情链接
              </a>
            </div>
            <!-- /.box-body -->
          </div>
      </li>
    </ul>
</li>
HTML;
    }
}