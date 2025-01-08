<div>
    <section class="py-5 my-5">
		<div class="container">
			<h1 class="mb-5">Account Settings</h1>
            <div class="back"><a href="{{ route('home') }}" class="fa fa-arrow-circle-left"></a></div>
			<div class="bg-white shadow rounded-lg d-block d-sm-flex">
				<div class="profile-tab-nav border-right">
					<div class="p-4">
						<div class="img-circle text-center mb-3">
                            <div class="upload"  x-data="{ imagePreview: '{{ auth()->user()->avatar_url }}' }">
                                <img x-on:click="$refs.image.click()" alt="Image" class="shadow" x-bind:src="imagePreview">
                                <div class="round">
                                    <input wire:model="image" type="file"  x-ref="image" x-on:change="
                                        reader = new FileReader();
                                        reader.onload = (event) => {
                                            imagePreview = event.target.result;
                                            document.getElementById('profileImage').src = `${imagePreview}`;
                                        };
                                        reader.readAsDataURL($refs.image.files[0]);
                                    "/>
                                    <i class = "fa fa-camera" style = "color: #fff;"></i>
                                </div>
                            </div>
						</div>
						<h4 class="text-center">{{ auth()->user()->fname }} {{ auth()->user()->lname }}</h4>
					</div>
					<div class="nav flex-column nav-pills" id="v-pills-tab" role="tablist" aria-orientation="vertical">
						<a class="nav-link active" id="account-tab" data-toggle="pill" href="#account" role="tab" aria-controls="account" aria-selected="true">
							<i class="fa fa-home text-center mr-1"></i> 
							Account
						</a>
						<a class="nav-link" id="password-tab" data-toggle="pill" href="#password" role="tab" aria-controls="password" aria-selected="false">
							<i class="fa fa-key text-center mr-1"></i> 
							Password
						</a>
						<a class="nav-link" id="security-tab" data-toggle="pill" href="#security" role="tab" aria-controls="security" aria-selected="false">
							<i class="fa fa-user text-center mr-1"></i> 
							Security
						</a>
					</div>
				</div>
				<div class="tab-content p-4 p-md-5" id="v-pills-tabContent">
					<div class="tab-pane fade show active" id="account" role="tabpanel" aria-labelledby="account-tab">
						<h3 class="mb-4">Account Settings</h3>
                        <div>
                            <form wire:submit.prevent="updateProfile" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="fname">Firstname</label>
                                            <input wire:model.defer="state.fname" type="text" class="form-control @error('fname') is-invalid @enderror" id="fname" placeholder="Firstname">
                                        </div>
    
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="lname">Lastname</label>
                                            <input wire:model.defer="state.lname" type="text" class="form-control @error('lname') is-invalid @enderror" id="lname" placeholder="Lastname">
                                        </div>
    
                                        @error('lname')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <input wire:model="address" type="text" class="form-control @error('address') is-invalid @enderror" id="addrress" placeholder="Address">
                                        </div>
    
                                        @error('address')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="email">Email</label>
                                            <input wire:model.defer="state.email" type="text" class="form-control @error('email') is-invalid @enderror" id="email" placeholder="Email" disabled>
                                        </div>
    
                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="mobile">Phone number</label>
                                            <input wire:model="mobile" type="number" class="form-control @error('mobile') is-invalid @enderror" id="mobile" placeholder="Mobile Number">
                                        </div>
    
                                        @error('mobile')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label for="bio">Bio</label>
                                            <textarea wire:model="bio" class="form-control @error('bio') is-invalid @enderror" rows="4" id="bio" placeholder="About me"></textarea>
                                            
                                            @error('bio')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('home') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
					</div>
					<div class="tab-pane fade" id="password" role="tabpanel" aria-labelledby="password-tab">
						<h3 class="mb-4">Password Settings</h3>
                        <div>
                            <form wire:submit.prevent="changePassword" class="form-horizontal">
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="currentPassword">Current password</label>
                                            <input wire:model.defer="state.current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" placeholder="Current Password">
                                        </div>
    
                                        @error('current_password')
                                            <div class="invalid-feedback">
                                                {{ $message}}
                                            </div>
                                        @enderror
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="newPassword">New password</label>
                                            <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" placeholder="New Password">
    
                                            @error('password')
                                                <div class="invalid-feedback">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="passwordConfirmation">Confirm new password</label>
                                            <input wire:model.defer="state.password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder="Confirm New Password">
    
                                            @error('password_confirmation')
                                                <div class="invalid-feedback">
                                                    {{ $message}}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="ml-3">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                        <a href="{{ route('home') }}"><button type="button" class="btn btn-light">Cancel</button></a>
                                    </div>
                                </div>
                            </form>
                        </div>
					</div>
					<div class="tab-pane fade" id="security" role="tabpanel" aria-labelledby="security-tab">
						<h3 class="mb-4">Security Settings</h3>
						<div>
							@if (! auth()->user()->two_factor_secret)
                                Activate two factor authentication ?
                                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                    @csrf
                                    <button type="submit" class="btn btn-primary mt-3">
                                        Enable
                                    </button>
                                    <a href="{{ route('home') }}"><button type="button" class="btn btn-light mt-3">Cancel</button></a>
                                </form>
                            @else
                                Deactivate  two factor authentication ?
                                <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger mt-3">
                                        Disable
                                    </button>
                                    <a href="{{ route('home') }}"><button type="button" class="btn btn-light mt-3">Cancel</button></a>
                                </form>
                            @endif
        
                            @if (session('status') == 'two-factor-authentication-enabled')
                                <p class="mt-5">You have activate two factor authentication, please scan the following QR code into your phone authenticator application like Google Authenticator or Duo:</p>
                                    {!! auth()->user()->twoFactorQrCodeSvg() !!}

                                <p class="mt-5">Please store these recovery code in a secure location</p>
                                @foreach ( json_decode(decrypt(auth()->user()->two_factor_recovery_codes, true)) as $code )
                                    {{ trim($code) }} <br>
                                @endforeach
                            @endif
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>
</div>
