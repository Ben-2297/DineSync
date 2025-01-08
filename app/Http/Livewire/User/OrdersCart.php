<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;
use App\Models\Customer;
use Livewire\WithPagination;
use Illuminate\Support\Facades\Validator;

class OrdersCart extends Component
{
    use WithPagination;

    public $quan = '1';
    public $prods_id;
    protected $listeners = ['refresh-me' => '$refresh'];

    public function newCart($prodid)
    {
        $this->prods_id = $prodid;

        if (empty(Customer::where('customer_id', auth()->user()->id)->value('address') && Customer::where('customer_id', auth()->user()->id)->value('mobile'))) {
            $this->dispatchBrowserEvent('swal:modal2', [
                'type' => 'warning',
                'title' => 'Please set your contact info!',
                'text' => ''
            ]);
        } else {
            $this->dispatchBrowserEvent('show-form');
            $this->emitSelf('refresh-me');
        }
    }

    public function newOrder($prodID)
    {
        $this->prods_id = $prodID;

        if (empty(Customer::where('customer_id', auth()->user()->id)->value('address') && Customer::where('customer_id', auth()->user()->id)->value('mobile'))) {
            $this->dispatchBrowserEvent('swal:modal2', [
                'type' => 'warning',
                'title' => 'Please set your contact info!',
                'text' => ''
            ]);
        } else {
            $this->dispatchBrowserEvent('show-form');
            $this->emitSelf('refresh-me');
        }
    }

    public function createOrder()
    {
        $price = Product::where('id', $this->prods_id)->value('price');
        $total = $price * $this->quan;
        $type = Product::where('id', $this->prods_id)->value('type');
        $customer = Customer::where('customer_id', auth()->user()->id)->value('id');
        $validateData = Validator::make([
            'quantity' => $this->quan,
            'type' => $type,
            'total' => $total,
            'status' => 'New',
            'customer_id' => $customer,
            'product_id' => $this->prods_id,
        ], [
            'quantity' => 'required',
            'type' => 'required',
            'total' => 'required',
            'status' => 'required',
            'customer_id' => 'required',
            'product_id' => 'required',
        ])->validate();
        
        Order::create($validateData);
        $this->dispatchBrowserEvent('hide-form', [
            'type' => 'success',
            'title' => 'Order has successfully placed!',
            'text' => ''
        ]);
    }

    public function removeCart($ordID)
    {
        $cart = Cart::findOrFail($ordID);
        $cart->delete();

        $this->dispatchBrowserEvent('swal:modal', [
            'type' => 'success',
            'title' => 'Successfully remove!',
            'text' => ''
        ]);
    }

    public function render()
    {
        $price = Product::where('id', $this->prods_id)->value('price');
        $name = Product::where('id', $this->prods_id)->value('title');
        $total = $price * $this->quan;
        $quantity = $this->quan;
        $type = Product::where('id', $this->prods_id)->value('type');
        $customer = Customer::where('customer_id', auth()->user()->id)->value('id');
        $orders = Order::where('customer_id', $customer)->orderBy('id', 'desc')->paginate(0);
        $carts = Cart::where('customer_id', $customer)->orderBy('id', 'desc')->paginate(0);
        $product = Cart::with('product')->get();
        $prods = Product::where('status', 'available')->orderBy('id', 'desc')->get();
        return view('livewire.user.orders-cart', ['product' => $product, 'type' => $type, 'quantity' => $quantity, 'name' => $name, 'total' => $total, 'carts' => $carts, 'prods' => $prods, 'orders' => $orders])->layout('layouts.order');
    }
}
