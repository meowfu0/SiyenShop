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
                    <input type="search" class="searchbox ms-2" placeholder="Search" />
                </div>
                <div class="d-flex align-items-center ms-5 w-25">
                    <span class="me-2">Course</span>
                    <select class="form-select custom-dropdown px-3 py-2 fw-bold rounded fs-2">
                        <option value="course1" selected>BS Information Technology</option>
                        <option value="course2">BS Computer Science</option>
                        <option value="course3">BS Biology</option>
                        <option value="course4">BS Chemistry</option>
                        <option value="course5">BS Meteorology</option>
                    </select>
                </div>
            </div>

            <div class="container-fluid users-table-section p-1 mx-auto mt-9">
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
        document.addEventListener('DOMContentLoaded', function() {
            // View Users Button functionality
            document.querySelectorAll('.view-users-btn').forEach(function(button) {
                button.addEventListener('click', function() {
                    // Dummy user data for display (replace with actual dynamic data)
                    const name = 'Shakira Regalado';
                    const email = 'sbr2022-7072-51358@bicol-u.edu.ph';
                    const role = 'Student';
                    const course = 'BSIT 3';
                    const status = 'Active';
                    const block = 'B';

                    // Course name and year extraction
                    const courseName = course.startsWith('BSIT') ? 'BS Information Technology' :
                        course;
                    const year = course.split(' ')[1];
                    const yearDisplay = {
                        '1': '1st Year',
                        '2': '2nd Year',
                        '3': '3rd Year',
                        '4': '4th Year'
                    } [year] || '';

                    // Insert data into modal
                    document.getElementById('modalName').innerText = name;
                    document.getElementById('modalStatus').innerText = status;
                    document.getElementById('modalEmail').innerText = email;
                    document.getElementById('modalCourse').innerText = courseName;
                    document.getElementById('modalYear').innerText = yearDisplay;
                    document.getElementById('modalBlock').innerText = block;

                    // Show user info modal
                    var myModal = new bootstrap.Modal(document.getElementById('userInfoModal'));
                    myModal.show();
                });
            });

            // Edit/Deactivate Button functionality
            const editBtn = document.getElementById('editBtn');
            const deactivateBtn = document.getElementById('deactivateBtn');
            let isEditing = false;

            editBtn?.addEventListener('click', function() {
                if (!isEditing) {
                    editBtn.innerText = 'Save Changes';
                    deactivateBtn.innerText = 'Cancel';
                    isEditing = true;
                } else {
                    // Handle saving changes
                    alert('Changes saved!');
                    resetButtons();
                }
            });

            deactivateBtn?.addEventListener('click', function() {
                if (isEditing) {
                    alert('Edit canceled!');
                    resetButtons();
                } else {
                    var confirmDeactivateModal = new bootstrap.Modal(document.getElementById(
                        'confirmDeactivateModal'));
                    confirmDeactivateModal.show();
                }
            });

            // Confirm deactivation
            document.getElementById('confirmDeactivateBtn')?.addEventListener('click', function() {
                alert('Account deactivated!');
                var confirmDeactivateModal = bootstrap.Modal.getInstance(document.getElementById(
                    'confirmDeactivateModal'));
                confirmDeactivateModal.hide();
            });

            // Reset buttons function
            function resetButtons() {
                editBtn.innerText = 'Edit Account';
                deactivateBtn.innerText = 'Deactivate Account';
                isEditing = false;
            }

            // Role dropdown and permissions link
            const roleDropdown = document.getElementById('modalRole');
            const editPermissionsLink = document.getElementById('editPermissionsLink');

            roleDropdown?.addEventListener('change', function() {
                editPermissionsLink.style.display = (roleDropdown.value === 'role2') ? 'inline-block' :
                    'none';
            });

            // Save changes in Edit Permissions modal
            document.getElementById('saveChangesBtn')?.addEventListener('click', function() {
                closeAndOpenModal('editPermissionsModal', 'userInfoModal');
            });

            // Close Edit Permissions modal and reopen User Info modal
            document.getElementById('closeBtn')?.addEventListener('click', function() {
                closeAndOpenModal('editPermissionsModal', 'userInfoModal');
            });

            // Utility function for closing one modal and opening another
            function closeAndOpenModal(closeModalId, openModalId) {
                var closeModal = bootstrap.Modal.getInstance(document.getElementById(closeModalId));
                closeModal.hide();
                setTimeout(function() {
                    var openModal = new bootstrap.Modal(document.getElementById(openModalId));
                    openModal.show();
                }, 300);
            }
        });
    </script>
@endsection
