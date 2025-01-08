@extends('template')

@section('content')
<body>
    <!-- Sing in  Form -->
    <section class="sign-in">
        <div class="container">
            <div class="otp">
                <div class="signin-content" id="TOTP">
                    <div class="signin-image">
                        <figure><img src="{{ asset('authentication/images/2fa.png') }}" alt="sing up image"></figure>
                        <a href="#recovery" type="button" class="signup-image-link" onclick="changeStyle()">Having a problem use recovery code!</a>
                    </div>
        
                    <div class="signin-form">
                        <h2 class="form-title">Time-Based OTP Code</h2>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                {{ session('status') }}
                            </span> 
                        @enderror
                        <p>Please enter your authentication code to Sign in</p>
                        <form method="POST" action="{{ url('/two-factor-challenge') }}">
                            @csrf
                            <input type="text" name="code" class="form-control @error('status') is-invalid @enderror" required autocomplete="code" placeholder="CODE"/>
                            <input type="submit" name="submit" id="submit" class="form-submit mb-3" value="Code"/>
                        </form>
                    </div>
                </div>
        
                <div class="signup-content" id="recovery" style="display: none;">
                    <div class="signup-form">
                        <h2 class="form-title">Recovery Code</h2>
                        @error('status')
                            <span class="invalid-feedback" role="alert">
                                {{ session('status') }}
                            </span> 
                        @enderror
                        <p>Please enter your recovery</p>
                        <form method="POST" action="{{ url('/two-factor-challenge') }}">
                            @csrf
                            <input type="text" name="recovery_code" class="form-control @error('status') is-invalid @enderror" required autocomplete="code" placeholder="CODE"/>
                            <input type="submit" name="submit" id="submit" class="form-submit mb-3" value="Code"/>
                        </form>
                    </div>
                    
                    <div class="signup-image">
                        <figure><img src="{{ asset('authentication/images/2fa-recovery.png') }}" alt="sing up image"></figure>
                        <a href="#TOTP" type="button" class="signup-image-link" onclick="changeStyles()"><-- Time-Based OTP!</a>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script>
        function changeStyle(){
            var element = document.getElementById("TOTP");
            element.style.display = "none";
            var element = document.getElementById("recovery");
            element.style.display = "";
        }

        function changeStyles(){
            var element = document.getElementById("TOTP");
            element.style.display = "";
            var element = document.getElementById("recovery");
            element.style.display = "none";
        }
    </script>
</body>
@endsection