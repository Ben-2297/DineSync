<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h1 class="m-0 text-dark">Dashboard</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ url('/') }}">Home</a></li>
                        <li class="breadcrumb-item active">Dashboard</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="card">
                        <div class="card-body">
                            <h3>Queue Dashboard</h3>
                            <table class="table table-hover table-bordered">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity
                                            <span wire:click="sortBy('quantity')" class="float-right" style="cursor: pointer">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'quantity' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'quantity' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Order Date
                                            <span wire:click="sortBy('created_at')" class="float-right" style="cursor: pointer">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'created_at' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'created_at' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Status
                                            <span wire:click="sortBy('status')" class="float-right" style="cursor: pointer">
                                                <i class="fa fa-arrow-up {{ $sortColumnName === 'status' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                                <i class="fa fa-arrow-down {{ $sortColumnName === 'status' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                                            </span>
                                        </th>
                                        <th scope="col">Option</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll.keep-alive>
                                    @forelse ($orders as $order)
                                        <tr>
                                            <th scope="col">{{ $loop->iteration }}</th>
                                            <th scope="col">{{ $order->id }}</th>
                                            <th scope="col">{{ $order->customer->fname }} {{ $order->customer->lname }}</th>
                                            <th scope="col">
                                                @if ($order->product->photo)
                                                    <img src="{{ url('storage/photo/'.$order->product->photo) }}" style="width: 50px;" alt="photos" class="mr-2">
                                                @else
                                                    <img src="" style="width: 50px;" alt="photos" class="mr-2">
                                                @endif
                                                {{ $order->product->title }}
                                            </th>
                                            <th scope="col">{{ $order->quantity }} {{ $order->type }}</th>
                                            <th scope="col">{{ $order->created_at }}</th>
                                            <th scope="col">
                                                @if ( ($order->status) === 'Assigned' )
                                                    <span class="badge badge-info" style="font-size:100%;">{{ $order->status }}</span>
                                                @elseif ( ($order->status) === 'Cooking' )
                                                    <span class="badge badge-warning" style="font-size:100%;">{{ $order->status }}</span>
                                                @elseif ( ($order->status) === 'Cancel' )
                                                    <span class="badge badge-danger" style="font-size:100%;">{{ $order->status }}</span>
                                                @elseif ( ($order->status) === 'Cooked' )
                                                    <span class="badge badge-success" style="font-size:100%;">{{ $order->status }}</span>
                                                @elseif ( ($order->status) == 'Pick-up' )
                                                    <span class="badge badge-primary" style="font-size:100%;">{{ $order->status }}</span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                    <div class="btn-group">
                                                        <button wire:click="setStatus1({{ $order }})" type="button" style="width: 85px;" class="btn {{ $order->status === 'Cooking' || $order->status === 'Cooked' || $order->status === 'Cancel' || $order->status === 'Pick-up' ? 'btn-warning disabled' : 'btn-outline-warning' }}">
                                                            <span style="font-size:100%; font-weight: bold;">Cooking</span>
                                                        </button>
                                                        <button wire:click="setStatus2({{ $order }})" type="button" style="width: 85px;" class="btn {{ $order->status === 'Cooked' || $order->status === 'Assigned' || $order->status === 'Cancel' || $order->status === 'Pick-up' ? 'btn-success disabled' : 'btn-outline-success' }}">
                                                            <span style="font-size:100%; font-weight: bold;">Done</span>
                                                        </button>
                                                    </div>
                                            </th>
                                        </tr>
                                    @empty
                                        <tr class="text-center">
                                            <td colspan="8">
                                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                                            <p class="mt-2">No results found</p> 
                                            </td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <div class="card-footer d-flex justify-content-end">
                            {{ $orders->links() }}
                        </div>
                    </div>

                    <div class="d-flex justify-content-end mb-2">
                        <div class="btn-group mt-3">
                            <button wire:click="filterOrder('Cancel')" type="button" class="btn {{ ($status === 'Cancel') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Cancel</span>
                                <span class="badge badge-pill badge-danger">{{ $CancelOrder }}</span>
                            </button>
                            <button wire:click="filterOrder('Pick-up')" type="button" class="btn {{ ($status === 'Pick-up') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Pick-up</span>
                                <span class="badge badge-pill badge-primary">{{ $PickupOrder }}</span>
                            </button>
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover table-bordered mt-2">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Status</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll.keep-alive>
                                    @forelse ($today as $tdy)
                                        <tr>
                                            <th scope="col">{{ $loop->iteration }}</th>
                                            <th scope="col">{{ $tdy->id }}</th>
                                            <th scope="col">{{ $tdy->customer->fname }} {{ $tdy->customer->lname }}</th>
                                            <th scope="col">
                                                @if ($tdy->product->photo)
                                                    <img src="{{ url('storage/photo/'.$tdy->product->photo) }}" style="width: 50px;" alt="photos" class="mr-2">
                                                @else
                                                    <img src="" style="width: 50px;" alt="photos" class="mr-2">
                                                @endif
                                                {{ $tdy->product->title }}
                                            </th>
                                            <th scope="col">{{ $tdy->quantity }} {{ $tdy->type }}</th>
                                            <th scope="col">{{ $tdy->created_at }}</th>
                                            <th scope="col">
                                                @if ( ($tdy->status) === 'Assigned' )
                                                    <span class="badge badge-info" style="font-size:100%;">{{ $tdy->status }}</span>
                                                @elseif ( ($tdy->status) === 'Cooking' )
                                                    <span class="badge badge-warning" style="font-size:100%;">{{ $tdy->status }}</span>
                                                @elseif ( ($tdy->status) === 'Cancel' )
                                                    <span class="badge badge-danger" style="font-size:100%;">{{ $tdy->status }}</span>
                                                @elseif ( ($tdy->status) === 'Cooked' )
                                                    <span class="badge badge-success" style="font-size:100%;">{{ $tdy->status }}</span>
                                                @elseif ( ($tdy->status) == 'Pick-up' )
                                                    <span class="badge badge-primary" style="font-size:100%;">{{ $tdy->status }}</span>
                                                @endif
                                            </th>
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
                            {{ $today->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>