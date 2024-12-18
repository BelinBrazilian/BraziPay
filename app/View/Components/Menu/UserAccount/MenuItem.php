<?php

namespace App\View\Components\Menu\UserAccount;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\View\ComponentAttributeBag;

class MenuItem extends Component
{
    public bool $hasLink;
    public string $padding;
    public string $link;
    public string $linkPadding;
    public string $icon;

    public string $htmlAttributes;
    public string $htmlLinkAttributes;
    public ComponentAttributeBag $linkAttributes;
    public ComponentAttributeBag $badgeAttributes;
    public string $badgeColor = 'light-danger';
    public string $badgeText = '0';
    public string $badgeFormat = 'circle';

    /**
     * Create a new component instance.
     */
    public function __construct(
        bool $hasLink = true,
        string $padding = '5',
        string $link = '#',
        string $linkPadding = '5',
        ?string $icon = '',
    ) {
        $this->hasLink = $hasLink;
        $this->padding = $padding;
        $this->link = $link;
        $this->linkPadding = $linkPadding;
        $this->icon = $icon;

        $this->htmlAttributes = $this->attributes
            ?->except(['data-link-attributes', 'title'])
            ->toHtml() ?? '';

        $this->htmlLinkAttributes = '';
        $this->linkAttributes = new ComponentAttributeBag();
        $this->badgeAttributes = new ComponentAttributeBag();

        if ($this->attributes?->get('data-link-attributes')) {
            $this->linkAttributes = new ComponentAttributeBag($this->attributes->get('data-link-attributes'));
            $this->htmlLinkAttributes = $this->linkAttributes->toHtml();

            if (!is_null($this->linkAttributes->get('badge'))) {
                $this->badgeAttributes = new ComponentAttributeBag($this->linkAttributes->get('badge'));
                $this->badgeColor = $this->badgeAttributes->get('color', 'light-danger');
                $this->badgeText = $this->badgeAttributes->get('text', '0');
                $this->badgeFormat = $this->badgeAttributes->get('format', 'circle');
            }
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.menu.user-account.menu-item');
    }
}
