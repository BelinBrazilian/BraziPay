{{-- https://preview.keenthemes.com/html/keen/docs/base/badges --}}

{{-- begin::Menu item --}}
<div class="menu-item px-{{ $padding }}" {{ $htmlAttributes }}>
    @if ($hasLink)
        <a href="{{ $link }}" class="menu-link px-{{ $linkPadding }}" {{ $htmlLinkAttributes }}>
            @isset($icon)
                <span class="menu-icon">{!! $icon !!}</span>
            @endisset
            @if($attributes?->has('title'))
                <span class="menu-text">
                    {{ $attributes?->get('title') }}
                </span>
            @endif
            @isset($badgeAttributes)
                <span class="menu-badge">
                    <span class="badge badge-{{ $badgeColor }} badge-{{ $badgeFormat }} fw-bold fs-7">
                        {{ $badgeText }}
                    </span>
                </span>
            @endisset
            @if ($slot->isNotEmpty())
                <span class="menu-arrow"></span>
            @endif
        </a>
    @endif

    {{ $slot }}
</div>
{{-- end::Menu item --}}
