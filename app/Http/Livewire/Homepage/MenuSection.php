<?php

namespace App\Http\Livewire\Homepage;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Illuminate\Support\Facades\Validator;

class MenuSection extends Component
{
    public $category = 'specialty';

    public function addtoCart(int $productId)
    {
        $customer = Customer::where('customer_id', auth()->user()->id)->value('id');
        if(Cart::where('customer_id', $customer)->where('product_id', $productId)->exists()) {
            $cart = Cart::where('product_id', $productId);
            $cart->delete();
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Successfully Remove!',
                'text' => ''
            ]);
        }
        else {
            Validator::make(['customer_id' => $customer, 'product_id' => $productId], [
                'customer_id' => 'required',
                'product_id' => 'required',
            ]);
            Cart::create(['customer_id' => $customer, 'product_id' => $productId]);
            $this->dispatchBrowserEvent('swal:modal', [
                'type' => 'success',
                'title' => 'Successfully Added!',
                'text' => ''
            ]);
        }
    }

    public function filterMenu($category = null)
    {
        $this->category = $category;
    }

    public function render()
    {
        $products = Product::when($this->category, function ($query, $category) {
            return $query->where('category', $category);
        })->where('status', 'available')->orderBy('id', 'desc')->get();
        return view('livewire.homepage.menu-section', ['products' => $products]);
    }
}
