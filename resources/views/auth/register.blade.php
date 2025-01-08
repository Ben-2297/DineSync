@extends('template')

@section('content')
<body>
    <!-- Sign up form -->
    <section class="signup">
        <div class="container">
            <div class="signup-content">
                <div class="signup-form">
                    <h2 class="form-title">Sign up</h2>
                    <form method="POST" action="{{ route('register') }}" class="register-form" id="register-form">
                        @csrf
                        <div class="form-group">
                            <label for="fname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" class="form-control @error('fname') is-invalid @enderror" name="fname" id="fname" value="{{ old('fname') }}" required autocomplete="fname" autofocus placeholder="Your Firstname"/>
                            
                            @error('fname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="lname"><i class="zmdi zmdi-account material-icons-name"></i></label>
                            <input type="text" class="form-control @error('lname') is-invalid @enderror" name="lname" id="lname" value="{{ old('lname') }}" required autocomplete="lname" autofocus placeholder="Your Lastname"/>
                            
                            @error('lname')
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        </div>
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
                            <label for="password"><i class="zmdi zmdi-lock-outline"></i></label>
                            <input type="password" class="form-control" name="password_confirmation" id="password-confirm" required autocomplete="new-password" placeholder="Repeat your password"/>
                        </div>
                        <div class="form-group">
                            <input type="checkbox" onchange="document.getElementById('registerBtn').disabled = !this.checked;" name="agree-term" id="agree-term" class="agree-term" />
                            <label for="agree-term" class="label-agree-term"><span><span></span></span>I agree all statements in  <a href="#" class="term-service">Terms of service</a></label>
                        </div>
                        <div class="form-group form-button">
                            <input type="submit" name="registerBtn" id="registerBtn" class="form-submit" value="Register" disabled/>
                        </div>
                    </form>
                </div>
                <div class="signup-image">
                    <figure><img src="{{ asset('authentication/images/signup-image.jpg') }}" alt="sing up image"></figure>
                    <a href="{{ route('login') }}" class="signup-image-link">I am already member</a>
                </div>
            </div>
        </div>
    </section>
</body>
@endsection