@extends('welcome')

@section('content')
    <div class="flex-grow-1" style="width: 100%!important;">
        <!-- Top Navbar -->
        <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
            <div class="d-flex gap-2 pe-5">
                <img src="{{ asset('images/user.svg') }}" alt="">
                @auth
                    <div class="text-primary fw-medium d-none d-md-block">
                        {{ Auth::user()->first_name }}
                    </div>
                @endauth
            </div>
        </div>

        <!-- Content -->
        <div class="container data-table-section mt-5">
            <div class="top-section d-flex align-items-center w-85 mx-auto mb-2">
                <div class="search-container d-flex align-items-center rounded p-1">
                    <i class="fa fa-search"></i>
                    <input type="search" class="searchbox ms-2" placeholder="Search" />
                </div>
                <div class="d-flex align-items-center ms-5">
                    <span class="me-2">Organization</span>
                    <select class="form-select custom-dropdown px-3 py-1 fw-bold rounded fs-2"
                        style="width: 116px;">
                        <option value="course1" selected>CirCUITS</option>
                        <option value="course2">ACCeSS</option>
                        <option value="course3">CheSS</option>
                        <option value="course4">STORM</option>
                        <option value="course5">Symbiosis</option>
                    </select>
                </div>
            </div>

            <div class="container users-table-section p-1 mx-auto mt-9">
                <table class="table table-hover text-center">
                    <thead>
                        <tr>
                            <th scope="col">Profile Picture</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Role</th>
                            <th scope="col">Course & Year</th>
                            <th scope="col">Status</th>
                            <th scope="col"> </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img src="{{ asset('images/arrow.svg') }}">
                                </button>
                            </td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn">View Account <img
                                        src="{{ asset('images/arrow.svg') }}"></button></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Info Modal -->
    <div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog custom-modal-size">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="userInfoModalLabel">User Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex align-items-start">
                    <!-- Profile Picture Section -->
                    <div class="profile-picture-container me-4">
                        <img src="{{ asset('path_to_profile_picture.jpg') }}" alt="User Profile Picture"
                            class="profile-picture"
                            onerror="this.style.display='none'; this.parentElement.style.backgroundColor='#FFFF00';">
                    </div>

                    <!-- User Info Section -->
                    <div class="user-info-container">
                        <p class="user-name"><span id="modalName"></span></p>
                        <p><span id="modalStatus"></span></p>
                        <table class="user-info-table">
                            <tbody>
                                <tr>
                                    <td class="fw-bold">Email:</td>
                                    <td><span id="modalEmail"></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Course:</td>
                                    <td><span id="modalCourse"></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Year:</td>
                                    <td><span id="modalYear"></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Block:</td>
                                    <td><span id="modalBlock"></span></td>
                                </tr>
                                <tr>
                                    <td class="fw-bold">Role:</td>
                                    <td>
                                        <select class="form-select custom-dropdown" style="width: 165px;"
                                            id="modalRole">
                                            <option value="role1" selected>Student</option>
                                            <option value="role2">Business Manager</option>
                                        </select>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn fs-2 fw-bold" id="deactivateBtn">Deactivate Account</button>
                    <button type="button" class="btn btn-primary fs-2 fw-bold"
                        style="width: 130px; height: 40px; border-radius: 8px;" id="editBtn">Edit Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" style="margin: 150px 0 0 105px;" id="confirmDeactivateModal" tabindex="-1" aria-labelledby="confirmDeactivateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Deactivation</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body d-flex justify-content-center align-items-center" style="height: 60px;"> 
                    <p>Are you sure you want to deactivate this account?</p>
                </div>                
                <div class="modal-footer">
                    <button type="button" class="btn custom-btn fs-2 fw-bold" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary fs-2 fw-bold" style="width: 130px; height: 40px; border-radius: 8px;" id="confirmDeactivateBtn">Deactivate</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        document.querySelectorAll('.view-users-btn').forEach(function(button) {
            button.addEventListener('click', function() {
                // Get the user information (replace these with actual dynamic data)
                const name = 'Shakira Regalado';
                const email = 'sbr2022-7072-51358@bicol-u.edu.ph';
                const role = 'Student';
                const course = 'BSIT 3'; // Change this value based on actual data
                const status = 'Active';
                const block = 'B'; // You can add this dynamically as well

                // Change course name for display
                const courseName = course.startsWith('BSIT') ? 'BS Information Technology' : course;

                // Extract year from course
                const year = course.split(' ')[1]; // Get the year part
                const yearDisplay = (year === '1') ? '1st Year' :
                    (year === '2') ? '2nd Year' :
                    (year === '3') ? '3rd Year' :
                    (year === '4') ? '4th Year' : '';

                // Insert data into the modal
                document.getElementById('modalName').innerText = name;
                document.getElementById('modalStatus').innerText = status;
                document.getElementById('modalEmail').innerText = email;
                document.getElementById('modalCourse').innerText = courseName; // Display course name
                document.getElementById('modalYear').innerText = yearDisplay; // Display year
                document.getElementById('modalBlock').innerText = block; // Display block

                // Show the modal
                var myModal = new bootstrap.Modal(document.getElementById('userInfoModal'));
                myModal.show();
            });
        });

        const editBtn = document.getElementById('editBtn');
        const deactivateBtn = document.getElementById('deactivateBtn');
        const confirmDeactivateModal = new bootstrap.Modal(document.getElementById('confirmDeactivateModal'));

        // Flag to keep track of whether we are in edit mode
        let isEditing = false;

        editBtn.addEventListener('click', function() {
            if (!isEditing) {
                // Change to Save Changes and Cancel buttons
                editBtn.innerText = 'Save Changes';

                deactivateBtn.innerText = 'Cancel';

                isEditing = true; // Set edit mode to true
            } else {
                // Handle save changes logic here
                //alert('Changes saved!'); // Example action

                // Reset buttons back to original
                resetButtons();
            }
        });

        deactivateBtn.addEventListener('click', function() {
            if (isEditing) {
                // Handle cancel action and revert buttons
                alert('Edit canceled!'); // Example action
                resetButtons();
            } else {
                // Show confirmation modal for deactivation
                confirmDeactivateModal.show();
            }
        });

        document.getElementById('confirmDeactivateBtn').addEventListener('click', function() {
            // Handle account deactivation logic here
            alert('Account deactivated!'); // Example action
            confirmDeactivateModal.hide(); // Hide confirmation modal
        });

        function resetButtons() {
            editBtn.innerText = 'Edit Account';

            deactivateBtn.innerText = 'Deactivate Account';

            isEditing = false; // Set edit mode to false
        }
    </script>
@endsection
