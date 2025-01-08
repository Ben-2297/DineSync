<div>
    <section class="home" id="home">
        <div class="main-container">
            <div class="content-bx">
                <h3>Today's New on Menu</h3>
                <h1>Appetizing in every bite</h1>
                <p>Delicious food for more than a decade!</p>
                <a href="{{ route('order') }}"><button>Order Now</button></a>
                <div class="menu-card">
                    @forelse ($products as $prod)
                        <div class="card">
                            <img src="{{ url('storage/photo/'.$prod->photo) }}" alt="" class="dis">
                            <h4>${{ $prod->price }}</h4>
                            <h5>{{ $prod->title }}</h5>
                            <p>{{ $prod->description }}</p>
                        </div>
                    @empty
                        <div class="card">
                            <img src="{{ asset('noimage.png') }}" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="{{ asset('noimage.png') }}" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="{{ asset('noimage.png') }}" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="{{ asset('noimage.png') }}" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                        <div class="card">
                            <img src="{{ asset('noimage.png') }}" alt="" class="dis">
                            <h4>$##.##</h4>
                            <h5>Sample</h5>
                            <p>Sample</p>
                        </div>
                    @endforelse
                </div>
                <div class="btn-scroll">
                    <i class='bx bxs-left-arrow-circle'></i>
                    <i class='bx bxs-right-arrow-circle' ></i>
                </div>
            </div>
            <div class="dish-bx">
                @if (!empty($pro->photo))
                    <img src="{{ url('storage/photo/'.$pro->photo) }}" alt="" id="poster">
                @else
                    <img src="{{ asset('noimage.png') }}" alt="" id="poster">
                @endif
            </div>
        </div>
    </section>
</div>