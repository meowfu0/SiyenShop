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


    <div class="container data-table-section mt-5">
        <div class="top-section d-flex align-items-center w-85 mx-auto mb-2">
            <div class="search-container d-flex align-items-center rounded p-1" style="width: 300px;">
                    <i class="fa fa-search"></i>
                    <input type="search" class="searchbox ms-2" placeholder="Search" />
                </div>
            <div class="button-container">
                <div class="dropdown-container">
                <span class="me-2">Course</span>
                <select class="course-dropdown">
                    <option value="course1" selected>BS Information Technology</option>
                    <option value="course2">BS Computer Science</option>
                    <option value="course3">BS Biology</option>
                    <option value="course4">BS Chemistry</option>
                    <option value="course5">BS Meteorology</option>
                </select>
            </div>
            <div>
            <button class="btn btn-outline-secondary custom" onclick="createShopPage()">Create Shop <i class="fa fa-plus"></i></button>
            </div>
            </div>
            

        </div>
        <div div class="container users-table-section p-1 mx-auto mt-9">
            <table class="table table-hover text-center">
            <thead>
                <tr>
                <th scope="col">Profile Picture</th>
                <th scope="col">Store Name</th>
                <th scope="col">Course</th>
                <th scope="col">Business Manager</th>
                <th scope="col">Status</th>
                <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row" style="width: 120px;">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s" alt="Placeholder Image" class="profile-data-table">
                </th>
                <td class="text-center align-middle">CircUITS</td>
                <td class="text-center align-middle">BS Information Technology</td>
                <td class="text-center align-middle">Juan Dela Cruz</td>
                <td class="text-center align-middle">Active</td>
                <td class="text-center align-middle"><button class="btn btn-outline-secondary" data-bs-toggle="modal" data-bs-target="#shopModal">View Shop</button></td>
                </tr>
            </tbody>
            </table>

        </div>

        
<!-- Modal HTML -->
        <div class="modal fade" id="shopModal" tabindex="-1" aria-labelledby="shopModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered modal-dialog-centered">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="text-center">
                        <!-- Placeholder for profile picture -->
                            <div class="mb-3">
                                <!--<img src="https://via.placeholder.com/150" class="rounded-circle" alt="Profile Picture" width="100" height="100">
                                -->

                                <img
                                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
                                    class="profile-picture1"
                                    alt=""
                                />
                            </div>
                            <!-- Shop Information -->
                             <div class="text-center">
                                 <h3>CirCUITS</h3>
                                    <p>Bachelor of Science in Information Technology</p>
                                    
                                    <div class="d-flex">
                                        <div class="text-start">
                                            <p><strong>Archie Onoya</strong></p>
                                            <p>GCash Number: 09123456789</p>
                                            <p>GCash Receiver: Robert Rodejo</p>
                                        </div>
                                    </div>
                             </div>
                           

                            <!-- Status -->
                        
                        </div>
                    </div>
                    
                    <div class="custom modal-footer">
                        <button type="button" class="btn btn-secondary" onclick="showDisableAccountModal()">Disable Shop</button>
                        <button type="button" class="btn btn-primary" onclick="updateShop()">Update Shop</button>
                    </div>
                </div>
            </div>
        </div>

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
                    <button type="button" class="btn custom-btn fs-2 " data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-primary fs-2 "
                        style="width: 130px; height: 40px; border-radius: 8px;"
                        id="confirmDeactivateBtn">Disable</button>
                    </div>
                </div>
            </div>
        </div>

        
    </div>
</div>
<script>
    function createShopPage(){
        window.location.href = "{{ route('admin.createshop') }}";
    }

    function updateShop(){
        window.location.href = "{{ route('admin.updateshop') }}";
    }
    
    function showDisableAccountModal() {
        // Hide first modal 
        var shopModal = bootstrap.Modal.getInstance(document.getElementById('shopModal'));
        if (shopModal) {
            shopModal.hide();
        }

        // Show the second modal 
        var disableAccountModal = new bootstrap.Modal(document.getElementById('disableAccountModal'), {
            backdrop: true  
        });
        disableAccountModal.show();
    }

    function cancelDisableAccount() {
        // Hide the second modal 
        var disableAccountModal = bootstrap.Modal.getInstance(document.getElementById('disableAccountModal'));
        if (disableAccountModal) {
            disableAccountModal.hide();
        }

        // Show the first modal AGAIN
        var shopModal = new bootstrap.Modal(document.getElementById('shopModal'), {
            backdrop: true  
        });
        shopModal.show();
    }

    
</script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>




@endsection
