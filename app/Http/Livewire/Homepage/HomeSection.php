<?php

namespace App\Http\Livewire\Homepage;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithPagination;

class HomeSection extends Component
{
    use WithPagination;
    
    public function render()
    {
        $pro = Product::select('photo')->where('status', 'available')->orderBy('id', 'desc')->first();
             
        $products = Product::where('status', 'available')->orderBy('id', 'desc')->paginate(8);
        return view('livewire.homepage.home-section', ['products' => $products, 'pro' => $pro]);
    }
}
