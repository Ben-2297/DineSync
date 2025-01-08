<?php

namespace App\Http\Livewire\Admin\Products;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Validator;

class CreateProductsForm extends Component
{
    use WithFileUploads;

    public $photo;

    public $state = [
        'type' => 'pcs',
        'category' => 'pork',
        'status' => 'Available',
    ];

    public function createProduct()
    {
        $validateData = Validator::make($this->state, [
            'title' => 'required',
            'price'=> 'required',
            'type'=> 'required',
            'category'=> 'required',
            'description' => 'nullable',
            'status' => 'required',
        ])->validate();

        if ($this->photo) {
            $validateData['photo'] = $this->photo->store('/', 'photo');
        }
        Product::create($validateData); 
        
        $this->dispatchBrowserEvent('hide-form', ['message' => 'Product created successfully']);
        $this->state = [
            'type' => 'pcs',
            'category' => 'pork',
            'status' => 'Available',
        ];
        $this->photo = null;
    }

    public function render()
    {
        return view('livewire.admin.products.create-products-form')->layout('layouts.admin');
    }
}
