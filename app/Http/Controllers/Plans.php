<?php

namespace App\Http\Controllers;

use App\Http\Controllers\API\Plans as APIPlans;
use App\Http\Requests\Plan\PlanStoreRequest;
use App\Http\Requests\Plan\PlanUpdateRequest;
use App\Models\Customer;
use Illuminate\Support\Facades\Log;
use Illuminate\View\View;

/**
 * Controller for managing plan resources.
 *
 * This controller integrates with the APIPlans service to handle
 * operations related to plans, such as listing, displaying, creating,
 * updating, and managing plan items. It ensures a clear separation
 * between API logic and view rendering.
 */
final class Plans extends Controller
{
    /**
     * The APIPlans service instance.
     */
    private readonly APIPlans $api;

    /**
     * Constructor for the Plans controller.
     *
     * @param  APIPlans  $api  The API service for managing plans.
     */
    public function __construct(APIPlans $api)
    {
        $this->api = $api;
    }

    /**
     * Display a listing of the plans.
     *
     * @param  mixed|null  $queryParams  Optional query parameters for filtering or sorting.
     * @return View The view displaying the list of plans.
     */
    public function index(mixed $queryParams = null): View
    {
        $data = $this->api->index($queryParams);

        return View('customers.index', compact('data'));
    }

    /**
     * Display the specified plan details.
     *
     * @param  string  $code  The unique code of the plan to display.
     * @return View The view displaying the plan details.
     */
    public function show(string $code): View
    {
        $data = $this->api->show($code);

        return View('customers.index', compact('data'));
    }

    public function store(PlanStoreRequest $request): View
    /**
     * Store a newly created plan.
     *
     * @param  PlanStoreRequest  $request  The validated request containing plan data.
     * @return View The view displaying the created plan details or a generic error page.
     */
    public function store(PlanStoreRequest $request): View
    {
        if ($data = $this->api->store($request)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        // Log the error and return a generic error view
        Log::error('Failed to create the plan. API store method returned null.');

        return View('errors.generic', [
            'message' => 'An error occurred while creating the plan. Please try again later.',
        ]);
    }

    /**
     * Update the specified plan.
     *
     * @param  PlanUpdateRequest  $request  The validated request containing updated plan data.
     * @param  string  $code  The unique code of the plan to update.
     * @return View The view displaying the updated plan details or a generic error page.
     */
    public function update(PlanUpdateRequest $request, string $code): View
    {
        if ($data = $this->api->update($request, $code)) {
            /** @var Customer $data */
            return $this->show($data->code);
        }

        // Log the error and return a generic error view
        Log::error('Failed to update the plan. API update method returned null.');

        return View('errors.generic', [
            'message' => 'An error occurred while updating the plan. Please try again later.',
        ]);
    }

    /**
     * Manage the items for the specified plan.
     *
     * @param  string  $code  The unique code of the plan whose items need to be managed.
     * @return View The view displaying the plan items or a generic error page.
     */
    public function planItems(string $code): View
    {
        if ($this->api->plan_items($code)) {
            return $this->show($code);
        }

        // Log the error and return a generic error view
        Log::error('Failed to manage items for the plan. API plan_items method returned null.');

        return View('errors.generic', [
            'message' => 'An error occurred while managing the plan items. Please try again later.',
        ]);
    }
}
