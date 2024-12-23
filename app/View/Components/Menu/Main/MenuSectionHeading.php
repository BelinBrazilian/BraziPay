<?php

namespace App\View\Components\Menu\Main;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class MenuSectionHeading extends Component
{
    public string $title;

    /**
     * Create a new component instance.
     */
    public function __construct(string $title = '')
    {
        $this->title = $title;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.main.menu-section-heading');
    }
}
