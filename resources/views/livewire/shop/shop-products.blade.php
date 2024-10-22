@extends('layouts.shop')

@section('content')
    <link href="{{ asset('css/proct.css') }}" rel="stylesheet">

    <div class="flex-grow-1" style="width: 100%!important;">
        <!-- Top Navigation with User Info -->
        @include('components.profilenav')
        <!-- Title Section -->
        <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
            <div class="ps-3">
                <img src="{{ asset('images/Circuits.svg') }}" alt="">
            </div>
            <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students</h2>
        </div>

        <!-- Product Title Section -->
        <div class="d-flex justify-content-between px-5 py-3">
            <h2 class="fw-bold m-0 text-primary">Product</h2>
        </div>

        <!-- Filters and Actions Row -->
        <div class="row g-4 px-5">
            <!-- Entities per page -->
            <div class="col-md-2 d-flex flex-column">
                <div class="d-flex align-items-center gap-2">
                    <select class="border border-primary rounded-2 p-2 text-primary">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                    <p class="fs-3 fw-small m-0 text-primary">Entities per page</p>
                </div>
            </div>

            <!-- Search -->
            <div class="col-md-2 d-flex flex-column">
                <div class="input-group border border-primary rounded-2">
                    <span class="input-group-text bg-white border-0">
                        <img class="icons" src="{{ asset('images/search.svg') }}" alt="search">
                    </span>
                    <input type="search" class="form-control border-0 text-primary" placeholder="Search...">
                </div>
            </div>

            <!-- Category -->
            <div class="col-md-2 d-flex flex-column">
                <div class="d-flex align-items-center gap-2">
                    <p class="fs-3 fw-small m-0 text-primary">Category</p>
                    <select class="border border-primary rounded-2 p-2 text-primary">
                        <option value="All">All</option>
                        <option value="Key Holder/Chain">Key Holder/Chain</option>
                        <option value="Lanyard">Lanyard</option>
                        <option value="Pins">Pins</option>
                        <option value="T-shirts">T-shirts</option>
                    </select>
                </div>
            </div>

            <!-- Stock Level -->
            <div class="col-md-2 d-flex flex-column px-5">
                <div class="d-flex align-items-center gap-2">
                    <p class="fs-3 fw-small m-0 text-primary">Stock Level</p>
                    <select class="border border-primary rounded-2 p-2 text-primary">
                        <option value="All">All</option>
                        <option value="In stock">In Stock</option>
                        <option value="Low Stock">Low Stock</option>
                        <option value="Out of Stock">Out of Stock</option>
                    </select>
                </div>
            </div>

            <!-- Action Buttons (Print, Export, etc.) -->
            <div class="col-md-2 d-flex align-items-center px-3 justify-content-end ">
                <!-- Print Icon (No change) -->
                <img class="img-thumbnail" src="{{ asset('images/print.svg') }}" alt="Print"
                    style="width: 35px; height: 35px;">

                <!-- Export Dropdown -->
                <div class="btn-group">
                    <img class="img-thumbnail dropdown-toggle" src="{{ asset('images/Export.svg') }}" alt="Export"
                        style="width: 35px; height: 35px;" data-bs-toggle="dropdown" aria-expanded="false">
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#" id="exportCsv">Export as CSV</a></li>
                        <li><a class="dropdown-item" href="#" id="exportXlsx">Export as XLSX</a></li>
                        <li><a class="dropdown-item" href="#" id="exportPdf">Export as PDF</a></li>
                    </ul>
                </div>

                <!-- History Navigation -->

                <a href="{{ route('shop.products.history') }}" class="btn btn-primary- position-relative  rounded-2 fs-3">
                    <img class="img-thumbnail" src="{{ asset('images/history.svg') }}" alt="history"
                        style="width: 35px; height: 35px;">
                </a>

                <!-- Delete Modal Trigger -->
                <img class="img-thumbnail" src="{{ asset('images/Delete.svg') }}" alt="Delete"
                    style="width: 35px; height: 35px;" data-bs-toggle="modal" data-bs-target="#deleteModal">
                <!-- Delete Confirmation Modal -->
                <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel"
                    aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content border-0 shadow-none ">
                            <div class="modal-header border-0">
                                <h5 class="modal-title" id="deleteModalLabel">Confirm Deletion</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                Are you sure you want to delete this product?
                            </div>
                            <div class="modal-footer border-0">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                                <button type="button" class="btn btn-primary" id="confirmDelete">Delete Product</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <!-- Add Product Button -->
            <div class="col-md-2 d-flex align-items-center justify-content-center">
                <a href="{{ route('shop.products.add') }}"
                    class="btn btn-primary- position-relative p-2 border rounded-2 fs-3">
                    <span>Add Product</span>
                    <img src="{{ asset('images/add.svg') }}" alt="add" class="me-2"
                        style="width: 12px; height: 12px;">
                </a>
                </a>
            </div>
        </div>

        <!-- Product Table -->
        <div class="d-flex px-5 py-4 gap-4 flex-grow-1" style="max-height: 60%">
            <div class="border border-primary rounded-4 p-4" style="flex: 4;">
                <table class="table table-hover table-borderless">
                    <thead>
                        <tr>
                            <td>
                                <input type="checkbox" class="select-all" id="select-all">
                            </td>
                            <th scope="col">ID</th>
                            <th scope="col">Thumbnail</th>
                            <th scope="col">Name</th>
                            <th scope="col">Price</th>
                            <th scope="col">Category</th>
                            <th scope="col">Available Stocks</th>
                            <th scope="col">Status</th>
                            <th scope="col">Visibility</th>
                            <th scope="col">Stock Level</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>
                                <input type="checkbox" class="select-item">
                            </td>
                            <td>00121</td>
                            <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;">
                            </td>
                            <td>Name</td>
                            <td>P 250.00</td>
                            <td>T-Shirt</td>
                            <td>20</td>
                            <td>Available</td>
                            <td>Visible</td>
                            <td>In Stock</td>
                            <td>
                                <div class="dropdown">
                                    <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu"
                                        class="me-2 dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="cursor: pointer;">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li> <a class="dropdown-item" href="{{ route('shop.products.edit') }}">Edit</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Delete</a>
                                        </li>
                                        <div class="modal fade" id="deleteModal" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow-none">
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this product?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            id="confirmDelete">Delete Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="select-item">
                            </td>
                            <td>00122</td>
                            <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;">
                            </td>
                            <td>Name</td>
                            <td>P 250.00</td>
                            <td>T-Shirt</td>
                            <td>30</td>
                            <td>Available</td>
                            <td>Visible</td>
                            <td>In Stock</td>
                            <td>
                                <div class="dropdown">
                                    <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu"
                                        class="me-2 dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="cursor: pointer;">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li> <a class="dropdown-item" href="{{ route('shop.products.edit') }}">Edit</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Delete</a>
                                        </li>
                                        <div class="modal fade" id="deleteModal" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow-none">
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this product?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            id="confirmDelete">Delete Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <input type="checkbox" class="select-item">
                            </td>
                            <td>00123</td>
                            <td><img src="{{ asset('images/lanyard.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                            <td>Name</td>
                            <td>P 160.00</td>
                            <td>Lanyard</td>
                            <td>30</td>
                            <td>Available</td>
                            <td>Visible</td>
                            <td>In Stock</td>
                            <td>
                                <div class="dropdown">
                                    <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu"
                                        class="me-2 dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="cursor: pointer;">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li> <a class="dropdown-item" href="{{ route('shop.products.edit') }}">Edit</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Delete</a>
                                        </li>
                                        <div class="modal fade" id="deleteModal" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow-none">
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this product?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            id="confirmDelete">Delete Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td>
                                <input type="checkbox" class="select-item">
                            </td>
                            <td>00124</td>
                            <td><img src="{{ asset('images/pins.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                            <td>Name</td>
                            <td>P 80.00</td>
                            <td>Pins</td>
                            <td>30</td>
                            <td>Available</td>
                            <td>Visible</td>
                            <td>In Stock</td>
                            <td>
                                <div class="dropdown">
                                    <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu"
                                        class="me-2 dropdown-toggle" id="dropdownMenuButton1" data-bs-toggle="dropdown"
                                        aria-expanded="false" style="cursor: pointer;">
                                    <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                        <li> <a class="dropdown-item" href="{{ route('shop.products.edit') }}">Edit</a>
                                        </li>
                                        <li> <a class="dropdown-item" href="#" data-bs-toggle="modal"
                                                data-bs-target="#deleteModal">Delete</a>
                                        </li>
                                        <div class="modal fade" id="deleteModal" tabindex="-1"
                                            aria-labelledby="deleteModalLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content border-0 shadow-none">
                                                    <div class="modal-body">
                                                        Are you sure you want to delete this product?
                                                    </div>
                                                    <div class="modal-footer border-0">
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">Cancel</button>
                                                        <button type="button" class="btn btn-danger"
                                                            id="confirmDelete">Delete Product</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </div>
                            </td>
                        </tr>


                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex justify-content-between py-3">
            <div class="footer-btn d-flex align-items-center px-5 py-3">
                <p class="m-0">Showing 1 to 10 of 100 entries</p>
            </div>
            <div class="pagination d-flex align-items-center px-5">
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&laquo;</span>
                </a>
                <a class="page-link" href="#" aria-label="Previous">
                    <span aria-hidden="true">&lsaquo;</span>
                </a>
                <a class="page-link" href="#">1</a>
                <a class="page-link" href="#">2</a>
                <a class="page-link" href="#">3</a>
                <a class="page-link" href="#">4</a>
                <a class="page-link" href="#">5</a>
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&raquo;</span>
                </a>
                <a class="page-link" href="#" aria-label="Next">
                    <span aria-hidden="true">&rsaquo;</span>
                </a>
            </div>
        </div>
    </div>


    <!-- JS for Select All functionality -->
    <script>
        const selectAllCheckbox = document.getElementById('select-all');
        const checkboxes = document.querySelectorAll('.select-item');

        // Add event listener to the 'Select All' checkbox
        selectAllCheckbox.addEventListener('change', function() {
            checkboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
        });

        // Add event listeners to each individual checkbox to update 'Select All' state
        checkboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                if (!this.checked) {
                    selectAllCheckbox.checked = false;
                } else if (Array.from(checkboxes).every(cb => cb.checked)) {
                    selectAllCheckbox.checked = true;
                }
            });
        });
    </script>


    <!-- Include Bootstrap JS for Dropdown functionality -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
@endsection
