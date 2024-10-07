@extends('welcome')

@section('content')

<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{asset('images/user.svg')}}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>
            @endauth
        </div>
    </div>

    <!-- Welcome Message Below Navbar -->
    <div class="mt-3">
        <h1 class="page-header">Welcome to {{ Route::current()->uri() }}</h1>
    </div>

    <div class="data-table-section">
        <div class="top-bar">
            <div class="search-container">
                <i class="fa fa-search"></i>
                <input type="search" class="searchbox" placeholder="Search"/>
            </div>
            <div class="button-container">
                <div class="dropdown-container">
                <span>Organization</span>
                <select class="course-dropdown">
                    <option value="course1" selected>CirCUITS</option>
                    <option value="course2">ACCeSS</option>
                    <option value="course3">CheSS</option>
                    <option value="course4">STORM</option>
                    <option value="course5">Symbiosis</option>
                </select>
                </div>
            </div>
        </div>
        <div class="shops-table-section">
            <table class="table table-hover">
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
                <td><button class="view-users-btn">View Account <img src="{{ asset('images/arrow.svg') }}"></button></td>
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
            <img src="{{ asset('path_to_profile_picture.jpg') }}" alt="User Profile Picture" class="profile-picture" onerror="this.style.display='none'; this.parentElement.style.backgroundColor='#FFFF00';">
          </div>

          <!-- User Info Section -->
          <div class="user-info-container">
            <p class="user-name"><span id="modalName"></span></p>
            <p><span id="modalStatus"></span></p>
            <p><strong>Email:</strong> <span id="modalEmail"></span></p>
            <p><strong>Course:</strong> <span id="modalCourse"></span></p>
            <p><strong>Year:</strong> <span id="modalYear"></span></p>
            <p><strong>Block:</strong> B </span></p>
            <p><strong>Role:</strong> <span id="modalRole"></span></p>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
        document.getElementById('modalRole').innerText = role;
        document.getElementById('modalCourse').innerText = courseName; // Display course name
        document.getElementById('modalYear').innerText = yearDisplay; // Display year

        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('userInfoModal'));
        myModal.show();
    });
});
</script>

@endsection
