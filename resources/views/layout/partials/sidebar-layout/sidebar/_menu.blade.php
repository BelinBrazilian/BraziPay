{{-- begin::sidebar menu --}}
<div class="app-sidebar-menu overflow-hidden flex-column-fluid">

    {{-- begin::Menu wrapper --}}
    <div id="kt_app_sidebar_menu_wrapper"
         class="app-sidebar-wrapper hover-scroll-overlay-y my-5"
         data-kt-scroll="true"
         data-kt-scroll-activate="true"
         data-kt-scroll-height="auto"
         data-kt-scroll-dependencies="#kt_app_sidebar_logo, #kt_app_sidebar_footer"
         data-kt-scroll-wrappers="#kt_app_sidebar_menu"
         data-kt-scroll-offset="5px"
         data-kt-scroll-save-state="true">

        {{-- begin::Menu --}}
        <div class="menu menu-column menu-rounded menu-sub-indention px-3 fw-semibold fs-6"
             id="#kt_app_sidebar_menu"
             data-kt-menu="true"
             data-kt-menu-expand="false">

            @php
                $menu = config('menu.main');
            @endphp

            @foreach ($menu as $item)
                @if (array_key_exists('children', $item)))
                    {{-- begin:Menu accordion --}}
                    <x-menu.main.menu-accordion
                        :isActive="request()->routeIs($item['route'] . '.*')"
                        icon="{!! getIcon('abstract-' . rand(10, 50), 'fs-2') !!}"
                        title="{{ __('menus.main.' . $item['key'] . '.title') }}">

                        @foreach ($item['children'] as $subitem)
                            {{-- begin:Menu item --}}
                            <x-menu.main.menu-item
                                :isActive="request()->routeIs($subitem['route'])"
                                route="{{ route($subitem['route']) }}"
                                title="{{ __('menus.main.' . $item['key'] . '.' . $subitem['key']) }}"
                                icon="{!! getIcon('bullet-dot', 'fs-2') !!}" />
                            {{-- end:Menu item --}}
                        @endforeach

                    </x-menu.main.menu-accordion>
                    {{-- end:Menu accordion --}}
                @else
                    {{-- Seção única, caso necessário (opcional para outras entradas) --}}
                    <x-menu.main.menu-item
                        :isActive="request()->routeIs($item['route'])"
                        route="{{ route($item['route']) }}"
                        title="{{ __('menus.main.' . $item['key']) }}"
                        icon="{!! getIcon('menu', 'fs-2') !!}" />
                @endif
            @endforeach

            {{-- Static sections --}}
            <x-menu.main.menu-section-heading title="Help" />
            <x-menu.main.menu-item
                :isActive="false"
                route="https://preview.keenthemes.com/html/metronic/docs"
                title="Documentation"
                icon="{!! getIcon('abstract-26', 'fs-2') !!}" />
        </div>
        {{-- end::Menu --}}
    </div>
    {{-- end::Menu wrapper --}}
</div>
{{-- end::sidebar menu --}}
