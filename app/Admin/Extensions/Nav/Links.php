<?php

namespace App\Admin\Extensions\Nav;

class Links
{
    public function __toString()
    {
        $url_index = route('admin.home');
        return <<<HTML
<li>
    <a href="{$url_index}" target="_blank">
      <i class="fa fa-home"></i>
      <span>首页</span>
    </a>
</li>

HTML;
    }
}
