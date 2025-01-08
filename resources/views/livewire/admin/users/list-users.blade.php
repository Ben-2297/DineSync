<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6">
              <h1 class="m-0 text-dark">Users</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Users</li>
              </ol>
            </div>
          </div>
        </div>
    </div>
    
    <div class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-12">
                <div class="d-flex justify-content-between mb-2">
                    <button wire:click.prevent="addNew" class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>Add New Users</button>
                    <x-search-input wire:model="searchTerm" />
                </div>
              <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">Name</th>
                                <th scope="col">Email</th>
                                <th scope="col">Registerd Date
                                  <span wire:click="sortBy('created_at')" class="float-right" style="cursor: pointer">
                                    <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                    <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                  </span>
                                </th>
                                <th scope="col">Role
                                  <span wire:click="sortBy('role')" class="float-right" style="cursor: pointer">
                                    <i class="fa fa-arrow-up {{ $sortColumnName === 'role' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                    <i class="fa fa-arrow-down {{ $sortColumnName === 'role' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                  </span>
                                </th>
                                <th scope="col">Options</th>
                            </tr>
                        </thead>
                        <tbody wire:poll.keep-alive wire:loading.class="text-muted">
                            @forelse ($users as $index => $user)
                              <tr>
                                <th scope="row">{{ $users->firstItem() + $index }}</th>
                                <td>{{ $user->fname }} {{ $user->lname }}</td>
                                <td>{{ $user->email }}</td>
                                <td>{{ $user->created_at }}</td>
                                <td>
                                  <select class="form-control" style="width: 150px" wire:change="changeRole({{ $user }}, $event.target.value)">
                                    <option value="admin" {{ ($user->role === 'admin') ? 'selected' : '' }}>ADMIN</option>
                                    <option value="chef" {{ ($user->role === 'chef') ? 'selected' : '' }}>CHEF</option>
                                    <option value="user" {{ ($user->role === 'user') ? 'selected' : '' }}>CUSTOMER</option>
                                  </select>
                                </td>
                                <td>
                                    <a href="" wire:click.prevent="edit({{ $user }})">
                                        <i class="fa fa-edit mr-2"></i>
                                    </a>

                                    <a href="" wire:click.prevent="confirmUserRemoval({{ $user->id }})">
                                        <i class="fa fa-trash text-danger"></i>
                                    </a>
                                </td>
                              </tr>
                            @empty
                              <tr class="text-center">
                                <td colspan="6">
                                  <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                  <p class="mt-2">No results found</p> 
                                </td>
                              </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
                <div class="card-footer d-flex justify-content-end">
                  {{ $users->links() }}
                </div>
              </div>
            </div>
          </div>
        </div>
    </div>

      <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore>
        <div class="modal-dialog" role="document">
        <form autocomplete="off" wire:submit.prevent="{{ $showEditModal ? 'updateUser' : 'createUser' }}">
        <div class="modal-content">
            <div class="modal-header">
            <h1 class="modal-title fs-5" id="exampleModalLabel">
              @if($showEditModal)
                <span>Edit User</span>
              @else
                <span>Add New User</span>
              @endif
            </h1>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
            </button>
            </div>
            <div class="modal-body">
                    <div class="mb-3">
                        <label for="fname" class="form-label">Firstname</label>
                        <input type="text" wire:model.defer="state.fname" class="form-control @error('fname')is-invalid @enderror" id="fname" aria-describedby="nameHelp" placeholder="Enter Firstname">
                        @error('fname')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                      <div class="mb-3">
                        <label for="lname" class="form-label">Lastname</label>
                        <input type="text" wire:model.defer="state.lname" class="form-control @error('lname')is-invalid @enderror" id="lname" aria-describedby="nameHelp" placeholder="Enter Lastname">
                        @error('lname')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                      </div>
                    <div class="mb-3">
                      <label for="email" class="form-label">Email address</label>
                      <input type="text" wire:model.defer="state.email" class="form-control @error('email')is-invalid @enderror" id="email" aria-describedby="emailHelp" placeholder="Enter Email">
                      @error('email')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                      <label for="password" class="form-label">Password</label>
                      <input type="password" wire:model.defer="state.password" class="form-control @error('password')is-invalid @enderror" id="password" placeholder="Password">
                      @error('password')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                      @enderror
                    </div>
                    <div class="mb-3">
                        <label for="passwordConfirmation" class="form-label">Confirm Password</label>
                        <input type="password" wire:model.defer="state.password_confirmation" class="form-control @error('password_confirmation')is-invalid @enderror" id="passwordConfirmation" placeholder="Confirm Password">
                        @error('password_confirmation')
                          <div class="invalid-feedback">
                            {{ $message }}
                          </div>
                        @enderror
                    </div>
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
            <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>
              @if($showEditModal)
              <span>Save Changes</span>
              @else
              <span>Save</span>
              @endif
            </button>
            </div>
        </div>
        </form>
        </div>
    </div>

    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Delete User</h5>
          </div>

          <div class="modal-body">
            <h4>Are you sure you want to delete this user?</h4>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
            <button type="submit" wire:click.prevent="deleteUser" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete User</button>
          </div>
        </div>
      </div>
  </div>
</div>