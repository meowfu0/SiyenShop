@extends('layouts.app')

@section('content')
<div class="d-flex ">
    <div class="d-none d-md-flex flex-md-row">
        @livewire('user-sidenav')

<form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">

    @csrf
    @method('PUT')
<div class="container mt-5"> 
    <div class="row">
        <div class="col-md-2">
        </div>
        <div class="col-md-10">
      
            <!-- Profile Header -->
            <div class="d-flex align-items-center mb-4" style="margin-left: 65px; margin-top: -35px;">
                <!-- Embedded SVG Icon -->
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M12.5 1C6.14855 1 1 6.14855 1 12.5C1 18.8514 6.14855 24 12.5 24C18.8514 24 24 18.8514 24 12.5C24 6.14855 18.8514 1 12.5 1Z" stroke="#092C4C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M3.61157 19.7975C3.61157 19.7975 6.17492 16.5246 12.4999 16.5246C18.8249 16.5246 21.3894 19.7975 21.3894 19.7975M12.4999 12.4996C13.4149 12.4996 14.2924 12.1361 14.9394 11.4891C15.5864 10.8421 15.9499 9.96461 15.9499 9.04961C15.9499 8.13461 15.5864 7.25709 14.9394 6.61009C14.2924 5.96309 13.4149 5.59961 12.4999 5.59961C11.5849 5.59961 10.7074 5.96309 10.0604 6.61009C9.4134 7.25709 9.04992 8.13461 9.04992 9.04961C9.04992 9.96461 9.4134 10.8421 10.0604 11.4891C10.7074 12.1361 11.5849 12.4996 12.4999 12.4996Z" stroke="#092C4C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>

                <!-- Profile Text -->
                <h4 class="mb-0 fw-bold" style="margin-left: 10px;">Profile</h4>
            </div>
          
            <!-- Profile Card with Avatar above Edit Button -->
    <!-- Profile Picture Section -->
    <div class="container mt-5"> 
    <div class="row">
        <div class="col-md-3 d-flex justify-content-center align-items-start">
            <!-- Profile Picture Section -->
            <div class="d-flex flex-column align-items-center mb-3" style="flex-shrink: 0; position: relative;">
                @if($user->profile_picture)
                    <label for="profilePictureInput" class="profile-avatar" style="cursor: pointer; position: relative; width: 200px; height: 200px;">
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" id="picture_preview_container" 
                            style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                        <div class="hover-label" style=" position: absolute; top: 0; left: 0; width: 200px; height: 200px; border-radius: 50%; background-color: rgba(0, 0, 0, 0.6); color: white;display: none;justify-content: center;align-items: center; font-size: 0.9rem;">Click to upload</div>
                    </label>
                @else
                    <label for="profilePictureInput" class="profile-avatar" style="cursor: pointer; position: relative; width: 200px; height: 200px;">
                        <svg width="200" height="200" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                            <path d="M12.5 1C6.14855 1 1 6.14855 1 12.5C1 18.8514 6.14855 24 12.5 24C18.8514 24 24 18.8514 24 12.5C24 6.14855 18.8514 1 12.5 1Z"  />
                        </svg>
                        <div class="hover-label" style=" position: absolute; top: 0; left: 0; width: 200px; height: 200px; border-radius: 50%; background-color: rgba(0, 0, 0, 0.6); color: white;display: none;justify-content: center;align-items: center;font-size: 0.9rem;">Click to upload</div>
                    </label>
                @endif
        </div>

    <input type="file" id="profilePictureInput" name="profile_picture" style="display: none;" onchange="uploadProfilePicture(event)">
</div>

                        <!-- Profile Details Form -->
                        <div class="col-md-8">
                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="firstName" class="form-label fw-bold">First Name</label>
                                    <input type="text" class="form-control" id="firstName" name="first_name" value="{{ old('first_name', $user->first_name) }}">
                                </div>
                                <div class="col-md-5">
                                    <label for="lastName" class="form-label fw-bold">Last Name</label>
                                    <input type="text" class="form-control" id="lastName" name="last_name" value="{{ old('last_name', $user->last_name) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-10">
                                    <label for="email" class="form-label fw-bold">Email</label>
                                    <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $user->email) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
    <div class="col-md-10">
        <label for="password" class="form-label fw-bold">New Password</label>
        <input type="password" class="form-control" id="password" name="password">
    </div>
</div>

<div class="row mb-3">
    <div class="col-md-10">
        <label for="password_confirmation" class="form-label fw-bold">Confirm Password</label>
        <input type="password" class="form-control" id="password_confirmation" name="password_confirmation">
    </div>
</div>

                            <div class="row mb-3">
                                <div class="col-md-10">
                                    <label for="phone" class="form-label fw-bold">Phone Number</label>
                                    <input type="text" class="form-control" id="phone" name="phone_number" value="{{ old('phone_number', $user->phone_number) }}">
                                </div>
                            </div>

                            <div class="row mb-3">
    @if($user->role_id == 2)
        <div class="col-md-10">
            <label for="gcashName" class="form-label fw-bold">Gcash Name</label>
            <input type="text" class="form-control" id="gcashName" name="gcash_name" value="{{ old('gcash_name', $user->gcash_name) }}">
        </div>
        <div class="col-md-10 mt-3">
            <label for="gcashNumber" class="form-label fw-bold">Gcash Number</label>
            <input type="text" class="form-control" id="gcashNumber" name="gcash_number" value="{{ old('gcash_number', $user->gcash_number) }}">
        </div>
    @endif
