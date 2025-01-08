<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class OrderStatus extends AdminComponent
{
    public $status = 'Cooking';
    public $sortColumnName = 'created_at';
    public $sortDirection = 'asc';

    public function setStatus1(Order $order)
    {
        Validator::make(['status' => 'Pick-up'], [
            'status' => 'required',
        ]);

        $order->update(['status' => 'Pick-up']);
        $this->dispatchBrowserEvent('updated', ['message' => "Chefs assigned successfully."]);
        $this->emitSelf('refresh-me');
    }

    public function filterOrder($status = null)
    {
        $this->status = $status;
    }
    
    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }

    public function render()
    {
        $customer = Order::with('customer')->get();
        $product = Product::all();
        $orders = Order::when($this->status, function ($query, $status) {
                return $query->where('status', $status);
            })->whereDay('created_at', Carbon::today())
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->paginate(10);
        $CookingOrder = Order::where('status', 'Cooking')->whereDay('created_at', Carbon::today())->count();
        $CookedOrder = Order::where('status', 'Cooked')->whereDay('created_at', Carbon::today())->count();
        $PickupOrder = Order::where('status', 'Pick-up')->whereDay('created_at', Carbon::today())->count();
        $CancelOrder = Order::where('status', 'Cancel')->whereDay('created_at', Carbon::today())->count();
        $totals = Order::latest()->orderBy($this->sortColumnName, $this->sortDirection)->paginate(10);
        $yesterdays = Order::latest()->whereDay('created_at', Carbon::yesterday())->orderBy($this->sortColumnName, $this->sortDirection)->paginate(10);
        $months = Order::latest()->whereMonth('created_at', Carbon::now()->month)->orderBy($this->sortColumnName, $this->sortDirection)->paginate(10);
        $years = Order::latest()->whereYear('created_at', Carbon::now()->year)->orderBy($this->sortColumnName, $this->sortDirection)->paginate(10);
        return view('livewire.admin.dashboard.order-status', [
            'orders' => $orders,
            'totals' => $totals,
            'yesterdays' => $yesterdays,
            'months' => $months,
            'years' => $years,
            'customer' => $customer,
            'product' => $product,
            'CookingOrder' => $CookingOrder,
            'CookedOrder' => $CookedOrder,
            'PickupOrder' => $PickupOrder,
            'CancelOrder' => $CancelOrder,
        ]);
    }
}
