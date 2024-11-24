@extends('layouts.app')

@section('content')

<div class="d-flex ">
    <div class="d-none d-md-flex flex-md-row">
        @livewire('user-sidenav')
    </div>
    
    <div class="d-flex flex-column align-items-center p-5 w-100 " style="margin-top: -20px;">

        <div class="d-flex flex-column">
            <div class="d-flex ms-3 mb-4 ">
                <!-- Embedded SVG Icon -->
                <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg" style="margin-right: 8px; vertical-align: middle;">
    <path d="M12.5 1C6.14855 1 1 6.14855 1 12.5C1 18.8514 6.14855 24 12.5 24C18.8514 24 24 18.8514 24 12.5C24 6.14855 18.8514 1 12.5 1Z" stroke="#092C4C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
    <path d="M3.61157 19.7975C3.61157 19.7975 6.17492 16.5246 12.4999 16.5246C18.8249 16.5246 21.3894 19.7975 21.3894 19.7975M12.4999 12.4996C13.4149 12.4996 14.2924 12.1361 14.9394 11.4891C15.5864 10.8421 15.9499 9.96461 15.9499 9.04961C15.9499 8.13461 15.5864 7.25709 14.9394 6.61009C14.2924 5.96309 13.4149 5.59961 12.4999 5.59961C11.5849 5.59961 10.7074 5.96309 10.0604 6.61009C9.4134 7.25709 9.04992 8.13461 9.04992 9.04961C9.04992 9.96461 9.4134 10.8421 10.0604 11.4891C10.7074 12.1361 11.5849 12.4996 12.4999 12.4996Z" stroke="#092C4C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
</svg>

    
                <!-- Profile Text -->
                <h4 class="mb-0 fw-bold" style="margin-left: 5px; padding-bottom: -10px;">Profile</h4>
            </div>
            <div class="profile-container d-flex flex-column align-items-center p-5 w-100">
            <div class="d-flex">
                <!-- Profile Picture and Edit Button Section (Left Side) -->
                <div class="d-flex flex-column align-items-center me-5" style="flex-shrink: 0; width: 250px;">
                    <div class="d-flex flex-column align-items-center mb-3" style="flex-shrink: 0;">
                        @if($user->profile_picture)
                            <!-- Profile Picture -->
                            <div class="profile-avatar" style="cursor: default;">
                                <img class="rounded-circle mt-0" src="{{ asset('storage/' . $user->profile_picture) }}" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                            </div>
                        @else
                            <!-- Default Avatar -->
                            <div class="profile-avatar" style="cursor: default;">
                                <svg width="200" height="200" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M12.5 1C6.14855 1 1 6.14855 1 12.5C1 18.8514 6.14855 24 12.5 24C18.8514 24 24 18.8514 24 12.5C24 6.14855 18.8514 1 12.5 1Z"/>
                                </svg>
                            </div>
                        @endif
                    </div>


    <!-- Hidden File Input -->
    <input type="file" id="profilePictureInput" name="profile_picture" style="display: none;" onchange="uploadProfilePicture(event)">
        <!-- Edit Profile Button -->
        <a href="{{ route('profile.edit') }}" class="btn btn-outline-secondary mt-4 edit-profile-btn" 
           style="width: 200px; height: 50px; font-size: 0.85rem; display: flex; align-items: center; justify-content: center; margin-top: 20px;">
            Edit Profile
            <span style="margin-left: 10px; vertical-align: middle; display: flex; align-items: center;">
                <svg width="17" height="17" viewBox="0 0 17 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M3.64704 4.5293H2.76469C2.29667 4.5293 1.84781 4.71522 1.51687 5.04616C1.18592 5.37711 1 5.82597 1 6.29399V14.2351C1 14.7031 1.18592 15.152 1.51687 15.4829C1.84781 15.8139 2.29667 15.9998 2.76469 15.9998H10.7058C11.1738 15.9998 11.6227 15.8139 11.9536 15.4829C12.2846 15.152 12.4705 14.7031 12.4705 14.2351V13.3528" 
                          stroke="#092C4C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                    <path d="M11.5881 2.76479L14.2351 5.41183M15.4571 4.16331C15.8047 3.8158 15.9999 3.34448 15.9999 2.85302C15.9999 2.36157 15.8047 1.89025 15.4571 1.54274C15.1096 1.19523 14.6383 1 14.1469 1C13.6554 1 13.1841 1.19523 12.8366 1.54274L5.41162 8.94122V11.5883H8.05866L15.4571 4.16331Z" 
                          stroke="#092C4C" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                </svg>
            </span>
            <i class="bi bi-pencil" style="margin-left: 8px;"></i>
        </a>
    </div>

                <form>
                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="firstName" class="form-label fw-bold">First Name</label>
                            <input type="text" class="form-control" id="firstName" value="{{ $user->first_name }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="lastName" class="form-label fw-bold">Last Name</label>
                            <input type="text" class="form-control" id="lastName" name="lastName" value="{{ $user->last_name }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="email" class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control" id="email" value="{{ $user->email }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="phone" class="form-label fw-bold">Phone Number</label>
                            <input type="text" class="form-control" id="phone" value="{{ $user->phone_number}}" readonly>
                        </div>
                    </div>
                    @if($user->role_id == 2)
    <div class="col-md-12">
        <label for="gcashName" class="form-label fw-bold">Gcash Name</label>
        <input type="text" class="form-control" id="gcashName" name="gcash_name" value="{{ old('gcash_name', $user->gcash_name) }}" readonly>
    </div>
    <div class="col-md-12 mt-3">
        <label for="gcashNumber" class="form-label fw-bold">Gcash Number</label>
        <input type="text" class="form-control" id="gcashNumber" name="gcash_number" value="{{ old('gcash_number', $user->gcash_number) }}" readonly>
    </div>
@endif


                    <div class="row mb-3">
                        <div class="col-md-12">
                            <label for="course" class="form-label fw-bold">Course</label>
                            <input type="text" class="form-control" id="course" value="{{ $user->course->course_name ?? 'N/A' }}" readonly>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-6">
                            <label for="year" class="form-label fw-bold">Year</label>
                            <input type="text" class="form-control" id="year" value="{{ $user->year }}" readonly>
                        </div>
                        <div class="col-md-6">
                            <label for="block" class="form-label fw-bold">Block</label>
                            <input type="text" class="form-control" id="block" value="{{ $user->course_bloc }}" readonly>
                        </div>
                    </div>
                </form>
            </div>
        </div>
                
    </div>
</div>

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
    .profile-container {
        border: 2px solid #e0e0e0; /* Light grey border */
        padding: 30px; /* Padding inside the border */
        background-color: #ffffff; /* White background */
        max-width: 800px; /* Limit max width */
        margin-top: -10px ; /* Center the profile card */
    }

   
</style>
@endsection
