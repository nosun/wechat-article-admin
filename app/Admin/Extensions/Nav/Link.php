<?php

namespace App\Admin\Extensions\Nav;

use Illuminate\Contracts\Support\Renderable;

class Link implements Renderable
{
    protected $title;
    protected $href;
    protected $icon;
    protected $target;

    public function __construct($title, $href, $icon = 'fa-gears', $target = '_self')
    {
        $this->title = $title;
        $this->href = $href;
        $this->icon = $icon;
        $this->target = $target;
    }

    public static function make($title, $href, $icon = 'fa-gears', $target = '_self')
    {
        return new static($title, $href, $icon, $target);
    }

    public function render()
    {
        $link = $this->href;
        $icon = '';
        if ($this->icon) {
            $icon = "<i class=\"fa {$this->icon}\"></i>";
        }
        return <<<HTML
<li>
    <a href="{$link}" target="{$this->target}">
      {$icon}
      <span>{$this->title}</span>
    </a>
</li>
HTML;
    }
}