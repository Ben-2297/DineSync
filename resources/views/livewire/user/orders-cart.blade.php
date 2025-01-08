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

    <section class="menu" id="cart">
		<div class="center-text" style="margin-top: 30px">
			<h3>Food Cart</h3>
		</div>

		<div wire:poll.keep-alive class="menu-content">
            @forelse ($carts as $cart)
            <div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="{{ url('storage/photo/'.$cart->product->photo) }}" alt="">
					</div>

					<div class="box-text">
						<h4>{{ $cart->product->title }}</h4>
						<p>{{ $cart->product->description }}</p>
                        <h6>${{ $cart->product->price }}</h6>
						<div class="order-contents-btn">
                            <a href="" wire:click.prevent="newCart({{ $cart->product_id }})" type="button">Order Now</a>
						</div>
						<div class="order-cart-btn">
							<a href="" wire:click.prevent="removeCart({{ $cart->id }})" type="button">Remove</a>
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
						<h1>Your cart is empty</h1>
					</div>
				</div>
			</div>
            @endforelse
		</div>
	</section>

    <section class="menu" id="menu">
		<div class="center-text">
			<h3>Menu</h3>
		</div>

		<div wire:poll.keep-alive class="menu-content">
            @forelse ($prods as $prod)
            <div class="box">
				<div class="box-content">
					<div class="box-img">
						<img src="{{ url('storage/photo/'.$prod->photo) }}" alt="">
					</div>

					<div class="box-text">
						<h4>{{ $prod->title }}</h4>
						<p>{{ $prod->description }}</p>
                        <h6>${{ $prod->price }}</h6>
						<div class="order-contents-btn">
                            <a href="" wire:click.prevent="newOrder({{ $prod->id }})" type="button">Order Now</a>
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
						<h1>Menu is Unavailable at the moment</h1>
					</div>
				</div>
			</div>
            @endforelse
		</div>
	</section>

	<div class="modal" id="modalORderform" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Order Quantity</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<form wire:submit.prevent="createOrder" class="form-control">
					<div class="modal-body">
						<div class="form-group" style="font-size: 25px">
							<label for="quantity">{{ $type }}:</label>
							<input wire:model="quan" type="number" class="form-control mt-2 @error('quantity') is-invalid @enderror" id="quantity" placeholder="Quantity">

							@error('quantity')
								<div class="invalid-feedback">
									{{ $message}}
								</div>
							@enderror
						</div>
					</div>
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
						<button type="submit" class="btn btn-primary">Confirm</button>
					</div>
				</form>
			</div>
		</div>
	</div>
	<div class="modal" id="OrderDetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
		<div class="modal-dialog modal-dialog-centered">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">Order Details:</h5>
					<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
				</div>
				<div class="modal-body">
					<div class="ml-5">
						<h4>Order: {{ $name }}</h4>
						<strong>Total Price: ${{ $total }}</strong><br>
						<strong>Quantity: {{ $quantity }} {{ $type }}</strong>
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
					<button type="button" class="btn btn-primary" data-bs-dismiss="modal">Ok</button>
				</div>
			</div>
		</div>
	</div>
</div>