<?php

namespace App\Http\Livewire\Homepage;

use App\Models\User;
use Livewire\Component;

class TeamSection extends Component
{
    public function render()
    {
        $chefs = User::where('role', User::ROLE_CHEF)->get();
        return view('livewire.homepage.team-section', ['chefs' => $chefs]);
    }
}
