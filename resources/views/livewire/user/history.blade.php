<div>
    <header>
		<a href="#home" class="logo"><img src="{{ asset('logo/Logo.png') }}" alt=""></a>

        <div class="main">
            
                <li><a href="{{ route('home') }}" style="text-decoration: none">Dashboard</a></li>
            
                <div class="dropdown">
                    <img src="{{ auth()->user()->avatar_url }}" alt="" class="dropbtn">
                    <div class="dropdown-content">
					<a href="{{ route('history') }}"><i class='bx bx-history'></i> Orders</a>
                    <a href="{{ route('account') }}"><i class='bx bxs-cog' ></i> Settings</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();"><i class='bx bx-log-out'></i> Logout</a>
                    </form>
                    </div>
                </div>

        </div>
	</header>
    
    <section class="menu" id="history">
		<div class="center-text">
			<h3>Order History</h3>
		</div>

		<div wire:poll.keep-alive class="menu-content">
            @forelse ($orders as $order)
            <div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="{{ url('storage/photo/'.$order->product->photo) }}" alt="">
					</div>

					<div class="box-text">
						<h4>{{ $order->product->title }}</h4>
						<p>{{ $order->product->description }}</p>
						<p>{{ $order->quantity }} {{ $order->type }}</p>
                        <h6>{{ $order->status }}</h6>
						<div class="order-history-btn">
							@if ($order->status === 'New' || $order->status === 'Assigned')
							<a href="" wire:click.prevent="cancelOrder({{ $order->id }})" type="button">Cancel</a>
							@else
							<a href="" type="button" style="display: none">Cancel</a>
							@endif
						</div>
					</div>
				</div>
			</div>
            @empty
			<div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="{{ asset('noimage.png') }}" alt="">
					</div>

					<div class="box-text">
						<h1>Your history is empty</h1>
					</div>
				</div>
			</div>
            @endforelse
		</div>
	</section>
</div>
