<div>
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <!-- <h1 class="m-0 text-dark">Products</h1> -->
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active"><a href="{{ route('admin.products') }}">Products</a></li>
                        <li class="breadcrumb-item active">Create</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-12">
                    <form wire:submit.prevent="createProduct" autocomplete="off">
                        <div class="card">
                            <div class="card-header">
                                <h3 class="card-title">Add New Product</h3>
                            </div>
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-mb-3">
                                        <div class="card card-primary card-outline" style="height: 500px; width: 400px; margin-left: 10px;">
                                            <div class="ml-3 mr-3 mt-3 mb-3">
                                                <div class="form-group">
                                                    <label for="photo">Image:</label>
                                                    <div class="d-flex justify-content-center align-item-center mb-3">
                                                        @if ($photo)
                                                            <img src="{{ $photo->temporaryUrl() }}" class="img d-block mt-2" style="height: 350px; width: 350px;">
                                                        @else
                                                            <img src="{{ asset('noimage.png') }}" class="img d-block mt-2" style="height: 350px; width: 350px;">
                                                        @endif
                                                    </div>
                                                    <div class="custom-file">
                                                        <div class="">
                                                            <div x-data="{ isUploading: false, progress: 5 }" x-on:livewire-upload-start="isUploading = true" x-on:livewire-upload-finish="isUploading = false; progress = 5" x-on:livewire-upload-error="isUploading = false" x-on:livewire-upload-progress="progress = $event.detail.progress">
                                                                <input wire:model="photo" type="file" class="custom-file-input" id="photo">
                                                                <div x-show.transition="isUploading" class="progress progress-sm mt-2 rounded">
                                                                    <div class="progress-bar bg-primary progress-bar-striped" role="progressbar" aria-valuenow="40" aria-valuemin="0" aria-valuemax="100" x-bind:style="`width: ${progress}%`">
                                                                        <span class="sr-only">40% Complete (success)</span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <label for="photo" class="custom-file-label" style="overflow: hidden">
                                                                @if ($photo)
                                                                    {{ $photo->getClientOriginalName() }}
                                                                @else
                                                                    Choose image
                                                                @endif
                                                            </label>
                                                            @error('photo') 
                                                                <span class="error">
                                                                    {{ $message }}
                                                                </span> 
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-8 mt-3 ml-5">
                                        <div class="form-group">
                                            <label for="title">Title:</label>
                                            <input wire:model.defer="state.title" type="text" class="form-control @error('title')is-invalid @enderror" required>
                                            @error('title')
                                                <div class="invalid-feedback">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                        <div class="d-flex mb-2">
                                            <div class="form-group mr-5">
                                                <label for="price">Price:</label>
                                                <input wire:model.defer="state.price" type="number" class="form-control @error('price')is-invalid @enderror" step="any" required>
                                                @error('price')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mr-5">
                                                <label for="status">Status:</label>
                                                <select wire:model.defer="state.status" class="form-control @error('status')is-invalid @enderror" name="status" id="status" required>
                                                    <option value="" disabled>Select Availability</option>
                                                    <option value="Available">Available</option>
                                                    <option value="Unavailable">Unavailable</option>
                                                </select>
                                                @error('status')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mr-5">
                                                <label for="type">Type of Serving:</label>
                                                <select wire:model.defer="state.type" class="form-control @error('type')is-invalid @enderror" name="type" id="type" required>
                                                    <option value="" disabled> ---- </option>
                                                    <option value="pcs">piece</option>
                                                    <option value="serving">serving</option>
                                                </select>
                                                @error('type')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                            <div class="form-group mr-5">
                                                <label for="category">Category:</label>
                                                <select wire:model.defer="state.category" class="form-control @error('category')is-invalid @enderror" name="category" id="category" required>
                                                    <option value="" disabled>Select Category</option>
                                                    <option value="pork">Pork</option>
                                                    <option value="chicken">Chicken</option>
                                                    <option value="beef">Beef</option>
                                                    <option value="seafood">Seafood</option>
                                                    <option value="vegetables">Vegetables</option>
                                                    <option value="specialty">Specialty</option>
                                                    <option value="noodles">Noodles</option>
                                                    <option value="desert">Native Desert</option>
                                                </select>
                                                @error('category')
                                                    <div class="invalid-feedback">
                                                        {{ $message }}
                                                    </div>
                                                @enderror
                                            </div>
                                        </div>
                                        <x-description-form />
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer">
                                <a href="{{ route('admin.products') }}">
                                    <button type="button" class="btn btn-secondary"><i class="fa fa-times mr-1"></i> Cancel</button>
                                </a>
                                <button id="submit" type="submit" class="btn btn-primary"><i class="fa fa-save mr-1"></i> Save</button>
                            </div>
                        </div>
                    </form>        
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="modal" tabindex="-1" role="dialog" aria-labelledby="modalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="modalLabel">Crop image</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="img-container">
                        <div class="row">
                            <div class="col-md-8">  
                                <img id="image">
                            </div>
                            <div class="col-md-4">
                                <div class="preview"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary" id="crop">Crop</button>
                </div>
            </div>
        </div>
    </div>
</div>
