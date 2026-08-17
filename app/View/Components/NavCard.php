<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class NavCard extends Component
{
    public $route;
    public $icon;
    public $title;
    public $highlight;

    public function __construct($route, $icon, $title, $highlight = false)
    {
        $this->route = $route;
        $this->icon = $icon;
        $this->title = $title;
        $this->highlight = $highlight;
    }

    public function render(): View|Closure|string
    {
        return view('components.nav-card');
    }
}
