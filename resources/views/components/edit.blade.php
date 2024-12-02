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
                        <img src="{{ asset('storage/' . $user->profile_picture) }}" id="picture_preview_container" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;">
                        <div class="hover-label" style=" position: absolute; top: 0; left: 0; width: 200px; height: 200px; border-radius: 50%; background-color: rgba(0, 0, 0, 0.6); color: white;display: none;justify-content: center;align-items: center; font-size: 0.9rem;">Click to upload</div>
                    </label>
                @else
                    <label for="profilePictureInput" class="profile-avatar" style="cursor: pointer; position: relative; width: 200px; height: 200px;">
                        <img src="{{ asset('images/profile.svg') }}" id="picture_preview_container" style="width: 200px; height: 200px; border-radius: 50%; object-fit: cover;" alt="Default Profile Picture">
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

            <div class="row mb-3">
    @if($user->role_id == 2)
    <div class="col-md-10 mt-3">
            <!-- Gcash Button -->
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#gcashModal">Gcash</button>
            
        </div>
    @endif
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

 <!-- Modal -->
<div class="modal fade" id="gcashModal" tabindex="-1" aria-labelledby="gcashModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" style="max-width: 60%; width: auto;">
        <div class="modal-content">
            <!-- Modal Header -->
            <div class="modal-header" style="border-bottom: none;">
                <h5 class="modal-title fw-bold" id="gcashModalLabel" style="font-size: 20px; color: #092C4C;">Gcash Management</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Add Button -->
                <div class="text-end mb-3">
                    <button id="addBtn" class="btn btn-outline-primary">+ Add</button>
                </div>

                <div id="gcashInfo" style="display: block;">
                    <div class="row mb-3 fw-bold">
                        <div class="col-md-3 text-center">Gcash Name</div>
                        <div class="col-md-3 text-center">Gcash Number</div>
                        <div class="col-md-3 text-center">Gcash Limit</div>
                        <div class="col-md-3 text-center">Actions</div>
                    </div>
                    <div id="gcashInfoContainer">
                    @foreach ($gcashInfos as $info)
    <div class="row mb-3 align-items-center">
        <div class="col-md-3 text-center">
            <p class="mb-0">{{ $info->gcash_name }}</p>
        </div>
        <div class="col-md-3 text-center">
            <p class="mb-0">{{ $info->gcash_number }}</p>
        </div>
        <div class="col-md-3 text-center">
            <p class="mb-0">{{ $info->gcash_limit }}</p>
        </div>
        <div class="col-md-3 text-center">
            <button class="delete-gcash btn btn-danger" data-id="{{ $info->id }}">Delete</button>
        </div>
    </div>
@endforeach

                    </div>
                </div>

                <!-- Gcash Edit Section -->
                <div id="gcashEdit" style="display: none;">
                    <form id="gcashForm" action="{{ route('gcash.store') }}" method="POST">
                        @csrf
                        <div id="gcashFieldsContainer"></div>

                        
                    </form>

                    
                    <!-- Buttons Row -->
                    <div class="d-flex justify-content-center mb-5">
                        <button type="button" class="btn btn-outline-secondary mx-2" id="cancelBtn" style="width: 100px;">Cancel</button>
                        <button type="submit" form="gcashForm" class="btn btn-primary mx-2" id="saveBtn" style="width: 100px;">Save</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    let fieldCount = 0;

    // Switch to edit mode and add the first field
    document.getElementById('addBtn').addEventListener('click', function () {
        document.getElementById('gcashInfo').style.display = 'none';
        document.getElementById('gcashEdit').style.display = 'block';
        document.getElementById('gcashFieldsContainer').innerHTML = ''; // Clear fields
        addField(); // Add an initial empty row
    });

    // Cancel button functionality
    document.getElementById('cancelBtn').addEventListener('click', function () {
        document.getElementById('gcashEdit').style.display = 'none';
        document.getElementById('gcashInfo').style.display = 'block';
    });

    // Function to add a new input field
    function addField() {
        const container = document.getElementById('gcashFieldsContainer');
        const newRow = document.createElement('div');
        newRow.classList.add('row', 'mb-3');
        newRow.setAttribute('data-id', fieldCount);

        newRow.innerHTML = `
            <div class="col-md-4">
                <input type="text" class="form-control" name="gcash_name[]" placeholder="Gcash Name" required>
            </div>
            <div class="col-md-4">
                <input type="text" class="form-control" name="gcash_number[]" placeholder="Gcash Number" required>
            </div>
            <div class="col-md-3">
                <input type="text" class="form-control" name="gcash_limit[]" placeholder="Gcash Limit" required>
            </div>
            
        `;

        container.appendChild(newRow);
        fieldCount++;

        // Add delete functionality for the newly added field
        newRow.querySelector('.delete-btn').addEventListener('click', function () {
            container.removeChild(newRow);
        });
    }

    // Delete functionality for existing GCash entries in the table
    document.addEventListener('DOMContentLoaded', function () {
        const gcashInfoContainer = document.getElementById('gcashInfo');

        if (gcashInfoContainer) {
            gcashInfoContainer.addEventListener('click', function (event) {
                if (event.target.classList.contains('delete-gcash')) {
                    const id = event.target.dataset.id; // Assuming you pass the ID via a data attribute

                    if (confirm('Are you sure you want to delete this GCash info?')) {
                        fetch(`/gcash/delete/${id}`, {
                            method: 'DELETE',
                            headers: {
                                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                                'Accept': 'application/json',
                            },
                        })
                            .then(response => response.json())
                            .then(data => {
                                if (data.success) {
                                    alert(data.message);

                                    // Remove the corresponding row from the DOM
                                    const row = event.target.closest('.row');
                                    if (row) {
                                        row.remove();
                                    }
                                } else {
                                    alert(data.message);
                                }
                            })
                            .catch(error => {
                                console.error('Error:', error);
                                alert('An error occurred while deleting the GCash info.');
                            });
                    }
                }
            });
        }
    });
</script>




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

</style>

<script>

    document.querySelectorAll('.profile-avatar').forEach((avatar) => {
        avatar.addEventListener('mouseenter', () => {
            avatar.querySelector('.hover-label').style.display = 'flex';
        });

        avatar.addEventListener('mouseleave', () => {
            avatar.querySelector('.hover-label').style.display = 'none';
        });
    });


    function uploadProfilePicture(event) {
        const fileInput = event.target;
        const picturePreview = document.getElementById('picture_preview_container');

       
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            reader.onload = function(e) {
                picturePreview.src = e.target.result;
            };

            reader.readAsDataURL(fileInput.files[0]);

            
            }
        }
    
</script>

@endsection
