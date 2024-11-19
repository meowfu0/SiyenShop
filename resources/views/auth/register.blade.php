@extends('layouts.app')

@section('content')
<div class="container" style="max-width: 500px; margin-top: 50px;">
    <h1 class="text-center mb-4 fw-bold" style="font-size: 36px; color: #092C4C;">Sign up</h1>
    
    <form action="{{ route('register') }}" method="POST">
    @csrf


        <div class="d-flex gap-3 w-100">
             <!-- First Name -->
            <div class="mb-3 w-100">
                <label for="first_name" class="form-label" style="font-size: 16px; color: #092C4C;">First Name</label>
                <input id="first_name" type="text" class="form-control py-2" name="first_name" required placeholder="Input text" style="font-size: 14px;">
            </div>

            <!-- Last Name -->
            <div class="mb-3 w-100">
                <label for="last_name" class="form-label" style="font-size: 16px; color: #092C4C;">Last Name</label>
                <input id="last_name" type="text" class="form-control py-2" name="last_name" required placeholder="Input text" style="font-size: 14px;">
            </div>

        </div>
        <!-- Email -->
        <div class="mb-3">
            <label for="email" class="form-label" style="font-size: 16px; color: #092C4C;">Email</label>
            <input id="email" type="email" class="form-control py-2" name="email" required placeholder="Input text" style="font-size: 14px;">
        </div>

        <!-- Password -->
        <div class="mb-3">
            <label for="password" class="form-label" style="font-size: 16px; color: #092C4C;">Password</label>
            <input id="password" type="password" class="form-control py-2" name="password" required placeholder="Input text" style="font-size: 14px;">
        </div>

        <!-- Phone Number -->
        <div class="mb-3">
            <label for="phone_number" class="form-label" style="font-size: 16px; color: #092C4C;">Phone Number</label>
            <input id="phone_number" type="text" class="form-control py-2" name="phone_number" required placeholder="Input text" style="font-size: 14px;">
        </div>

        <!-- Course -->
        <div class="mb-3">
            <label for="course_id" class="form-label" style="font-size: 16px; color: #092C4C;">Course</label>
            <select id="course_id" class="form-select" name="course_id" required style="font-size: 14px;">
                <option value="" disabled selected>Select your course</option>
                @foreach($courses as $course)
                    <option value="{{ $course->id }}" {{ old('course_id') == $course->id ? 'selected' : '' }}>
                        {{ $course->course_name }}
                    </option>
                @endforeach
            </select>
            @error('course_id')
                <span class="invalid-feedback" role="alert">
                    <strong>{{ $message }}</strong>
                </span>
            @enderror
        </div>

        <!-- Year and Block side by side -->
        <div class="mb-3 row">
            <div class="col">
                <label for="year" class="form-label" style="font-size: 16px; color: #092C4C;">Year</label>
                <select id="year" class="form-select" name="year" required style="font-size: 14px;">
                    <option value="" disabled selected>Select your year</option>
                    <option value="1st Year">1st Year</option>
                    <option value="2nd Year">2nd Year</option>
                    <option value="3rd Year">3rd Year</option>
                    <option value="4th Year">4th Year</option>
                    <option value="5th Year">5th Year</option>
                </select>
            </div>
            <div class="col">
                <label for="course_bloc" class="form-label" style="font-size: 16px; color: #092C4C;">Block</label>
                <select id="course_bloc" class="form-select" name="course_bloc" required style="font-size: 14px;">
                    <option value="" disabled selected>Select your block</option>
                    <option value="A">A</option>
                    <option value="B">B</option>
                    <option value="C">C</option>
                    <option value="D">D</option>
                    <option value="E">E</option>
                </select>
            </div>
        </div>

        <!-- Terms and Conditions -->
        <div class="mb-3 form-check">
            <input type="checkbox" class="form-check-input" id="terms" required data-bs-toggle="modal" data-bs-target="#termsModal">
            <label class="form-check-label" for="terms" style="font-size: 14px; color: #092C4C;">I read and agreed to the <a href="#" style="color: #092C4C; text-decoration: underline;">Terms and Conditions</a></label>
        </div>

        <!-- Submit Button -->
        <button type="submit" class="btn" style="background-color: #092C4C; color: white; width: 100%; font-size: 16px; font-weight: bold;">Sign Up</button>

        <div class="d-flex align-items-center py-3">
            <hr class="flex-grow-1 m-0" style="border-top: 1px solid #092C4C;">
            <span style="font-size: 14px; color: #092C4C; padding: 0 10px;">or</span>
            <hr class="flex-grow-1 m-0" style="border-top: 1px solid #092C4C;">
        </div>
        <!-- Log in Link with lines and or text -->
        <div class="text-center">
            <a href="{{ route('login') }}" class="btn btn-outline-secondary btn-lg fw-bold register-btn" style="width: 100%; font-size: 16px; color:#092C4C;">Log in</a>
        </div>
    </form>

   <!-- Terms and Conditions Modal with Warning Symbol -->
