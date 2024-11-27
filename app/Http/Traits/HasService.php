<?php

namespace App\Http\Traits;

/**
 * Trait HasService
 *
 * Provides utility methods to check for the presence of a `$service` property
 * and its corresponding methods in the consuming class.
 *
 * This trait expects the consuming class to define a `$service` property
 * that corresponds to a class instance.
 */
trait HasService
{
    /**
     * Check if the `$service` property is defined and not empty.
     *
     * @return bool True if `$service` is defined and not null.
     */
    public function _hasService(): bool
    {
        return ! empty($this->service);
    }

    /**
     * Check if the `$service` class has an `index` method.
     *
     * @return bool True if the `index` method exists.
     */
    public function _hasIndexFunction(): bool
    {
        return $this->_hasService() && method_exists($this->service, 'index');
    }

    /**
     * Check if the `$service` class has a `show` method.
     *
     * @return bool True if the `show` method exists.
     */
    public function _hasShowFunction(): bool
    {
        return $this->_hasService() && method_exists($this->service, 'show');
    }

    /**
     * Check if the `$service` class has a `store` method.
     *
     * @return bool True if the `store` method exists.
     */
    public function _hasStoreFunction(): bool
    {
        return $this->_hasService() && method_exists($this->service, 'store');
    }

    /**
     * Check if the `$service` class has an `update` method.
     *
     * @return bool True if the `update` method exists.
     */
    public function _hasUpdateFunction(): bool
    {
        return $this->_hasService() && method_exists($this->service, 'update');
    }

    /**
     * Check if the `$service` class has a `destroy` method.
     *
     * @return bool True if the `destroy` method exists.
     */
    public function _hasDestroyFunction(): bool
    {
        return $this->_hasService() && method_exists($this->service, 'destroy');
    }
}
