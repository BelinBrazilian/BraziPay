<?php

namespace App\View\Components\Menu\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuAccordion extends Component
{
    public bool $isActive;
    public string $title;
    public string $icon;

    /**
     * Create a new component instance.
     */
    public function __construct(bool $isActive = false, string $title = '', string $icon = '')
    {
        $this->isActive = $isActive;
        $this->title = $title;
        $this->icon = $icon;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.main.menu-accordion');
    }
}
