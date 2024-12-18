<?php

namespace App\Livewire\Customer;

use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Foundation\Application;
use Livewire\Component;
use App\Models\Customer;
use App\Models\Address;
use App\Models\Phone;
use Illuminate\Support\Facades\DB;

class AddCustomerModal extends Component
{
    public $name;
    public $email;
    public $registry_code;
    public $code;
    public $notes;
    public $address = [];
    public $phones = [];

    protected $rules = [
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

    public function render(): View|Factory|Application
    {
        return view('livewire.customers.add-customer-modal');
    }

    public function resetFields(): void
    {
        $this->name = '';
        $this->email = '';
        $this->registry_code = '';
        $this->code = '';
        $this->notes = '';
        $this->address = [];
        $this->phones = [];
    }

    public function submit(): void
    {
        $this->validate();

        DB::transaction(function () {
            $customer = Customer::create([
                'name' => $this->name,
                'email' => $this->email,
                'registry_code' => $this->registry_code,
                'code' => $this->code,
                'notes' => $this->notes,
            ]);

            if (!empty($this->address)) {
                $customer->address()->create($this->address);
            }

            foreach ($this->phones as $phone) {
                $customer->phones()->create($phone);
            }
        });

        $this->dispatch('success', 'Customer added successfully.');
        $this->resetFields();
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
