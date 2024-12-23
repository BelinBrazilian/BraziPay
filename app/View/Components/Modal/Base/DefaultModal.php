<?php

namespace App\View\Components\Modal\Base;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DefaultModal extends Component
{
    /**
     * Create a new component instance.
     *
     * @param  string  $id  The ID of the modal.
     * @param  string|null  $title  The title of the modal (optional, if no custom header slot is used).
     * @param  string|null  $size  The size of the modal dialog (e.g., 'mw-650px', 'mw-750px').
     * @param  string|null  $cancelText  Text for the cancel button (default: 'Discard').
     * @param  string|null  $submitText  Text for the submit button (default: 'Submit').
     * @param  bool  $showFooter  Whether to show the footer (default: true).
     * @param  bool  $showCancel  Whether to show the cancel button in the footer (default: true).
     */
    public function __construct(
        public string $id,
        public ?string $title = null,
        public ?string $size = 'mw-650px',
        public ?string $cancelText = 'Discard',
        public ?string $submitText = 'Submit',
        public bool $showFooter = true,
        public bool $showCancel = true
    ) {}

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.modal.base.default-modal');
    }
}
