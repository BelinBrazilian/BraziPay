<?php

namespace App\Http\Repositories;

use App\Models\Product;

/**
 * Repository for handling product data interactions.
 *
 * This repository provides an abstraction layer for data access,
 * allowing for CRUD operations and other interactions with the
 * `Product` model. It inherits shared functionality from the base
 * `Repository` class.
 */
class ProductRepository extends Repository
{
    /**
     * ProductRepository constructor.
     *
     * Initializes the repository with the `Product` model, enabling
     * data operations specific to products. The `$modelClass` is
     * set to `Product::class`, which is utilized by the parent
     * `Repository` class for model-specific actions.
     */
    public function __construct()
    {
        $this->modelClass = Product::class;
        parent::__construct();
    }
}
