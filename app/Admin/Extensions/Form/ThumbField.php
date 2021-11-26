<?php

namespace App\Admin\Extensions\Form;

use Encore\Admin\Form\Field;

class ThumbField extends Field\Image
{

    protected function preview()
    {
        return getImageUrl('400x0', $this->value);
    }
}