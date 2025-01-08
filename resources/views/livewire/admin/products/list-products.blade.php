<div>
    <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-2">
            <div class="col-sm-6"> 
              <h1 class="m-0 text-dark">Products</h1>
            </div>
            <div class="col-sm-6">
              <ol class="breadcrumb float-sm-right">
                <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                <li class="breadcrumb-item active">Products</li>
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
                    <div>
                      <a href="{{ route('admin.products.create') }}">
                        <button class="btn btn-primary"><i class="fa fa-plus-circle mr-1"></i>Add Products</button>
                      </a>
                      @if ($selectedRows)
                      <div class="btn-group ml-2">
                        <button type="button" class="btn btn-default">Bulk Actions</button>
                        <button type="button" class="btn btn-default dropdown-toggle dropdown-icon" data-toggle="dropdown">
                          <span class="sr-only">Toggle Dropdown</span>
                        </button>
                        <div class="dropdown-menu" role="menu">
                          <a wire:click.prevent="deleteSelectedRows" class="dropdown-item" href="#">Delete Selected</a>
                          <a wire:click.prevent="markAllAsAvailable" class="dropdown-item" href="#">Mark as Available</a>
                          <a wire:click.prevent="markAllAsUnavailable" class="dropdown-item" href="#">Mark as Unavailable</a>
                        </div>
                      </div>
                      <span class="ml-2">selected {{ count($selectedRows) }} {{ Str::plural('product',  count($selectedRows)) }}</span>
                      @endif
                    </div>
                    <div class="btn-group">
                      <button wire:click="filterProduct" type="button" class="btn {{ is_null($status) ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">All</span>
                        <span class="badge badge-pill badge-info">{{ $ProductsCount }}</span>
                      </button>
                      <button wire:click="filterProduct('Available')" type="button" class="btn {{ ($status === 'Available') ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">Available</span>
                        <span class="badge badge-pill badge-primary">{{ $AvailableProductsCount }}</span>
                      </button>
                      <button wire:click="filterProduct('Unavailable')" type="button" class="btn {{ ($status === 'Unavailable') ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">Unavailable</span>
                        <span class="badge badge-pill badge-secondary">{{ $UnavailableProductsCount }}</span>
                      </button>
                    </div>
                </div>

              <div class="card">
                <div class="card-body">
                    <table class="table table-hover">
                        <thead>
                            <tr>
                              <th>
                                <div class="icheck-primary d-inline ml-2">
                                  <input wire:model="selectPageRows" type="checkbox" value="" name="checkbox" id="checkbox">
                                  <label for="checkbox"></label>
                                </div>
                              </th>
                                <th scope="col">#</th>
                                <th scope="col">Product</th>
                                <th scope="col">Price</th>
                                <th scope="col">Description</th>
                                <th scope="col">Status</th>
                                <th scope="col">Option</th>
                            </tr>
                        </thead>
                        <tbody wire:loading.class="text-muted">
                          @forelse ( $products as $index => $prod )
                            <tr>
                              <th>
                                <div class="icheck-primary d-inline ml-2">
                                  <input wire:model="selectedRows" type="checkbox" value="{{ $prod->id }}" name="todo2" id="{{ $prod->id }}">
                                  <label for="{{ $prod->id }}"></label>
                                </div>
                              </th>
                              <th scope="row">{{ $products->firstItem() + $index }}</th>
                              <td style="display: flex;">
                                @if ($prod->photo)
                                  <img src="{{ url('storage/photo/'.$prod->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @else
                                  <img src="{{ asset('noimage.png') }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @endif
                                {{ $prod->title }}
                              </td>
                              <td>${{ $prod->price }}</td>
                              <td>{{ $prod->description }}</td>
                              <td>
                                  @if ( ($prod->status) == 'Available' )
                                    <span class="badge badge-primary" style="font-size:100%;">Available</span>
                                  @elseif ( ($prod->status) == 'Unavailable' )
                                    <span class="badge badge-secondary" style="font-size:100%;">Unavailable</span>
                                  @endif
                              </td>
                              <td>
                                  <a href="" wire:click.prevent="edit({{ $prod->id }})">
                                    <i class="fa fa-edit mr-2"></i>
                                  </a>
                                  <a href="" wire:click.prevent="confirmProductRemoval({{ $prod->id }})">
                                      <i class="fa fa-trash text-danger"></i>
                                  </a>
                              </td>
                            </tr>
                            @empty
                              <tr class="text-center">
                                <td colspan="7">
                                  <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                  <p class="mt-2">No results found</p> 
                                </td>
                              </tr>
                            @endforelse
                        </tbody>
                    </table>
                  </div>
                  <div class="card-footer d-flex justify-content-end">
                      {{ $products->links() }}
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="form" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog" role="document">
        <form autocomplete="off" wire:submit.prevent="updateProduct">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="form">Edit Product</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <div class="form-group">
                <label for="title">Product:</label>
                <input wire:model.defer="state.title" class="form-control @error('title')is-invalid @enderror">
                @error('title')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="price">Price:</label>
                <input wire:model.defer="state.price" type="number" class="form-control @error('price')is-invalid @enderror" step="any">
                @error('price')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <div class="form-group">
                <label for="status">Status:</label>
                <select wire:model.defer="state.status" class="form-control @error('status')is-invalid @enderror" name="status" id="status">
                    <option value="" disabled>-----</option>
                    <option value="Available">Available</option>
                    <option value="Unavailable">Unavailable</option>
                </select>
                @error('status')
                    <div class="invalid-feedback">
                        {{ $message }}
                    </div>
                @enderror
              </div>
              <x-description-form />
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i>Cancel</button>
              <button type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i>Save</button>
            </div>
          </div>
        </form>
      </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="confirmationModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5>Delete Product</h5>
          </div>

          <div class="modal-body">
            <h4>Are you sure you want to delete this Product?</h4>
          </div>

          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal"><i class="fa fa-times mr-1"></i> Cancel</button>
            <button type="submit" wire:click.prevent="deleteProduct" class="btn btn-danger"><i class="fa fa-trash mr-1"></i>Delete Product</button>
          </div>
        </div>
      </div>
    </div>
</div>