<div class="modal fade" id="termsModal" tabindex="-1" aria-labelledby="termsModalLabel" aria-hidden="true">
    <div class="modal-dialog" style="max-width: 550px;">
        <div class="modal-content" style="border-radius: 15px; box-shadow: 0px 4px 12px rgba(0, 0, 0, 0.1);">
            <div class="modal-body" style="padding: 30px;">
                <!-- Warning Symbol -->
                <div style="text-align: center; margin-bottom: 20px;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="50" height="50" viewBox="0 0 24 24" fill="none" stroke="#092C4C" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle">
                        <path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h18.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"/>
                        <line x1="12" y1="9" x2="12" y2="13"/>
                        <line x1="12" y1="17" x2="12.01" y2="17"/>
                    </svg>
                </div>

                <!-- Terms and Condition Heading -->
                <div style="text-align: center; margin-bottom: 20px;">
                    <h5 class="modal-title" id="termsModalLabel" style="color: #333333; font-weight: bold; font-size: 20px;">
                        Terms and Conditions
                    </h5>
                </div>

                <!-- Terms and Condition Content -->
                <p style="font-weight: 500; color: #555555; text-align: left; margin-bottom: 20px;">
                    Welcome to SiyenShop! Before signing up and making purchases, please read and agree to the following terms:
                </p>
                <ul style="padding-left: 20px; color: #333333; font-size: 16px; margin-bottom: 20px; list-style-type: disc;">
                    <li style="margin-bottom: 15px;">
                        <strong>Account Registration:</strong> All users must provide accurate and up-to-date information during registration. You are responsible for maintaining the confidentiality of your account credentials.
                    </li>
                    <li style="margin-bottom: 15px;">
                        <strong>Purchasing and Payments:</strong> All purchases are subject to product availability. Payments must be completed through the approved methods provided on the site.
                    </li>
                    <li style="margin-bottom: 15px;">
                        <strong>Privacy:</strong> We are committed to protecting your privacy. Personal information collected during the registration and purchase process will be used only to fulfill orders and improve your shopping experience.
                    </li>
                    <li style="margin-bottom: 15px;">
                        <strong>Agreeing to the Terms & Conditions:</strong> This means the Organization will not accept further cancellation and refund of soon-to-be-bought products. Please review your orders before confirming your purchase.
                    </li>
                </ul>
                <p style="font-weight: 500; color: #555555; margin-bottom: 20px;">
                    By signing up, you acknowledge that you have read, understood, and agree to be bound by these terms and conditions.
                </p>

                <!-- Agreement Checkbox -->
                <div class="form-check mb-3" style="text-align: left;">
                    <input class="form-check-input" type="checkbox" id="agreeCheck" required>
                    <label class="form-check-label" for="agreeCheck" style="color: #333333;">
                        I agree to these Terms and Conditions.
                    </label>
                </div>
            </div>

            <!-- Modal Footer (Buttons) -->
            <div class="modal-footer" style="background-color: #f9fafb; border-top: none; padding: 20px 30px; justify-content: center;">
                <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal" style="border-color: #092C4C; color: #092C4C; padding: 10px 30px; font-weight: bold;">Cancel</button>
                <button type="button" class="btn" data-bs-dismiss="modal" style="background-color: #092C4C; color: white; padding: 10px 30px; font-weight: bold;">Continue</button>
            </div>
        </div>
    </div>
</div>


@endsection