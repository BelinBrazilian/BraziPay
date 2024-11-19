<?php

namespace App\Http\Services;

use App\Http\Repositories\ProductRepository;

/**
 * Service layer for managing product-related business logic.
 *
 * This service class handles the business logic for product-related
 * operations, acting as an intermediary between the controller and
 * the repository. It encapsulates complex operations and makes the
 * controller code cleaner and easier to maintain.
 *
 * @package App\Http\Services
 */
class ProductService
{
    /**
     * ProductService constructor.
     *
     * @param ProductRepository $repository The repository instance used to access product data.
     */
    public function __construct(private readonly ProductRepository $repository) {}
}
