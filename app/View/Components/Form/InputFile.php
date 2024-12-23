<?php

namespace App\View\Components\Form;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class InputFile extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string  $label  The label for the file input.
     * @param  string  $model  The Livewire model binding.
     * @param  string  $name  The name attribute for the input field.
     * @param  string|null  $accept  The accepted file types (default: '.png, .jpg, .jpeg').
     * @param  string|null  $value  The current value or URL of the file.
     * @param  string|null  $placeholder  The placeholder image URL.
     * @param  string|null  $hint  The hint text displayed below the input.
     */
    public function __construct(
        public string $label,
        public string $model,
        public string $name,
        public ?string $accept = '.png, .jpg, .jpeg',
        public ?string $value = null,
        public ?string $placeholder = null,
        public ?string $hint = 'Allowed file types: png, jpg, jpeg.'
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.form.input-file');
    }
}
