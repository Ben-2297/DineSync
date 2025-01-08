<?php

namespace App\Http\Livewire\Homepage;

use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Carbon;

class OrderSection extends Component
{
    use WithPagination;
    
    public function render()
    {
        $customer = Customer::where('customer_id', auth()->user()->id)->value('id');
        $orders = Order::query()
            ->whereIn('status', ['Assigned', 'Cooking', 'Cooked'])
            ->where('customer_id', $customer)
            ->whereDay('created_at', Carbon::today('America/Chicago'))
            ->orderBy('created_at', 'asc')->paginate(0);
        $chef = Order::with('chef')->get();
        $product = Product::all();
        return view('livewire.homepage.order-section', ['chef' => $chef, 'orders' => $orders, 'product' => $product]);
    }
}
