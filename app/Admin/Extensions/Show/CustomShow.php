<?php

namespace App\Admin\Extensions\Show;

use Encore\Admin\Show\AbstractField;

class CustomShow extends AbstractField
{

    public $border = false;

    public function render($arg = '')
    {
        return $this->value;
    }
}