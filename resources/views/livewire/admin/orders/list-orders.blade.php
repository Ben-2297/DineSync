<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h1 class="m-0 text-dark">Orders</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Orders</li>
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
                    <div class="d-flex justify-content-end mb-2">
                        <div class="btn-group">
                            <button wire:click="filterOrder('New')" type="button" class="btn {{ ($status === 'New') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">New</span>
                                <span class="badge badge-pill badge-dark">{{ $newOrder }}</span>
                            </button>
                            <button wire:click="filterOrder('Assigned')" type="button" class="btn {{ ($status === 'Assigned') ? 'btn-secondary' : 'btn-default' }}">
                                <span class="mr-1">Assigned</span>
                                <span class="badge badge-pill badge-info">{{ $AssignedOrder }}</span>
                            </button>
                          </div>
                    </div>
                    <div class="card">
                        <div class="card-body">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Order Id</th>
                                        <th scope="col">Customer</th>
                                        <th scope="col">Product</th>
                                        <th scope="col">Quantity</th>
                                        <th scope="col">Order Date</th>
                                        <th scope="col">Status</th>
                                        <th scope="col">Chef</th>
                                    </tr>
                                </thead>
                                <tbody wire:poll.keep-alive>
                                    @forelse ($orders as $index => $order)
                                        <tr>
                                            <th scope="col">{{ $orders->firstItem() + $index }}</th>
                                            <th scope="col">{{ $order->id }}</th>
                                            <th scope="col">{{ $order->customer->fname }} {{ $order->customer->lname }}</th>
                                            <th scope="col">
                                                @if ($order->product->photo)
                                                    <img src="{{ url('storage/photo/'.$order->product->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                                @else
                                                    <img src="" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                                @endif
                                                {{ $order->product->title }}
                                            </th>
                                            <th scope="col">{{ $order->quantity }}</th>
                                            <th scope="col">{{ $order->created_at }}</th>
                                            <th scope="col">
                                                @if ( ($order->status) == 'New' )
                                                    <span class="badge badge-secondary" style="font-size:100%;">{{ $order->status }}</span>
                                                @elseif ( ($order->status) == 'Assigned' )
                                                    <span class="badge badge-info" style="font-size:100%;">{{ $order->status }}</span>
                                                @endif
                                            </th>
                                            <th scope="col">
                                                <select class="form-control" wire:change="setChef({{ $order }}, $event.target.value)" >
                                                    <option value="" {{ is_null($order->chef_id) ? "selected disabled" : "" }}>Select Chef</option>
                                                    @foreach($users as $user)
                                                        <option value="{{ $user->id }}" {{ $order->chef_id === $user->id ? "selected" : "" }}>{{ $user->fname }} {{ $user->lname }}</option>
                                                    @endforeach
                                                </select>
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

                </div>
            </div>
        </div>
    </div>
</div>