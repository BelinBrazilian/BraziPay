<?php

namespace App\View\Components\Menu\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuItem extends Component
{
    public bool $isActive;
    public string $route;
    public string $title;
    public string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $isActive = false, string $route = '', string $title = '', string $icon = '')
    {
        $this->isActive = $isActive;
        $this->route = $route;
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.main.menu-item');
    }
}
