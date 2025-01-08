@extends('template')

@section('content')
<!-- Sing in  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('authentication/images/signin-image.jpg') }}" alt="sing up image"></figure>
                <a href="{{ route('register') }}" class="signup-image-link">Create an account</a>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Sign in</h2>
                <form method="POST" action="{{ route('login') }}" class="login-form" id="login-form">
                    @csrf
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Your Email"/>
                    
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
                        <input type="checkbox" name="remember" id="remember" class="agree-term" {{ old('remember') ? 'checked' : '' }} value="1"/>
                        <label for="remember" class="label-agree-term"><span><span></span></span>Remember me</label>
                    </div>
                    <div>
                        <a href="{{ route('password.request') }}" class="label-agree-term" style="color: black; text-decoration: none;">Forgot your password ?</a>
                    </div>
                    <div class="form-group form-button">
                        <input type="submit" name="login" id="login" class="form-submit" value="Login"/>
                    </div>
                </form>
                <!--<div class="social-login">
                    <span class="social-label">Or login with</span>
                    <ul class="socials">
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-facebook"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-twitter"></i></a></li>
                        <li><a href="#"><i class="display-flex-center zmdi zmdi-google"></i></a></li>
                    </ul>
                </div>-->
            </div>
        </div>
    </div>
</section>
@endsection