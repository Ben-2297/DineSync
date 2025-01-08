<div class="col-lg-12 mt-2" wire:poll.keep-alive x-data="{ total: false, today: true, yesterday: false, month: false, year: false }">
    <div class="d-flex justify-content-end mb-1">
        <div class="btn-group">
            <button x-on:click="total = true, today = false, yesterday = false, month = false, year = false" type="button" class="btn btn-default">
                <span class="mr-1">All</span>
            </button>
            <button x-on:click="total = false, today = true, yesterday = false, month = false, year = false" type="button" class="btn btn-default">
                <span class="mr-1">Today</span>
            </button>
            <button x-on:click="total = false, today = false, yesterday = true, month = false, year = false" type="button" class="btn btn-default">
                <span class="mr-1">Yesterday</span>
            </button>
            <button x-on:click="total = false, today = false, yesterday = false, month = true, year = false" type="button" class="btn btn-default ">
                <span class="mr-1">Month</span>
            </button>
            <button x-on:click="total = false, today = false, yesterday = false, month = false, year = true" type="button" class="btn btn-default">
                <span class="mr-1">Year</span>
            </button>
        </div>
    </div>
    <div class="card" x-cloak x-show="total">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h4 style="font-weight: bold;">Total Orders</h4>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id
                            <span wire:click="sortBy('id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Customer
                            <span wire:click="sortBy('customer_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'customer_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'customer_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Product
                            <span wire:click="sortBy('product_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'product_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'product_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Total Price</th>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($totals as $index => $total)
                        <tr>
                            <th scope="col">{{ $totals->firstItem() + $index }}</th>
                            <th scope="col">{{ $total->id }}</th>
                            <th scope="col">{{ $total->customer->fname }} {{ $total->customer->lname }}</th>
                            <th scope="col">{{ $total->customer->address }}</th>
                            <th scope="col">{{ $total->customer->mobile }}</th>
                            <th scope="col">
                                @if ($total->product->photo)
                                    <img src="{{ url('storage/photo/'.$total->product->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @else
                                    <img src="" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @endif
                                {{ $total->product->title }}
                            </th>
                            <th scope="col">{{ $total->total }}</th>
                            <th scope="col">{{ $total->quantity }} {{ $total->type }}</th>
                            <th scope="col">{{ $total->created_at }}</th>
                            <th scope="col">
                                @if ( ($total->status) == 'New' )
                                    <span class="badge badge-dark" style="font-size:100%;">{{ $total->status }}</span>
                                @elseif ( ($total->status) == 'Assigned' )
                                    <span class="badge badge-info" style="font-size:100%;">{{ $total->status }}</span>
                                @elseif ( ($total->status) == 'Cooking' )
                                    <span class="badge badge-warning" style="font-size:100%;">{{ $total->status }}</span>
                                @elseif ( ($total->status) == 'Cooked' )
                                    <span class="badge badge-success" style="font-size:100%;">{{ $total->status }}</span>
                                @elseif ( ($total->status) == 'Pick-up' )
                                    <span class="badge badge-primary" style="font-size:100%;">{{ $total->status }}</span>
                                @elseif ( ($total->status) == 'Cancel' )
                                    <span class="badge badge-danger" style="font-size:100%;">{{ $total->status }}</span>
                                @endif
                            </th>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11">
                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                            <p class="mt-2">No results found</p> 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $totals->links() }}
        </div>
    </div>
    <div class="card" x-cloak x-show="today">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h4 style="font-weight: bold;">Today Orders</h4>
                <div class="btn-group">
                    <button wire:click="filterOrder('Cooking')" type="button" class="btn {{ ($status === 'Cooking') ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">Cooking</span>
                        <span class="badge badge-pill badge-warning">{{ $CookingOrder }}</span>
                    </button>
                    <button wire:click="filterOrder('Cooked')" type="button" class="btn {{ ($status === 'Cooked') ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">Cooked</span>
                        <span class="badge badge-pill badge-success">{{ $CookedOrder }}</span>
                    </button>
                    <button wire:click="filterOrder('Pick-up')" type="button" class="btn {{ ($status === 'Pick-up') ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">Pick-up</span>
                        <span class="badge badge-pill badge-primary">{{ $PickupOrder }}</span>
                    </button>
                    <button wire:click="filterOrder('Cancel')" type="button" class="btn {{ ($status === 'Cancel') ? 'btn-secondary' : 'btn-default' }}">
                        <span class="mr-1">Cancel</span>
                        <span class="badge badge-pill badge-danger">{{ $CancelOrder }}</span>
                    </button>
                </div>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id
                            <span wire:click="sortBy('id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Customer
                            <span wire:click="sortBy('customer_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'customer_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'customer_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Product
                            <span wire:click="sortBy('product_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'product_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'product_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Total Price</th>
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
                <tbody>
                    @forelse ($orders as $index => $order)
                        <tr>
                            <th scope="col">{{ $orders->firstItem() + $index }}</th>
                            <th scope="col">{{ $order->id }}</th>
                            <th scope="col">{{ $order->customer->fname }} {{ $order->customer->lname }}</th>
                            <th scope="col">{{ $order->customer->address }}</th>
                            <th scope="col">{{ $order->customer->mobile }}</th>
                            <th scope="col">
                                @if ($order->product->photo)
                                    <img src="{{ url('storage/photo/'.$order->product->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @else
                                    <img src="" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @endif
                                {{ $order->product->title }}
                            </th>
                            <th scope="col">{{ $order->total }}</th>
                            <th scope="col">{{ $order->quantity }} {{ $order->type }}</th>
                            <th scope="col">{{ $order->created_at }}</th>
                            <th scope="col">
                                @if ( ($order->status) == 'New' )
                                    <span class="badge badge-dark" style="font-size:100%;">{{ $order->status }}</span>
                                @elseif ( ($order->status) == 'Assigned' )
                                    <span class="badge badge-info" style="font-size:100%;">{{ $order->status }}</span>
                                @elseif ( ($order->status) == 'Cooking' )
                                    <span class="badge badge-warning" style="font-size:100%;">{{ $order->status }}</span>
                                @elseif ( ($order->status) == 'Cooked' )
                                    <span class="badge badge-success" style="font-size:100%;">{{ $order->status }}</span>
                                @elseif ( ($order->status) == 'Pick-up' )
                                    <span class="badge badge-primary" style="font-size:100%;">{{ $order->status }}</span>
                                @elseif ( ($order->status) == 'Cancel' )
                                    <span class="badge badge-danger" style="font-size:100%;">{{ $order->status }}</span>
                                @endif
                            </th>
                            <th scope="col">
                                    <div class="btn-group">
                                        <button wire:click="setStatus1({{ $order }})" type="button" style="width: 85px;" value="Cooked" class="btn {{ $order->status === 'New' || $order->status === 'Assigned' || $order->status === 'Cooking' || $order->status === 'Pick-up' || $order->status === 'Cancel' ? 'btn-primary disabled' : 'btn-outline-primary' }}">
                                            <span style="font-size:100%; font-weight: bold;">Pick-up</span>
                                        </button>
                                    </div>
                            </th>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11">
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
    <div class="card" x-cloak x-show="yesterday">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h4 style="font-weight: bold;">Yesterday Orders</h4>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id
                            <span wire:click="sortBy('id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Customer
                            <span wire:click="sortBy('customer_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'customer_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'customer_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Product
                            <span wire:click="sortBy('product_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'product_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'product_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Total Price</th>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($yesterdays as $index => $yesterday)
                        <tr>
                            <th scope="col">{{ $yesterdays->firstItem() + $index }}</th>
                            <th scope="col">{{ $yesterday->id }}</th>
                            <th scope="col">{{ $yesterday->customer->fname }} {{ $yesterday->customer->lname }}</th>
                            <th scope="col">{{ $yesterday->customer->address }}</th>
                            <th scope="col">{{ $yesterday->customer->mobile }}</th>
                            <th scope="col">
                                @if ($yesterday->product->photo)
                                    <img src="{{ url('storage/photo/'.$yesterday->product->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @else
                                    <img src="" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @endif
                                {{ $yesterday->product->title }}
                            </th>
                            <th scope="col">{{ $yesterday->total }}</th>
                            <th scope="col">{{ $yesterday->quantity }} {{ $yesterday->type }}</th>
                            <th scope="col">{{ $yesterday->created_at }}</th>
                            <th scope="col">
                                @if ( ($yesterday->status) == 'New' )
                                    <span class="badge badge-dark" style="font-size:100%;">{{ $yesterday->status }}</span>
                                @elseif ( ($yesterday->status) == 'Assigned' )
                                    <span class="badge badge-info" style="font-size:100%;">{{ $yesterday->status }}</span>
                                @elseif ( ($yesterday->status) == 'Cooking' )
                                    <span class="badge badge-warning" style="font-size:100%;">{{ $yesterday->status }}</span>
                                @elseif ( ($yesterday->status) == 'Cooked' )
                                    <span class="badge badge-success" style="font-size:100%;">{{ $yesterday->status }}</span>
                                @elseif ( ($yesterday->status) == 'Pick-up' )
                                    <span class="badge badge-primary" style="font-size:100%;">{{ $yesterday->status }}</span>
                                @elseif ( ($yesterday->status) == 'Cancel' )
                                    <span class="badge badge-danger" style="font-size:100%;">{{ $yesterday->status }}</span>
                                @endif
                            </th>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11">
                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                            <p class="mt-2">No results found</p> 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $yesterdays->links() }}
        </div>
    </div>
    <div class="card" x-cloak x-show="month">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h4 style="font-weight: bold;">This Month Orders</h4>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id
                            <span wire:click="sortBy('id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Customer
                            <span wire:click="sortBy('customer_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'customer_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'customer_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Product
                            <span wire:click="sortBy('product_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'product_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'product_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Total Price</th>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($months as $index => $month)
                        <tr>
                            <th scope="col">{{ $months->firstItem() + $index }}</th>
                            <th scope="col">{{ $month->id }}</th>
                            <th scope="col">{{ $month->customer->fname }} {{ $month->customer->lname }}</th>
                            <th scope="col">{{ $month->customer->address }}</th>
                            <th scope="col">{{ $month->customer->mobile }}</th>
                            <th scope="col">
                                @if ($month->product->photo)
                                    <img src="{{ url('storage/photo/'.$month->product->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @else
                                    <img src="" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @endif
                                {{ $month->product->title }}
                            </th>
                            <th scope="col">{{ $month->total }}</th>
                            <th scope="col">{{ $month->quantity }} {{ $month->type }}</th>
                            <th scope="col">{{ $month->created_at }}</th>
                            <th scope="col">
                                @if ( ($month->status) == 'New' )
                                    <span class="badge badge-dark" style="font-size:100%;">{{ $month->status }}</span>
                                @elseif ( ($month->status) == 'Assigned' )
                                    <span class="badge badge-info" style="font-size:100%;">{{ $month->status }}</span>
                                @elseif ( ($month->status) == 'Cooking' )
                                    <span class="badge badge-warning" style="font-size:100%;">{{ $month->status }}</span>
                                @elseif ( ($month->status) == 'Cooked' )
                                    <span class="badge badge-success" style="font-size:100%;">{{ $month->status }}</span>
                                @elseif ( ($month->status) == 'Pick-up' )
                                    <span class="badge badge-primary" style="font-size:100%;">{{ $month->status }}</span>
                                @elseif ( ($month->status) == 'Cancel' )
                                    <span class="badge badge-danger" style="font-size:100%;">{{ $month->status }}</span>
                                @endif
                            </th>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11">
                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                            <p class="mt-2">No results found</p> 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $months->links() }}
        </div>
    </div>
    <div class="card" x-cloak x-show="year">
        <div class="card-body">
            <div class="d-flex justify-content-between mb-2">
                <h4 style="font-weight: bold;">This Year Orders</h4>
            </div>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Order Id
                            <span wire:click="sortBy('id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Customer
                            <span wire:click="sortBy('customer_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'customer_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'customer_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Address</th>
                        <th scope="col">Contact Number</th>
                        <th scope="col">Product
                            <span wire:click="sortBy('product_id')" class="float-right" style="cursor: pointer">
                                <i class="fa fa-arrow-up {{ $sortColumnName === 'product_id' && $sortDirection === 'asc' ? '' : 'text-muted' }}"></i>
                                <i class="fa fa-arrow-down {{ $sortColumnName === 'product_id' && $sortDirection === 'desc' ? '' : 'text-muted' }}"></i>
                            </span>
                        </th>
                        <th scope="col">Total Price</th>
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
                    </tr>
                </thead>
                <tbody>
                    @forelse ($years as $index => $year)
                        <tr>
                            <th scope="col">{{ $years->firstItem() + $index }}</th>
                            <th scope="col">{{ $year->id }}</th>
                            <th scope="col">{{ $year->customer->fname }} {{ $year->customer->lname }}</th>
                            <th scope="col">{{ $year->customer->address }}</th>
                            <th scope="col">{{ $year->customer->mobile }}</th>
                            <th scope="col">
                                @if ($year->product->photo)
                                    <img src="{{ url('storage/photo/'.$year->product->photo) }}" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @else
                                    <img src="" style="width: 50px; height: 35px;" alt="photos" class="mr-2">
                                @endif
                                {{ $year->product->title }}
                            </th>
                            <th scope="col">{{ $year->total }}</th>
                            <th scope="col">{{ $year->quantity }} {{ $year->type }}</th>
                            <th scope="col">{{ $year->created_at }}</th>
                            <th scope="col">
                                @if ( ($year->status) == 'New' )
                                    <span class="badge badge-dark" style="font-size:100%;">{{ $year->status }}</span>
                                @elseif ( ($year->status) == 'Assigned' )
                                    <span class="badge badge-info" style="font-size:100%;">{{ $year->status }}</span>
                                @elseif ( ($year->status) == 'Cooking' )
                                    <span class="badge badge-warning" style="font-size:100%;">{{ $year->status }}</span>
                                @elseif ( ($year->status) == 'Cooked' )
                                    <span class="badge badge-success" style="font-size:100%;">{{ $year->status }}</span>
                                @elseif ( ($year->status) == 'Pick-up' )
                                    <span class="badge badge-primary" style="font-size:100%;">{{ $year->status }}</span>
                                @elseif ( ($year->status) == 'Cancel' )
                                    <span class="badge badge-danger" style="font-size:100%;">{{ $year->status }}</span>
                                @endif
                            </th>
                        </tr>
                    @empty
                        <tr class="text-center">
                            <td colspan="11">
                            <img src="https://42f2671d685f51e10fc6-b9fcecea3e50b3b59bdc28dead054ebc.ssl.cf5.rackcdn.com/v2/assets/empty.svg" alt="No results found">
                            <p class="mt-2">No results found</p> 
                            </td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="card-footer d-flex justify-content-end">
            {{ $years->links() }}
        </div>
    </div>
</div>