<?php

namespace App\Http\Livewire\Admin\Dashboard;

use Livewire\Component;
use App\Models\Customer;

class CustomerCount extends Component
{
    public $customerCount;

    public function mount()
    {
        $this->customerCount = Customer::count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.customer-count');
    }
}
