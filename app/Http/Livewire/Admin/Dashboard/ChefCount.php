<?php

namespace App\Http\Livewire\Admin\Dashboard;

use App\Models\Chef;
use Livewire\Component;

class ChefCount extends Component
{
    public $chefCount;

    public function mount()
    {
        $this->chefCount = Chef::count();
    }
    
    public function render()
    {
        return view('livewire.admin.dashboard.chef-count');
    }
}
