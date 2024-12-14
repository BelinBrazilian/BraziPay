<?php

namespace App\View\Components\Menu\UserAccount;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class Separator extends Component
{
    public string $margin;

    /**
     * Create a new component instance.
     */
    public function __construct(string $margin = '2')
    {
        $this->margin = $margin;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.user-account.separator');
    }
}
