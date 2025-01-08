@extends('template')

@section('content')
<!-- Forgot  Form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('authentication/images/forgot-password.jpg') }}" alt="sing up image"></figure>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Reset Password</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('password.request') }}">
                    @csrf
                    <div class="form-group">
                        <label for="email"><i class="zmdi zmdi-email"></i></label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" name="email" id="email" value="{{ $email ?? old('email') }}" required autocomplete="email" autofocus placeholder="Your Email"/>
                    
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                    
                    <div class="form-group form-button">
                        <input type="submit" name="reset" id="reset" class="form-submit" value="Reset"/>
                    </div>
                    <label class="label-agree-term">Login <a href="{{ route('login') }}" name="signin-link" id="signin-link" class="label-agree-term" style="color: black;">here!</a></label>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection