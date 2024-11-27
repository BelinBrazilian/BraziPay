<?php

if (! function_exists('theme')) {
    function theme()
    {
        return app(App\Core\Theme::class);
    }
}

if (! function_exists('getName')) {
    /**
     * Get product name
     */
    function getName(): string
    {
        return config('settings.KT_THEME');
    }
}

if (! function_exists('addHtmlAttribute')) {
    /**
     * Add HTML attributes by scope
     */
    function addHtmlAttribute($scope, $name, $value): void
    {
        theme()->addHtmlAttribute($scope, $name, $value);
    }
}

if (! function_exists('addHtmlAttributes')) {
    /**
     * Add multiple HTML attributes by scope
     */
    function addHtmlAttributes($scope, $attributes): void
    {
        theme()->addHtmlAttributes($scope, $attributes);
    }
}

if (! function_exists('addHtmlClass')) {
    /**
     * Add HTML class by scope
     */
    function addHtmlClass($scope, $value): void
    {
        theme()->addHtmlClass($scope, $value);
    }
}

if (! function_exists('printHtmlAttributes')) {
    /**
     * Print HTML attributes for the HTML template
     */
    function printHtmlAttributes($scope): string
    {
        return theme()->printHtmlAttributes($scope);
    }
}

if (! function_exists('printHtmlClasses')) {
    /**
     * Print HTML classes for the HTML template
     */
    function printHtmlClasses($scope, bool $full = true): string
    {
        return theme()->printHtmlClasses($scope, $full);
    }
}

if (! function_exists('getSvgIcon')) {
    /**
     * Get SVG icon content
     */
    function getSvgIcon($path, string $classNames = 'svg-icon', string $folder = 'assets/media/icons/'): string
    {
        return theme()->getSvgIcon($path, $classNames, $folder);
    }
}

if (! function_exists('setModeSwitch')) {
    /**
     * Set dark mode enabled status
     */
    function setModeSwitch($flag): void
    {
        theme()->setModeSwitch($flag);
    }
}

if (! function_exists('isModeSwitchEnabled')) {
    /**
     * Check dark mode status
     */
    function isModeSwitchEnabled(): bool
    {
        return theme()->isModeSwitchEnabled();
    }
}

if (! function_exists('setModeDefault')) {
    /**
     * Set the mode to dark or light
     */
    function setModeDefault($mode): void
    {
        theme()->setModeDefault($mode);
    }
}

if (! function_exists('getModeDefault')) {
    /**
     * Get current mode
     */
    function getModeDefault(): string
    {
        return theme()->getModeDefault();
    }
}

if (! function_exists('setDirection')) {
    /**
     * Set style direction
     */
    function setDirection($direction): void
    {
        theme()->setDirection($direction);
    }
}

if (! function_exists('getDirection')) {
    /**
     * Get style direction
     */
    function getDirection(): string
    {
        return theme()->getDirection();
    }
}

if (! function_exists('isRtlDirection')) {
    /**
     * Check if style direction is RTL
     */
    function isRtlDirection(): bool
    {
        return theme()->isRtlDirection();
    }
}

if (! function_exists('extendCssFilename')) {
    /**
     * Extend CSS file name with RTL or dark mode
     */
    function extendCssFilename($path): string
    {
        return theme()->extendCssFilename($path);
    }
}

if (! function_exists('includeFavicon')) {
    /**
     * Include favicon from settings
     */
    function includeFavicon(): string
    {
        return theme()->includeFavicon();
    }
}

if (! function_exists('includeFonts')) {
    /**
     * Include the fonts from settings
     */
    function includeFonts(): string
    {
        return theme()->includeFonts();
    }
}

if (! function_exists('getGlobalAssets')) {
    /**
     * Get the global assets
     */
    function getGlobalAssets(string $type = 'js'): array
    {
        return theme()->getGlobalAssets($type);
    }
}

if (! function_exists('addVendors')) {
    /**
     * Add multiple vendors to the page by name. Refer to settings KT_THEME_VENDORS
     */
    function addVendors($vendors): void
    {
        theme()->addVendors($vendors);
    }
}

if (! function_exists('addVendor')) {
    /**
     * Add single vendor to the page by name. Refer to settings KT_THEME_VENDORS
     */
    function addVendor($vendor): void
    {
        theme()->addVendor($vendor);
    }
}

if (! function_exists('addJavascriptFile')) {
    /**
     * Add custom javascript file to the page
     */
    function addJavascriptFile($file): void
    {
        theme()->addJavascriptFile($file);
    }
}

if (! function_exists('addCssFile')) {
    /**
     * Add custom CSS file to the page
     */
    function addCssFile($file): void
    {
        theme()->addCssFile($file);
    }
}

if (! function_exists('getVendors')) {
    /**
     * Get vendor files from settings. Refer to settings KT_THEME_VENDORS
     */
    function getVendors($type): array
    {
        return theme()->getVendors($type);
    }
}

if (! function_exists('getCustomJs')) {
    /**
     * Get custom js files from the settings
     */
    function getCustomJs(): array
    {
        return theme()->getCustomJs();
    }
}

if (! function_exists('getCustomCss')) {
    /**
     * Get custom css files from the settings
     */
    function getCustomCss(): array
    {
        return theme()->getCustomCss();
    }
}

if (! function_exists('getHtmlAttribute')) {
    /**
     * Get HTML attribute based on the scope
     */
    function getHtmlAttribute($scope, $attribute): array
    {
        return theme()->getHtmlAttribute($scope, $attribute);
    }
}

if (! function_exists('isUrl')) {
    /**
     * Get HTML attribute based on the scope
     */
    function isUrl($url): mixed
    {
        return filter_var($url, FILTER_VALIDATE_URL);
    }
}

if (! function_exists('image')) {
    /**
     * Get image url by path
     */
    function image($path): string
    {
        return asset('assets/media/'.$path);
    }
}

if (! function_exists('getIcon')) {
    /**
     * Get icon
     */
    function getIcon($name, string $class = '', string $type = '', string $tag = 'span'): string
    {
        return theme()->getIcon($name, $class, $type, $tag);
    }
}
