<?php

namespace App\Http\Livewire\Admin\Orders;

use App\Models\Chef;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class ListOrders extends AdminComponent
{
    public $status = 'New';

    public function filterOrder($status = null)
    {
        $this->status = $status;
    }

    public function setChef(Order $order, $chef_Id)
    {
        Validator::make(['status' => 'Assigned', 'chef_id' => $chef_Id], [
            'status' => 'required',
            'chefs_Id' => 'required',
        ]);

        $order->update(['status' => 'Assigned', 'chef_id' => $chef_Id]);
        $this->dispatchBrowserEvent('updated', ['message' => "Chefs assigned successfully."]);
    }
    
    public function render()
    {
        $users = Chef::all();
        $customer = Order::with('customer')->get();
        $product = Product::all();
        $orders = Order::when($this->status, function ($query, $status) {
            return $query->where('status', $status);
        })->latest()->paginate(10);
        $newOrder = Order::where('status', 'New')->count();
        $AssignedOrder = Order::where('status', 'Assigned')->count();

        return view('livewire.admin.orders.list-orders', [
            'orders' => $orders,
            'customer' => $customer,
            'product' => $product,
            'users' => $users,
            'newOrder' => $newOrder,
            'AssignedOrder' => $AssignedOrder
        ])->layout('layouts.admin');
    }
}
