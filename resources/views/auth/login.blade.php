@extends('layouts.app')


@section('content')
<div class="container d-flex justify-content-center align-items-center" style="height: 100vh;">
    <div class="col-md-6 col-lg-4">
<<<<<<< HEAD
        
=======
        <!-- Logo and Header -->
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
        <div class="text-center mb-4">
            <h1 class="fw-bold" style="font-size: 1.75rem;">{{ __('Sign in') }}</h1>
        </div>

<<<<<<< HEAD
=======
        <!-- Login Form Card -->
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
        <div class="card border-0 p-4">
            <form method="POST" action="{{ route('login') }}">
                @csrf

<<<<<<< HEAD
               
=======
                <!-- Email Input -->
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
                <div class="mb-3">
                    <label for="email" class="form-label fw-bold">{{ __('Email') }}</label>
                    <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Enter email">

                    @error('email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

<<<<<<< HEAD
             
=======
                <!-- Password Input -->
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
                <div class="mb-3">
                    <label for="password" class="form-label fw-bold">{{ __('Password') }}</label>
                    <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password" placeholder="Password">

                    @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                </div>

<<<<<<< HEAD
              
=======
                <!-- Remember Me Checkbox -->
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
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

<<<<<<< HEAD
             
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary fw-bold">
=======
                <!-- Login Button -->
                <div class="d-grid mb-3">
                    <button type="submit" class="btn btn-primary btn-lg fw-bold">
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
                        {{ __('Login') }}
                    </button>
                </div>

<<<<<<< HEAD
                
=======
                <!-- Divider -->
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
                <div class="text-center mb-3 d-flex align-items-center">
                    <hr class="flex-grow-1">
                    <span class="mx-2 text-muted">{{ __('or') }}</span>
                    <hr class="flex-grow-1">
                </div>

<<<<<<< HEAD
                
                <div class="d-grid">
                    <a class="btn btn-outline-secondary fw-bold register-btn" href="{{ route('register') }}">
=======
                <!-- Register Button -->
                <div class="d-grid">
                    <a class="btn btn-outline-secondary btn-lg fw-bold register-btn" href="{{ route('register') }}">
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
                        {{ __('Create an account') }}
                    </a>
                </div>
            </form>
        </div>
    </div>
</div>

<<<<<<< HEAD

<style>
  
=======
<!-- Custom CSS -->
<style>
    /* Importing Satoshi Font */
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
    body {
        font-family: 'Satoshi', sans-serif;
    }

<<<<<<< HEAD
    
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
=======
    .fw-bold {
        font-weight: 700;
    }

    /* Styling for Create Account Button */
    .register-btn {
        background-color: transparent;
        color: #07163f; /* Adjust this color as needed */
        border-color: #07163f; /* Adjust this color as needed */
    }

    .register-btn:hover {
        background-color: #07163f !important; /* Adjust this color as needed */
        color: white !important; /* Adjust this color as needed */
        border-color: #07163f !important; /* Ensure border color remains the same */
    }

    /* Hover Effect for Forgot Password */
    .forgot-password {
        text-decoration: none;
        color: #6c757d; /* Text-muted color */
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
    }

    .forgot-password:hover {
        color: #07163f;
        text-decoration: underline;
    }
</style>
<<<<<<< HEAD
@endsection
=======
@endsection
>>>>>>> 89ab6d6d55b90e98f3be2d7a84d1770247957a21
