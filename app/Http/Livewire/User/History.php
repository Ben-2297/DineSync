<?php

namespace App\Http\Livewire\User;

use App\Models\Order;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class History extends Component
{
    public function cancelOrder($orderID)
    {
        $order = Order::findOrFail($orderID);
        Validator::make(['status' => 'Cancel'], [
            'status' => 'required',
        ]);

        $order->update(['status' => 'Cancel']);

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Order has been cancel!',
            'text' => ''
        ]);
    }

    public function render()
    {
        $customer = Customer::where('customer_id', auth()->user()->id)->value('id');
        $orders = Order::where('customer_id', $customer)->orderBy('id', 'desc')->paginate(0);
        return view('livewire.user.history', ['orders' => $orders])->layout('layouts.order');
    }
}
