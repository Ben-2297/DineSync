<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Order;
use Livewire\Component;
use Illuminate\Support\Carbon;

class OrderCount extends Component
{
    public $orderCount;

    public function mount()
    {
        $this->getOrderCount();
    }

    public function getOrderCount($status = null)
    {
        $this->orderCount = Order::query()
            ->when($status, function ($query, $status){
                return $query->where('status', $status);
            })
            ->whereDay('created_at', Carbon::today())
            ->get()->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.order-count');
    }
}
