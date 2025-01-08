@extends('template')

@section('content')
<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('authentication/images/confirm-password.png') }}" alt="sing up image"></figure>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Password Confirmation</h2>
                <form method="POST" action="{{ url('user/confirm-password') }}" class="login-form" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="password"><i class="zmdi zmdi-lock"></i></label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" name="password" id="password" required autocomplete="new-password" placeholder="Password"/>
                    
                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span> 
                        @enderror
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="login" id="login" class="form-submit" value="Login"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection