<?php

namespace App\Http\Livewire\Chef;

use Livewire\Component;
use Livewire\WithPagination;

class ChefComponent extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';
}