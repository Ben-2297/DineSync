<div>
    <section class="team" id="team">
		<div class="center-text">
			<h3>Team</h3>
			<h2>Our Experience Chefs</h2>
		</div>

		<div class="team-content">
            @forelse ($chefs as $chef)
            <div class="row">
				<div class="team-img">
					@if (!empty($chef->avatar))
						<img src="{{ url('storage/avatars/'.$chef->avatar) }}" alt="">
					@else
						<img src="{{ asset('avatar.jpg') }}" alt="">
					@endif
				</div>
				<h4>{{ $chef->fname }} {{ $chef->lname }}</h4>
				<p>Executive Chef</p>
			</div>
			@empty
			<div class="row">
				<div class="team-img">
					<img src="{{ asset('avatar.jpg') }}">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
			<div class="row">
				<div class="team-img">
					<img src="{{ asset('avatar.jpg') }}">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
			<div class="row">
				<div class="team-img">
					<img src="{{ asset('avatar.jpg') }}">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
			<div class="row">
				<div class="team-img">
					<img src="{{ asset('avatar.jpg') }}">
				</div>
				<h4>Sample</h4>
				<p>Executive Chef</p>
			</div>
            @endforelse
		</div>
	</section>
</div>
