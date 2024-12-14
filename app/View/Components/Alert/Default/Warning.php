<?php

namespace App\View\Components\Alert\Default;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

/**
 * Warning Alert Component.
 *
 * This component is used to display a warning-styled alert,
 * allowing customization of attributes and content via the slot.
 */
class Warning extends Component
{
    /**
     * Create a new component instance.
     *
     * Initializes the component. This can be used to inject dependencies
     * or process initial data if needed.
     */
    public function __construct()
    {
        // No properties to initialize at the moment.
    }

    /**
     * Get the view or content that represents the component.
     *
     * @return View|Closure|string
     */
    public function render(): View|Closure|string
    {
        return view('components.alert.default.warning');
    }
}
