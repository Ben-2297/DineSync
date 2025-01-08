<?php

namespace App\Http\Livewire\Homepage;

use App\Models\Cart;
use Livewire\Component;
use App\Models\Customer;

class HomeNav extends Component
{
    public function render()
    {
        $customer = Customer::where('customer_id', auth()->user()->id)->value('id');
        $Count = Cart::where('customer_id',  $customer)->count();
        return view('livewire.homepage.home-nav', ['Count' => $Count]);
    }
}
