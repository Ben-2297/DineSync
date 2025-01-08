<?php

namespace App\Http\Livewire\Chef\Settings;

use Illuminate\Support\Arr;
use App\Http\Livewire\Chef\ChefComponent;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;

class ChefSettings extends ChefComponent
{
    public $state = [];

    public function changePassword(UpdatesUserPasswords $updater)
    {
        $updater->update(
            auth()->user(),
            $attributes = Arr::only($this->state, ['current_password', 'password', 'password_confirmation'])
        );

        collect($attributes)->map(fn ($value, $key) => $this->state[$key] = '');
        $this->dispatchBrowserEvent('updated', ['message' => 'Password changed successfully!']);
    }
    
    public function render()
    {
        return view('livewire.chef.settings.chef-settings')->layout('layouts.chef');
    }
}
