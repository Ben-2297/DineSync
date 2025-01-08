<?php

namespace App\Http\Livewire\Chef\Dashboard;

use App\Models\Chef;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use App\Http\Livewire\Chef\ChefComponent;
use Illuminate\Support\Facades\Validator;

class ChefDashboard extends ChefComponent
{
    public $status = 'Cancel';
    public $sortColumnName = 'created_at';
    public $sortDirection = 'asc';
    protected $listeners = ['refresh-me' => '$refresh'];

    public function setStatus1(Order $order)
    {
        Validator::make(['status' => 'Cooking'], [
            'status' => 'required',
        ]);

        
        $order->update(['status' => 'Cooking']);
        $begin = $order->updated_at->format('H:i:s');
        $order->update(['begin' => $begin]);
        $this->dispatchBrowserEvent('updated', ['message' => "Order status update successfully."]);
        $this->emitSelf('refresh-me');
    }

    public function setStatus2(Order $order)
    {
        Validator::make(['status' => 'Cooked'], [
            'status' => 'required',
        ]);

        $order->update(['status' => 'Cooked']);
        $end = $order->updated_at->format('H:i:s');
        $order->update(['end' => $end]);

        $start = $order->begin;
        $finish = $order->end;
        $t1 = strtotime($start);
        $t2 = strtotime($finish);
        $diff = gmdate('H:i', $t2 - $t1);
        $order->update(['timeframe' => $diff]);
        $this->dispatchBrowserEvent('updated', ['message' => "Order status update successfully."]);
        $this->emitSelf('refresh-me');
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

    public function filterOrder($status = null)
    {
        $this->status = $status;
    }

    public function render()
    {
        $chefID = Chef::where('chef_id', auth()->user()->id)->value('id');
        $customer = Order::with('customer')->get();
        $product = Product::all(); 
        $orders = Order::query()
            ->whereIn('status', ['Assigned', 'Cooking', 'Cooked'])
            ->where('chef_id', $chefID)
            ->orderBy($this->sortColumnName, $this->sortDirection)
            ->whereDay('created_at', Carbon::today())
            ->paginate(10);
        $today = Order::when($this->status, function ($query, $status) {
            return $query->where('status', $status);
        })->where('chef_id', Auth::user()->id)->whereDay('created_at', Carbon::today())->orderBy('created_at', 'desc')->paginate(5);
        $PickupOrder = Order::where('status', 'Pick-up')->where('chef_id', $chefID)->whereDay('created_at', Carbon::today())->count();
        $CancelOrder = Order::where('status', 'Cancel')->where('chef_id', $chefID)->whereDay('created_at', Carbon::today())->count();

        return view('livewire.chef.dashboard.chef-dashboard', [
            'orders' => $orders,
            'customer' => $customer,
            'product' => $product,
            'today' => $today,
            'PickupOrder' => $PickupOrder,
            'CancelOrder' => $CancelOrder,
        ])->layout('layouts.chef');
    }
}