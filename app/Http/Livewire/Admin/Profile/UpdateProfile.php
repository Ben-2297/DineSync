<?php

namespace App\Http\Livewire\Admin\Profile;

use App\Models\Admin;
use Livewire\Component;
use Illuminate\Support\Arr;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Laravel\Fortify\Contracts\UpdatesUserPasswords;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateProfile extends Component
{
    use WithFileUploads;
    
    public $image;
    public $state = [];

    public function mount()
    {
        $this->state = Auth::user()->only(['fname', 'lname', 'email']);
    }
    
    public function updatedImage()
    {
        $previousPath = auth()->user()->avatar;
        $path = $this->image->store('/', 'avatars');
        Auth::user()->update(['avatar' => $path]);
        if (!empty($previousPath)){
            Storage::disk('avatars')->delete($previousPath);
        }
        $this->dispatchBrowserEvent('updated', ['message' => 'Profile changed successfully!']);
    }

    public function updateProfile(UpdatesUserProfileInformation $updater)
    {
        $updater->update(auth()->user(), [
            'fname' => $this->state['fname'],
            'lname' => $this->state['lname'],
            'email' => $this->state['email'],
        ]);
        Admin::where('admin_id', auth()->user()->id)->update([
            'fname' => $this->state['fname'],
            'lname' => $this->state['lname'],
        ]);

        $this->emit('nameChanged', auth()->user()->fname, auth()->user()->lname);
        $this->dispatchBrowserEvent('updated', ['message' => 'Profile updated successfully!']);
    }

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
        return view('livewire.admin.profile.update-profile')->layout('layouts.admin');
    }
}
