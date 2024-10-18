@extends('layouts.app')


@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6 col-lg-4">
        
        <div class="text-center mb-4">
            <h1 class="fw-bold" style="font-size: 1.75rem;">{{ __('Sign in') }}</h1>
        </div>

        <div class="card border-0 p-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf

               
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

             
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

              
                <div class="d-flex justify-content-between align-items-center mb-3">
                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                        <label class="form-check-label" for="remember">
                            {{ __('Remember me') }}
                        </label>
                    </div>
                    <div>
                        @if (Route::has('password.request'))
                            <a class="text-muted forgot-password" href="{{ route('password.request') }}">{{ __('Forgot Password?') }}</a>
                        @endif
                    </div>
                </div>

             
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary fw-bold">
                        {{ __('Login') }}
                    </button>
                </div>

                
                <div class="text-center mb-3 d-flex align-items-center">
                    <hr class="flex-grow-1">
                    <span class="mx-2 text-muted">{{ __('or') }}</span>
                    <hr class="flex-grow-1">
                </div>

                
                <div class="d-grid">
                    <a class="btn btn-outline-secondary fw-bold register-btn" href="{{ route('register') }}">
                        {{ __('Create an account') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>


<style>
  
    body {
        font-family: 'Satoshi', sans-serif;
    }

    
    .register-btn {
        background-color: transparent;
        color: #07163f; 
        border-color: #07163f; 
    }

    .register-btn:hover {
        background-color: #07163f !important;
        color: white !important;
        border-color: #07163f !important; 
    }

   
    .forgot-password {
        text-decoration: none;
        color: #6c757d; 
    }

    .forgot-password:hover {
        color: #07163f;
        text-decoration: underline;
    }
</style>
@endsection
