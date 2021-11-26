<?php

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

class ThumbShow extends AbstractField
{

    public $border = false;
    public $escape = false;

    public function render($arg = '')
    {
        return "<img src='" . getImageUrl($this->value, 300, 0, 90) . "'/>";
    }
}
