<?php

namespace App\Http\Livewire\Admin\Users;

use App\Models\Chef;
use App\Models\User;
use App\Models\Admin;
use App\Models\Customer;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Validator;
use App\Http\Livewire\Admin\AdminComponent;

class ListUsers extends AdminComponent
{
    public $state = [];
    public $user;
    public $showEditModal = false;
    public $userIdBeingRemoved = null;
    public $searchTerm = null;
    public $sortColumnName = 'created_at';
    public $sortDirection = 'desc';
    
    protected $queryString = ['searchTerm' => ['except' => '']];

    public function changeRole(User $user, $role)
    {
        Validator::make(['role' => $role], [
            'role' => ['required', Rule::in(User::ROLE_ADMIN, User::ROLE_CHEF, User::ROLE_USER)],
            'role' => 'required|in:admin,chef,user',
        ]);

        $user->update(['role' => $role]);
        $userID = $user->id;
        $this->state = User::findOrFail($userID)->toArray();
        if($this->state['role'] === 'admin'){
            Customer::where('customer_id', $userID)->delete();
            Chef::where('chef_id', $userID)->delete();
            Validator::make([
                'admin_id' => $this->state['id'],
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname']], [
                'admin_id' => 'required',
                'fname' => 'required',
                'lname' => 'required',
            ]);
            Admin::create(['admin_id' => $this->state['id'], 'fname' => $this->state['fname'], 'lname' => $this->state['lname']]);
        } elseif ($this->state['role'] === 'chef'){
            Customer::where('customer_id', $userID)->delete();
            Admin::where('admin_id', $userID)->delete();
            Validator::make([
                'chef_id' => $this->state['id'],
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname']], [
                'admin_id' => 'required',
                'fname' => 'required',
                'lname' => 'required',
            ]);
            Chef::create(['chef_id' => $this->state['id'], 'fname' => $this->state['fname'], 'lname' => $this->state['lname']]);
        } else {
            Chef::where('chef_id', $userID)->delete();
            Admin::where('admin_id', $userID)->delete();
            Validator::make([
                'customer_id' => $this->state['id'],
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname']], [
                'admin_id' => 'required',
                'fname' => 'required',
                'lname' => 'required',
            ]);
            Customer::create(['customer_id' => $this->state['id'], 'fname' => $this->state['fname'], 'lname' => $this->state['lname']]);
        }

        $this->dispatchBrowserEvent('updated', ['message' => "Role changed to {$role} successfully."]);
    }

    public function addNew()
    {
        $this->state = [];
        $this->showEditModal = false;
        $this->dispatchBrowserEvent('show-form');
    }

    public function createUser()
    {
        $validatedData = Validator::make($this->state, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed',
        ])->validate();
        
        $validatedData['password'] = bcrypt($validatedData['password']);

        $user = User::create($validatedData);
        $userID = $user->id;
        $this->state = User::findOrFail($userID)->toArray();
        Validator::make([
            'customer_id' => $this->state['id'],
            'fname' => $this->state['fname'],
            'lname' => $this->state['lname']], [
            'admin_id' => 'required',
            'fname' => 'required',
            'lname' => 'required',
        ]);
        Customer::create(['customer_id' => $this->state['id'], 'fname' => $this->state['fname'], 'lname' => $this->state['lname']]);

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User added successfully!']);
    }

    public function edit(User $user)
    {
        $this->showEditModal = true;
        $this->user = $user;
        $this->state = $user->toArray();
        $this->dispatchBrowserEvent('show-form');
    }

    public function updateUser()
    {
        $validatedData = Validator::make($this->state, [
            'fname' => 'required',
            'lname' => 'required',
            'email' => 'required|email|unique:users,email,'.$this->user->id,
            'password' => 'sometimes|confirmed',
        ])->validate();
        
        if (!empty($validatedData['password'])){
            $validatedData['password'] = bcrypt($validatedData['password']);
        }

        $this->user->update($validatedData);
        
        $userID = $this->user->id;
        $this->state = User::findOrFail($userID)->toArray();
        if($this->state['role'] === 'admin'){
            Validator::make([
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname']], [
                'fname' => 'required',
                'lname' => 'required',
            ]);
            Admin::where('admin_id', $this->state['id'])->update([
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname'],
            ]);
        } elseif ($this->state['role'] === 'chef'){
            Validator::make([
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname']], [
                'fname' => 'required',
                'lname' => 'required',
            ]);
            Chef::where('chef_id', $this->state['id'])->update([
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname'],
            ]);
        } else {
            Validator::make([
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname']], [
                'fname' => 'required',
                'lname' => 'required',
            ]);
            Customer::where('customer_id', $this->state['id'])->update([
                'fname' => $this->state['fname'],
                'lname' => $this->state['lname'],
            ]);
        }

        $this->dispatchBrowserEvent('hide-form', ['message' => 'User updated successfully!']);
    }

    public function confirmUserRemoval($userId)
    {
        $this->userIdBeingRemoved = $userId;
        $this->dispatchBrowserEvent('show-delete-modal');
    }

    public function deleteUser()
    {
        $user = User::findOrFail($this->userIdBeingRemoved);

        if ($user->role === 'admin') {
            Admin::where('admin_id', $this->userIdBeingRemoved)->delete();
            $user->delete();
        } elseif ($user->role === 'chef') {
            Chef::where('chef_id', $this->userIdBeingRemoved)->delete();
            $user->delete();
        } else {
            Customer::where('customer_id', $this->userIdBeingRemoved)->delete();
            $user->delete();
        }
        
        $this->dispatchBrowserEvent('hide-delete-modal', ['message' => 'User deleted successfully!']);
    }

    public function updatedSearchTerm()
    {
        $this->resetPage();
    }

    public function sortBy($columnName)
    {
        if ($this->sortColumnName === $columnName) {
            $this->sortDirection = $this->swapSortDirection();
        } else {
            $this->sortDirection = 'asc';
        }

        $this->sortColumnName = $columnName;
    }

    public function swapSortDirection()
    {
        return $this->sortDirection === 'asc' ? 'desc' : 'asc';
    }
    
    public function render()
    {
        $users = User::query()
            ->where('fname', 'like', '%'.$this->searchTerm.'%')
            ->orwhere('lname', 'like', '%'.$this->searchTerm.'%')
            ->orwhere('email', 'like', '%'.$this->searchTerm.'%')
            ->orwhere('created_at', 'like', '%'.$this->searchTerm.'%')
            ->orderBy($this->sortColumnName, $this->sortDirection)->paginate(10);
        return view('livewire.admin.users.list-users', ['users' => $users])->layout('layouts.admin');
    }
}

