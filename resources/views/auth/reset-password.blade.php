@extends('template')

@section('content')
<!-- Reset form -->
<section class="signup">
    <div class="container">
        <div class="signup-content">
            <div class="signup-form">
                <h2 class="form-title">Reset Password</h2>
                <form method="POST" action="{{ route('password.update') }}">
                    @csrf
                    <input type="hidden" name="token" value="{{ $request->route('token') }}">
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $request->email }}" required autocomplete="email" autofocus placeholder="Your Email"/>
                    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="new-password" placeholder="Password"/>
                    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock-outline"></i></label>
                        <input type="password" class="form-control" name="password_confirmation" id="password-confirm" required autocomplete="new-password" placeholder="Repeat your password"/>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="reset" id="reset" class="form-submit" value="Update"/>
                    </div>
                </form>
            </div>
            <div class="signup-image">
                <figure><img src="{{ asset('authentication/images/password-reset.jpg') }}" alt="sing up image"></figure>
            </div>
        </div>
    </div>
</section>
@endsection