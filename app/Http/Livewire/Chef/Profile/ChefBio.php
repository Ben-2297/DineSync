<?php

namespace App\Http\Livewire\Chef\Profile;

use App\Models\Chef;
use Livewire\WithFileUploads;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Http\Livewire\Chef\ChefComponent;
use Illuminate\Support\Facades\Validator;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class ChefBio extends ChefComponent
{
    use WithFileUploads;
    
    public $image;
    public $state = [];
    public $address;
    public $mobile;
    public $bio;

    public function mount()
    {
        $this->state = Auth::user()->only(['fname', 'lname', 'email']);
        $this->address = Chef::where('chef_id', auth()->user()->id)->value('address');
        $this->mobile = Chef::where('chef_id', auth()->user()->id)->value('mobile');
        $this->bio = Chef::where('chef_id', auth()->user()->id)->value('bio');
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
        Chef::where('chef_id', auth()->user()->id)->update([
            'fname' => $this->state['fname'],
            'lname' => $this->state['lname'],
        ]);

        $this->emit('nameChanged', auth()->user()->fname, auth()->user()->lname);
        $this->dispatchBrowserEvent('updated', ['message' => 'Profile updated successfully!']);
    }

    public function updateInfo()
    {
        $validateData = Validator::make(['address' => $this->address, 'mobile' => $this->mobile, 'bio' => $this->bio], [
            'address' => 'required',
            'mobile' => 'required',
            'bio' => 'sometimes|nullable'
        ])->validate();

        Chef::where('chef_id', auth()->user()->id)->update($validateData);
        $this->dispatchBrowserEvent('updated', ['message' => 'Profile updated successfully!']);
    }

    public function render() 
    {
        return view('livewire.chef.profile.chef-bio')->layout('layouts.chef');
    }
}