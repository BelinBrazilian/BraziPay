<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CheckBox extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string  $label  The label for the checkbox group.
     * @param  string  $model  The Livewire model binding.
     * @param  string  $name  The name attribute for the checkboxes.
     * @param  array  $options  The options for the checkboxes (key-value pairs).
     */
    public function __construct(
        public string $label,
        public string $model,
        public string $name,
        public array $options
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.check-box');
    }
}