</div>


                             <div class="row mb-3">
                                <div class="col-md-10">
                                    <label for="course" class="form-label fw-bold">Course</label>
                                    <select id="course" class="form-select" name="course_id" required style="font-size: 14px;">
                                        <option value="" disabled>Select your course</option>
                                        <option value="1" {{ $user->course_id == 1 ? 'selected' : '' }}>BS Information Technology</option>
                                        <option value="2" {{ $user->course_id == 2 ? 'selected' : '' }}>BS Meteorology</option>
                                        <option value="3" {{ $user->course_id == 3 ? 'selected' : '' }}>BS Biology</option>
                                        <option value="4" {{ $user->course_id == 4 ? 'selected' : '' }}>BS Computer Science</option>
                                        <option value="5" {{ $user->course_id == 5 ? 'selected' : '' }}>BS Chemistry</option>
                                    </select>

                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-5">
                                    <label for="year" class="form-label fw-bold">Year</label>
                                    <select id="year" class="form-select" name="year" required style="font-size: 14px;">
                                        <option value="" disabled>Select your year</option>
                                        <option value="1st Year" {{ $user->year == '1st Year' ? 'selected' : '' }}>1st Year</option>
                                        <option value="2nd Year" {{ $user->year == '2nd Year' ? 'selected' : '' }}>2nd Year</option>
                                        <option value="3rd Year" {{ $user->year == '3rd Year' ? 'selected' : '' }}>3rd Year</option>
                                        <option value="4th Year" {{ $user->year == '4th Year' ? 'selected' : '' }}>4th Year</option>
                                        <option value="5th Year" {{ $user->year == '5th Year' ? 'selected' : '' }}>5th Year</option>
                                    </select>
                                </div>
                                <div class="col-md-5">
                                    <label for="block" class="form-label fw-bold">Block</label>
                                    <select id="block" class="form-select" name="course_bloc" required style="font-size: 14px;">
                                        <option value="" disabled>Select your block</option>
                                        <option value="A" {{ $user->block == 'A' ? 'selected' : '' }}>A</option>
                                        <option value="B" {{ $user->block == 'B' ? 'selected' : '' }}>B</option>
                                        <option value="C" {{ $user->block == 'C' ? 'selected' : '' }}>C</option>
                                        <option value="D" {{ $user->block == 'D' ? 'selected' : '' }}>D</option>
                                        <option value="E" {{ $user->block == 'E' ? 'selected' : '' }}>E</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Save and Cancel Buttons Outside the Card -->
            <div class="d-flex justify-content-end mt-3">
                <div class="me-2">
                <a href="{{ route('profile') }}" class="btn btn-outline-secondary cancel-btn d-flex justify-content-center align-items-center" style="width: 150px; height: 50px;">Cancel</a>

                </div>
                <div>
                    <button type="submit" type="submit" class="btn btn-primary btn-block" style="width: 150px; height: 50px; margin-right:203px">Save Changes</button>
                </div>
            </div>

        </div>
    </div>
</div>
</form>

<style>
    .list-group-item {
        border: none;
    }
    .list-group-item.bg-warning {
        background-color: #FFC107;
        border-color: #FFC107;
    }

    .profile-avatar {
        background-color: #FFF8E4;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%; 
    }

    img.rounded-circle {
        object-fit: cover;
        border-radius: 50%; 
    }

    .btn-outline-secondary.edit-profile-btn {
        width: 300px;
        height: 55px;  
        font-size: 0.85rem; 
        padding: 0.75rem; 
        border-color: #d3d3d3; 
        color: #6c757d;
    }

    .btn-outline-secondary.edit-profile-btn:hover {
        background-color: #E3E3E3; 
    }

    .cancel-btn {
        background-color: transparent; /* Remove color */
        border: none; /* Remove border */
        color: #6c757d; /* Set default text color */
    }

    .cancel-btn:hover {
        background-color: #E3E3E3; /* Light grayish hover color */
    }

    .card {
        width: 100%;
        max-width: 800px; 
        margin-top: -5px;
    }

    .form-control {
        font-size: 1rem;
        padding: 0.75rem;
        width: 100%;
    }
    .border-container {
    border: 2px solid #e0e0e0; /* Light gray border */
    padding: 30px; /* Space inside the border */
    background-color: #ffffff; /* White background */
    border-radius: 5px; /* Optional for slightly rounded corners */
/* Subtle shadow for better appearance */
}

</style>

<script>
    // Hover effect for profile picture
    document.querySelectorAll('.profile-avatar').forEach((avatar) => {
        avatar.addEventListener('mouseenter', () => {
            avatar.querySelector('.hover-label').style.display = 'flex';
        });

        avatar.addEventListener('mouseleave', () => {
            avatar.querySelector('.hover-label').style.display = 'none';
        });
    });

    // Function to preview the selected profile picture
    function uploadProfilePicture(event) {
        const fileInput = event.target;
        const picturePreview = document.getElementById('picture_preview_container');

        // Ensure a file is selected
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            // Load the image and set it as the preview
            reader.onload = function(e) {
                picturePreview.src = e.target.result;
            };

            // Read the selected file as a Data URL
            reader.readAsDataURL(fileInput.files[0]);
            }
        }
    
</script>
 


@endsection
