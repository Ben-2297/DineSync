<div>
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6"> 
                    <h1 class="m-0 text-dark">Settings</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('chef.dashboard') }}">Dashboard</a></li>
                        <li class="breadcrumb-item active">Settings</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <!-- Main content -->
    <div class="content">
        <div class="container-fluid">
            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Two Factor Authentication</h5>
                </div>
                <div class="card-body">
                    @if (! auth()->user()->two_factor_secret)
                        Activate two factor authentication ?
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                            @csrf
                            <button type="submit" class="btn btn-primary mt-3">
                                Enable
                            </button>
                        </form>
                    @else
                        Deactivate  two factor authentication ?
                        <form method="POST" action="{{ url('user/two-factor-authentication') }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger mt-3">
                                Disable
                            </button>
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

            <div class="card card-primary card-outline">
                <div class="card-header">
                    <h5 class="m-0">Change Password</h5>
                </div>
                <div class="card-body">
                    <form wire:submit.prevent="changePassword" class="form-horizontal">
                        <div class="form-group row">
                            <label for="currentPassword" class="col-sm-3 col-form-label">Current Password</label>
                            <div class="col-sm-9">
                                <input wire:model.defer="state.current_password" type="password" class="form-control @error('current_password') is-invalid @enderror" id="currentPassword" placeholder="Current Password">
                                @error('current_password')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="newPassword" class="col-sm-3 col-form-label">New Password</label>
                            <div class="col-sm-9">
                                <input wire:model.defer="state.password" type="password" class="form-control @error('password') is-invalid @enderror" id="newPassword" placeholder="New Password">
                                @error('password')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="passwordConfirmation" class="col-sm-3 col-form-label">Confirm New Password</label>
                            <div class="col-sm-9">
                                <input wire:model.defer="state.password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="passwordConfirmation" placeholder="Confirm New Password">
                                @error('password_confirmation')
                                <div class="invalid-feedback">
                                    {{ $message}}
                                </div>
                                @enderror
                            </div>
                        </div>
                        <div class="form-group row">
                            <div class="offset-sm-3 col-sm-9">
                                <button type="submit" class="btn btn-success"><i class="fa fa-save mr-1"></i> Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>