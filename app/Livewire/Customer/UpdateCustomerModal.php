<?php

namespace App\Livewire\Customer;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\DB;

class UpdateCustomerModal extends Component
{
    public $customer_id;
    public $name;
    public $email;
    public $registry_code;
    public $code;
    public $notes;
    public $address = [];
    public $phones = [];

    protected array $rules = [
        'name' => 'required|string|max:255',
        'email' => 'required|email|max:255',
        'registry_code' => 'nullable|string|max:255',
        'code' => 'nullable|string|max:255',
        'notes' => 'nullable|string',
        'address.street' => 'nullable|string|max:255',
        'address.number' => 'nullable|string|max:255',
        'address.city' => 'nullable|string|max:255',
        'address.state' => 'nullable|string|max:255',
        'phones.*.number' => 'required|string|max:20',
    ];

    protected $listeners = ['modal.show.edit_customer' => 'loadCustomer'];

    public function render(): View|Factory|Application
    {
        return view('livewire.customers.update-customer-modal');
    }

    public function loadCustomer($customer_id): void
    {
        $customer = Customer::with(['address', 'phones'])->find($customer_id);

        if (!$customer) {
            $this->dispatch('error', 'Customer not found.');
            return;
        }

        $this->customer_id = $customer->id;
        $this->name = $customer->name;
        $this->email = $customer->email;
        $this->registry_code = $customer->registry_code;
        $this->code = $customer->code;
        $this->notes = $customer->notes;
        $this->address = $customer->address ? $customer->address->toArray() : [];
        $this->phones = $customer->phones->toArray();
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $customer = Customer::find($this->customer_id);

            if (!$customer) {
                $this->dispatch('error', 'Customer not found.');
                return;
            }

            $customer->update([
                'name' => $this->name,
                'email' => $this->email,
                'registry_code' => $this->registry_code,
                'code' => $this->code,
                'notes' => $this->notes,
            ]);

            if (!empty($this->address)) {
                $customer->address()->updateOrCreate([], $this->address);
            }

            $customer->phones()->delete();
            foreach ($this->phones as $phone) {
                $customer->phones()->create($phone);
            }
        });

        $this->dispatch('success', 'Customer updated successfully.');
        $this->emit('refreshCustomers');
    }

    public function addPhone(): void
    {
        $this->phones[] = ['number' => ''];
    }

    public function removePhone($index): void
    {
        unset($this->phones[$index]);
        $this->phones = array_values($this->phones);
    }

    public function hydrate(): void
    {
        $this->resetErrorBag();
        $this->resetValidation();
    }
}
