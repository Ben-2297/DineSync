<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class ListProducts extends AdminComponent
{
    public $state = [];
    public $productIdBeingRemoved = null;
    public $searchTerm = null;
    public $photo;
    public $status = null;
    public $selectedRows = [];
    public $selectPageRows = false;
    public $selectedProductId;

    public function edit(int $product_id)
    {
        $this->selectedProductId = $product_id;
        $this->state = Product::findOrFail($product_id)->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateProduct()
    {
        $validateData = Validator::make($this->state, [
            'title'=> 'required',
            'price'=> 'required',
            'description' => 'nullable',
            'status' => 'required',
        ])->validate();

        Product::findOrFail($this->selectedProductId)->update($validateData);
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Product created successfully']);
    }

    public function confirmProductRemoval($productId)
    {
        $this->productIdBeingRemoved = $productId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteProduct()
    {
        $products = Product::findOrFail($this->productIdBeingRemoved);
        if (!empty($products->photo)){
            Storage::disk('photo')->delete($products->photo);
        }
        $products->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'Product deleted successfully!']);
    }

    public function filterProduct($status = null)
    {
        $this->status = $status;
    }

    public function updatedSelectPageRows($value)
    {
        if ($value) {
            $this->selectedRows = $this->products->pluck('id')->map(function ($id) {
                return (string) $id;
            });
        } else {
            $this->reset(['selectedRows', 'selectPageRows']);
        }
    }

    public function getProductsProperty()
    {
        return Product::when($this->status, function ($query, $status) {
            return $query->where('status', $status);
        })
        ->latest()->paginate(10);
    }

    public function deleteSelectedRows()
    {
        $productArray = Product::whereIn('id', $this->selectedRows);
        $photos = Product::whereIn('id', $this->selectedRows)->pluck('photo');
        foreach ($photos as $photos) {
            if (!empty($photos)){
                Storage::disk('photo')->delete($photos);
            }
        }
        $productArray->delete();
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'All selected products got deleted.']);
		$this->reset(['selectPageRows', 'selectedRows']);
    }

    public function markAllAsAvailable()
	{
		Product::whereIn('id', $this->selectedRows)->update(['status' => 'Available']);
		$this->dispatchBrowserEvent('updated', ['message' => 'Productss marked as available']);
		$this->reset(['selectPageRows', 'selectedRows']);
	}

	public function markAllAsUnavailable()
	{
		Product::whereIn('id', $this->selectedRows)->update(['status' => 'Unavailable']);
		$this->dispatchBrowserEvent('updated', ['message' => 'Productss marked as unavailable.']);
		$this->reset(['selectPageRows', 'selectedRows']);
	}

    public function render()
    {
        $products = $this->products;

        $ProductsCount = Product::count();
    	$AvailableProductsCount = Product::where('status', 'Available')->count();
    	$UnavailableProductsCount = Product::where('status', 'Unavailable')->count();
            
        return view('livewire.admin.products.list-products', [
            'products' => $products,
            'ProductsCount' => $ProductsCount,
            'AvailableProductsCount' => $AvailableProductsCount,
            'UnavailableProductsCount' => $UnavailableProductsCount
        ])->layout('layouts.admin');
    }
}
