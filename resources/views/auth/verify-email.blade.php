@extends('template')

@section('content')
<!-- Verify form -->
<section class="sign-in">
    <div class="container">
        <div class="signin-content">
            <div class="signin-image">
                <figure><img src="{{ asset('authentication/images/email-verify.jpg') }}" alt="sing up image"></figure>
            </div>

            <div class="signin-form">
                <h2 class="form-title">Verify Email</h2>
                @if (session('status'))
                    <div class="alert alert-success" role="alert">
                        {{ session('status') }}
                    </div>
                @endif
                <form method="POST" action="{{ route('verification.send') }}">
                    @csrf
                    <div class="form-group">
                        <label class="label-agree-term"><i class="zmdi zmdi-email"></i> You must verify your email address, please check your email for a verification link.</label>
                    </div>
                    
                    <div class="form-group form-button">
                        <input type="submit" name="resend" id="resend" class="form-submit" value="Resend Link"/>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection