<?php

namespace App\Http\Services;

use App\Helpers\VindiApi;
use App\Http\DTOs\AddressDTO;
use App\Http\DTOs\CustomerDTO;
use App\Http\DTOs\PhoneDTO;
use App\Http\Interfaces\StoreRequestInterface;
use App\Http\Interfaces\UpdateRequestInterface;
use App\Http\Repositories\CustomerRepository;
use App\Http\Requests\Customer\CustomerStoreRequest;
use App\Http\Requests\Customer\CustomerUpdateRequest;
use App\Jobs\Customer\CustomerStoreJob;
use App\Jobs\Customer\CustomerUpdateJob;
use App\Jobs\Customer\CustomerDeleteJob;
use App\Jobs\Customer\CustomerUnarchiveJob;
use App\Models\Address;
use App\Models\Customer;
use App\Models\Phone;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;
use Vindi\Customer as VindiCustomer;

final class CustomerService
{
    private readonly VindiCustomer $vindiService;

    public function __construct(private readonly CustomerRepository $repository)
    {
        $this->vindiService = new VindiCustomer(VindiApi::config());
    }

    // direct functions
    public function _store(StoreRequestInterface $request): JsonResponse
    {
        return $this->vindiService->create($request->all());
    }

    public function _update(UpdateRequestInterface $request, int $id): JsonResponse
    {
        return $this->vindiService->update($id, $request->all());
    }

    public function _destroy($id, ?array $queryParams = []): JsonResponse
    {
        return $this->vindiService->delete($id, $queryParams);
    }

    public function _unarchive($id): JsonResponse
    {
        return $this->vindiService->unarchive($id);
    }

    // stored info functions
    public function store(CustomerStoreRequest $request): Customer
    {
        try {
            DB::beginTransaction();

            $address = Address::create((AddressDTO::fromArray($request->getAddressFields()))->toArray());
            $request->merge(['address_id' => $address->id]);
            $new = Customer::create((CustomerDTO::fromRequest($request))->toArray());

            foreach ($request->getPhoneFields() as $phone) {
                $phone['consumer_id'] = $new->id;
                Phone::create((PhoneDTO::fromArray($phone))->toArray());
            }

            DB::commit();

            (new CustomerStoreJob($new))->handle();

            return $new;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function update(CustomerUpdateRequest $request, mixed $id): Customer
    {
        try {
            DB::beginTransaction();

            $customer = $this->repository->find($id);
            if (! empty($request->getAddressFields())) {
                $customer->address->destroy();
                $address = Address::create((AddressDTO::fromArray($request->getAddressFields()))->toArray());
                $request->merge(['address_id' => $address->id]);
            }

            if (! empty($request->getPhoneFields())) {
                foreach ($customer->phones as $phone) {
                    $phone->delete();
                }

                foreach ($request->getPhoneFields() as $phone) {
                    $phone['consumer_id'] = $customer->id;
                    Phone::create((PhoneDTO::fromArray($phone))->toArray());
                }
            }

            $customerDTO = CustomerDTO::fromRequest($request);
            $customer->update($customerDTO->toArray());

            DB::commit();

            (new CustomerUpdateJob($customer))->handle();

            return $customer;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function delete(mixed $id): JsonResponse
    {
        try {
            DB::beginTransaction();

            $customer = $this->repository->find($id);
            $external_id = $customer->external_id;
            $customer->delete();

            DB::commit();

            (new CustomerDeleteJob($external_id))->handle();

            return response()->json([], 200);
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

    public function unarchive(mixed $id): Customer
    {
        try {
            DB::beginTransaction();

            $customer = $this->repository->find($id);
            $customer->restore();

            DB::commit();

            (new CustomerUnarchiveJob($customer))->handle();

            return $customer;
        } catch (Exception $e) {
            DB::rollback();

            return response()->json(['error' => $e->getMessage()], 500);
        }
    }
}
