<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Product;
use Livewire\Component;

class ProductCount extends Component
{
    public $productCount;

    public function mount()
    {
        $this->getproductCount();
    }

    public function getproductCount($status = null)
    {
        $this->productCount = Product::query()
            ->when($status, function ($query, $status){
                return $query->where('status', $status);
            })
            ->count();
    }

    public function render()
    {
        return view('livewire.admin.dashboard.product-count');
    }
}
