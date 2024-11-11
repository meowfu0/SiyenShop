@extends('layouts.admin')

@section('content')

<div class="flex-grow-1" style="width: 100%!important;">
    @include('components.profilenav')
    <!-- Welcome Message Below Navbar -->

    <div class="container-fluid data-table-section mt-5">
        <div class="top-section d-flex align-items-center w-85 mx-auto mb-2">
            <div class="search-container d-flex align-items-center rounded p-1" style="width: 300px;">
                <i class="fa fa-search"></i>
                <input type="search" class="searchbox ms-2" placeholder="Search" />
            </div>
            <div class="button-container d-flex align-items-center">
                <div class="dropdown-container me-3">
                    <span class="me-2">Course</span>
                    <select class="course-dropdown">
                        <option value="course1" selected>BS Information Technology</option>
                        <option value="course2">BS Computer Science</option>
                        <option value="course3">BS Biology</option>
                        <option value="course4">BS Chemistry</option>
                        <option value="course5">BS Meteorology</option>
                    </select>
                </div>
                <button class="btn btn-outline-secondary custom" onclick="createShopPage()">Create Shop <i class="fa fa-plus"></i></button>
            </div>
        </div>

        <!-- Table Section -->
        <div class="container-fluid users-table-section p-1 mx-auto">
            <div class="table-responsive">
                <table class="table table-hover text-center w-100">
                    <thead>
                        <tr>
                            <th scope="col">Profile Picture</th>
                            <th scope="col">Store Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Business Manager</th>
                            <th scope="col">Status</th>
                            <th scope="col"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($shops as $shop)
                        <tr>
                            <td scope="row" class="align-middle">
                                <img src="{{ asset('images/'. $shop->shop_logo) }}" 
                                     alt="Profile Picture" 
                                     class="img-fluid rounded-circle profile-data-table" 
                                     style="width: 40px; height: 40px;">
                            </td>
                            <td class="text-center align-middle">{{ $shop->shop_name}}</td>
                            <td class="text-center align-middle">{{ $shop->course->course_name }}</td>
                            <td class="text-center align-middle">{{ $shop->user->first_name. " ". $shop->user->last_name}}</td> <!-- Joined role name -->
                            <td class="text-center align-middle">{{ $shop->status->status_name ?? 'No status assigned'}}</td>
                            <td class="text-center align-middle">
                                <button class="btn btn-outline-secondary fs-2 p-1 px-2" data-bs-toggle="modal" data-bs-target="#shopModal" data-user-id="{{ $shop->id }}">View Shop</button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Modal HTML -->
        <div class="modal fade" id="shopModal" tabindex="-1" aria-labelledby="shopModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content p-3">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="d-flex flex-column ">
                        <div class="mb-3 d-flex justify-content-center w-100">
                            <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
                                 class="profile-picture1"
                                 alt="Profile Picture"
                                 style="width: 150px; height: 150px;">
                        </div>
                        <div class="d-flex flex-column justify-content-start px-5">
                            <h3 class="fw-bold">CirCUITS</h3>
                            <p>Bachelor of Science in Information Technology</p>
                            <div class="text-start">
                                <p class="mb-1"><strong>Archie Onoya</strong></p>
                                <p class="m-0">GCash Number: 09123456789</p>
                                <p class="m-0">GCash Receiver: Robert Rodejo</p>
                            </div>
                        </div>
                     

                    </div>
                    <div class="modal-footer mt-2">
                        <button type="button" class="btn btn-secondary p-2" onclick="showDisableAccountModal()">Disable Shop</button>
                        <button type="button" class="btn btn-primary p-2" onclick="updateShop()">Update Shop</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Disable Shop Modal -->
        <div class="modal fade" id="disableAccountModal" tabindex="-1" aria-labelledby="disableAccountModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header border-0">
                        <h5 class="modal-title" id="confirmDeactivateModalLabel">Confirm Disable Shop</h5>
                        <button type="button" class="btn-close" onclick="cancelDisableAccount()" aria-label="Close"></button>
                    </div>
                    <div class="modal-body d-flex justify-content-center align-items-center" style="height: 60px;">
                        <h5>Are you sure you want to disable this account?</h5>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn custom-btn" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Disable</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function createShopPage() {
        window.location.href = "{{ route('admin.createshop') }}";
    }

    function updateShop() {
        window.location.href = "{{ route('admin.updateshop') }}";
    }

    function showDisableAccountModal() {
        var shopModal = bootstrap.Modal.getInstance(document.getElementById('shopModal'));
        if (shopModal) shopModal.hide();
        var disableAccountModal = new bootstrap.Modal(document.getElementById('disableAccountModal'));
        disableAccountModal.show();
    }

    function cancelDisableAccount() {
        var disableAccountModal = bootstrap.Modal.getInstance(document.getElementById('disableAccountModal'));
        if (disableAccountModal) disableAccountModal.hide();
        var shopModal = new bootstrap.Modal(document.getElementById('shopModal'));
        shopModal.show();
    }
</script>

@endsection
