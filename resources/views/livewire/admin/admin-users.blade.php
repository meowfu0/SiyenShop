@extends('layouts.admin')

@section('content')
    <div class="flex-grow-1" style="width: 100%!important;">
        <!-- Top Navbar -->
        @include('components.profilenav')

        <!-- Content -->
        <div class="container-fluid data-table-section mt-5">
            <div class="top-section d-flex align-items-center w-85 mx-auto mb-2">
                <div class="search-container d-flex align-items-center rounded py-3">
                    <i class="fa fa-search"></i>
                    <input type="search" class="searchbox ms-2" placeholder="Search" id="search-input" />
                </div>
                <div class="d-flex align-items-center ms-5 w-25">
                    <span class="me-2">Course</span>
                    <select class="form-select custom-dropdown px-3 py-2 fw-bold rounded fs-2" id="course-filter">
                        <option value="" selected> (Choose course)</option>
                        <option value="course1">BS Information Technology</option>
                        <option value="course2">BS Computer Science</option>
                        <option value="course3">BS Biology</option>
                        <option value="course4">BS Chemistry</option>
                        <option value="course5">BS Meteorology</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid users-table-section p-1 mx-auto mt-9">
                <table class="table table-hover text-center" >
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
                    <tbody id="display">
                        <!--
                        <tr>
                            <th scope="row">image</th>
                            <td>Shakira Regalado</td>
                            <td>sbr2022-7072-51358@bicol-u.edu.ph</td>
                            <td>Student</td>
                            <td>BSIT 3</td>
                            <td>Active</td>
                            <td><button class="view-users-btn fs-2 p-1 px-2">View Account <img
                                        src="{{ asset('images/redirect.svg') }}">
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
                            <td><button class="view-users-btn fs-2 p-1 px-2">View Account <img
                                        src="{{ asset('images/redirect.svg') }}">
                                </button>
                            </td>
                        </tr>
                    -->
                        @foreach($users as $user)
                        <tr>
                            <th scope="row">
                                @if($user->profile_picture)
                                    <img src="https://cdn.britannica.com/59/204159-050-5055F2A9/Beyonce-2013.jpg" alt="Profile Picture" class="img-thumbnail" style="width: 50px; height: 50px;">
                                @else
                                    <img src="{{ asset('images/default-avatar.png') }}" alt="Default Profile Picture" class="img-thumbnail" style="width: 50px; height: 50px;">
                                @endif
                            </th>
                            <td>{{ $user->first_name.' '. $user->last_name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ $user->role->role_name ?? 'Unknown'}}</td> <!-- Joined role name -->
                            <td>{{ $user->course->course_name ?? 'Unknown'}}</td> <!-- Joined course name -->
                            <td>{{ $user->status->status_name ?? 'No status assigned'}}</td>
                            <td>
                                <button class="view-users-btn fs-2 p-1 px-2" data-user-id="{{ $user->id }}">View Account 
                                    <img src="{{ asset('images/redirect.svg') }}">
                                </button>
                            </td>
                        </tr>
                        @endforeach
                        
                        <!-- Some of the fillers were omitted to -->

                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- User Info Modal -->
    <div class="modal fade" id="userInfoModal" tabindex="-1" aria-labelledby="userInfoModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-size">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title fw-bold fs-6" style="color:#092C4C;" id="userInfoModalLabel">User Account</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body1 d-flex align-items-start">
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
                                        <div class="custom-dropdown-container">
                                            <select class="form-select custom-dropdown" style="width: 168px;"
                                                id="modalRole">
                                                <option value="role1" selected>Student</option>
                                                <option value="role2">Business Manager</option>
                                            </select>
                                            <!-- Hidden hyperlink that appears when Business Manager is selected -->
                                            <a href="#" id="editPermissionsLink" data-bs-toggle="modal"
                                                data-bs-target="#editPermissionsModal">
                                                Edit Permissions
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>

                </div>
                <div class="modal-footer mt-1">
                    <button type="button" class="btn fs-2 fw-bold" id="deactivateBtn">Deactivate Account</button>
                    <button type="button" class="btn btn-primary fs-2 fw-bold"
                        style="width: 130px; height: 40px; border-radius: 8px;" id="editBtn">Edit Account</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal for Editing Permissions -->
    <div class="modal fade" id="editPermissionsModal" tabindex="-1" aria-labelledby="editPermissionsModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered custom-modal-size1">
            <div class="modal-content p-4">
                <div class="modal-header">
                    <h5 class="modal-title fs-6 fw-bold" style="color:#092C4C;" id="editPermissionsModalLabel">Edit
                        Business Manager
                        Permissions</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="mt-1 align-items-start">
                    <div class="row">
                        <!-- Left Div -->
                        <div class="col-md-6 ms-4" style="flex: 2;">
                            <div class="form-check">
                                <h6 class="m-0 fs-4 fw-bold">Account & Profile</h6>
                                <input class="form-check-input ms-3" type="checkbox" id="manageUsers">
                                <label class="form-check-label ms-2" for="editProfile">Edit Profile</label>
                            </div>
                            <div class="form-check mt-3">
                                <h6 class="m-0 fs-4 fw-bold">Dashboard & Reports</h6>
                                <input class="form-check-input ms-3" type="checkbox" id="accessDashboard">
                                <label class="form-check-label ms-2" for="accessDashboard">Access Dashboard</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="viewSalesStats">
                                <label class="form-check-label ms-2" for="viewSalesStats">View Sales Stats</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="generateReports">
                                <label class="form-check-label ms-2" for="generateReports">Generate Reports</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="inventoryAlerts">
                                <label class="form-check-label ms-2" for="inventoryAlerts">Inventory Alerts</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="exportData">
                                <label class="form-check-label ms-2" for="exportData">Export Data (Print, CSV, Excel,
                                    PDF)</label>
                            </div>
                            <div class="form-check mt-3">
                                <h6 class="m-0 fs-4 fw-bold">Order & Payment Management</h6>
                                <input class="form-check-input ms-3" type="checkbox" id="viewOrders">
                                <label class="form-check-label ms-2" for="viewOrders">View Orders</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="updateOrderStatus">
                                <label class="form-check-label ms-2" for="updateOrderStatus">Update Order Status</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="confirmPayments">
                                <label class="form-check-label ms-2" for="confirmPayments">Confirm Payments</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="denyInvalidPayments">
                                <label class="form-check-label ms-2" for="denyInvalidPayments">Deny Invalid
                                    Payments</label>
                            </div>
                            <div class="form-check" style="white-space: nowrap;">
                                <input class="form-check-input ms-3" type="checkbox" id="sendPayment">
                                <label class="form-check-label ms-2" for="sendPayment">Send Payment Confirmation
                                    Notifications</label>
                            </div>
                        </div>

                        <!-- Right Div -->
                        <div class="col-md-8" style="flex: 2;">
                            <div class="form-check">
                                <h6 class="m-0 fs-4 fw-bold">Products Management</h6>
                                <input class="form-check-input ms-3" type="checkbox" id="addProducts">
                                <label class="form-check-label ms-2" for="addProducts">Add Products</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="editProducts">
                                <label class="form-check-label ms-2" for="editProducts">Edit Products</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="deleteProducts">
                                <label class="form-check-label ms-2" for="deleteProducts">Delete Products</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="generateReports">
                                <label class="form-check-label ms-2" for="generateReports">Generate Reports</label>
                            </div>
                            <div class="form-check" style="white-space: nowrap;">
                                <input class="form-check-input ms-3" type="checkbox" id="markProduct">
                                <label class="form-check-label ms-2" for="markProduct">Mark Product Unavailable</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input ms-3" type="checkbox" id="lowStocksAlert">
                                <label class="form-check-label ms-2" for="lowStocksAlert">Low Stocks Alert</label>
                            </div>
                            <div class="form-check mt-3">
                                <h6 class="m-0 fs-4 fw-bold">Inbox & Support</h6>
                                <input class="form-check-input ms-3" type="checkbox" id="accessChatbox">
                                <label class="form-check-label ms-2" for="accessChatbox">Access Chatbox</label>
                            </div>
                            <div class="form-check" style="white-space: nowrap;">
                                <input class="form-check-input ms-3" type="checkbox" id="studentQueries">
                                <label class="form-check-label ms-2" for="studentQueries">Respond to Student
                                    Queries</label>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Modal Footer -->
                <div class="modal-footer mt-2">
                    <button type="button" class="btn fs-2 fw-bold" id="closeBtn">Cancel</button>
                    <button type="button" class="btn btn-primary fs-2 fw-bold"
                        style="width: 130px; height: 40px; border-radius: 8px;" id="saveChangesBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeactivateModal" tabindex="-1" aria-labelledby="confirmDeactivateModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
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
                    <button type="button" class="btn btn-primary fs-2 fw-bold"
                        style="width: 130px; height: 40px; border-radius: 8px;"
                        id="confirmDeactivateBtn">Deactivate</button>
                </div>
            </div>
        </div>
    </div>
    <script> 
        const usersData = @json($users);
    </script>
    <script src="{{asset('js/admin-users.js')}}">
        
    </script>
@endsection
