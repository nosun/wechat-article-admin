<?php

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

class HtmlShow extends AbstractField
{

    public $border = false;
    public $escape = false;

    public function render($arg = '')
    {
        return "<div style='padding-top:7px;'>" . $this->value . "</div>";
    }
}