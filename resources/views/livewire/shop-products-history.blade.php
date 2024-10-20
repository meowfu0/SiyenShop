@extends('layouts.shop')

@section('content')
<link href="{{ asset('css/proct.css') }}" rel="stylesheet">

<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navigation with User Info -->
    <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{ asset('images/user.svg') }}" alt="User Icon">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>  
            @endauth
        </div>
    </div>

    <!-- Title Section -->
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px;">
        <div class="ps-3">
            <img src="{{ asset('images/Circuits.svg') }}" alt="Circuits Icon">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students</h2>
    </div>

    <!-- Product Title Section -->
    <div class="d-flex justify-content-between px-5 py-4">
        <h2 class="fw-bold m-0 text-primary">Product Delete History</h2>
    </div>

    <!-- Filters and Actions Row -->
    <div class="row g-4 px-5">

    <div class="col-md-2 d-flex flex-column px-2">
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
    <div class="col-md-2 d-flex align-items-center">
        <div class="input-group border border-primary rounded-2">
            <span class="input-group-text bg-white border-0">
                <img class="icons" src="{{ asset('images/search.svg') }}" alt="Search">
            </span>
            <input type="search" class="form-control border-0 text-primary" placeholder="Search...">
        </div>
    </div>

    <!-- Action Buttons (Print, Export, Restore) -->
    <div class="col-md-8 d-flex justify-content-end align-items-center gap-2">
        <img class="img-thumbnail" src="{{ asset('images/print.svg') }}" alt="Print" style="width: 35px; height: 35px;">
        <div class="btn-group">
        <img class="img-thumbnail dropdown-toggle" src="{{ asset('images/Export.svg') }}" alt="Export" style="width: 35px; height: 35px;" data-bs-toggle="dropdown" aria-expanded="false">
        <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#" id="exportCsv">Export as CSV</a></li>
            <li><a class="dropdown-item" href="#" id="exportXlsx">Export as XLSX</a></li>
            <li><a class="dropdown-item" href="#" id="exportPdf">Export as PDF</a></li>
        </ul>
    </div>
        <button class="btn-primary p-2 rounded-2 fs-3" data-bs-toggle="modal" data-bs-target="#restoreModal">
            <span>Restore Product</span>
            <img src="{{ asset('images/history.svg') }}" alt="history" class="me-2" style="width: 12px; height: 12px;">
        </button>
    </div>
</div>

<!-- Restore Confirmation Modal -->
<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content border-0 shadow-none">
            <div class="modal-header border-0">
                <h5 class="modal-title" id="restoreModalLabel">Confirm Restoration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to restore this product to history?
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                <button type="button" class="btn btn-primary" id="confirmRestore">Restore Product</button>
            </div>
        </div>
    </div>
</div>

    <!-- Product Table -->
    <div class="d-flex px-5 py-4 gap-4 flex-grow-1" style="max-height: 60%;">
        <div class="border border-primary rounded-4 p-4" style="flex: 4;">
            <table class="table table-hover table-borderless">
                <thead>
                    <tr>
                        <td><input type="checkbox" class="select-all" id="select-all"></td>
                        <th scope="col">ID</th>
                        <th scope="col">Thumbnail</th>
                        <th scope="col">Name</th>
                        <th scope="col">Price</th>
                        <th scope="col">Supplier Price</th>
                        <th scope="col">Available Stocks</th>
                        <th scope="col">Category</th>
                        <th scope="col">Deletion Date</th>
                    </tr>
                </thead>
                <tbody>
             
                    <tr>
                        <td><input type="checkbox" class="select-item"></td>
                        <td>00121</td>
                        <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                        <td>Product Name</td>
                        <td>P 250.00</td>
                        <td>P 250.00</td>
                        <td>20</td>
                        <td>T-shirt</td>
                        <td>09/26/2024</td>
                        <td>
                       <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#restoreModal">
                        <img src="{{ asset('images/history.svg') }}" alt="History" style="width: 20px; height:20px">
                       </button>

                    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content border-0 shadow-none">
                    <div class="modal-body">
                    Are you sure you want to restore this product to history?
                    </div>
                    <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary" id="confirmRestore">Restore Product</button>
                </div>
             </div>
            </div>
          </div>
         </td>
               </tr>
                    <tr>
                        <td><input type="checkbox" class="select-item"></td>
                        <td>00122</td>
                        <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                        <td>Product Name</td>
                        <td>P 250.00</td>
                        <td>P 250.00</td>
                        <td>20</td>
                        <td>T-shirt</td>
                        <td>09/26/2024</td>
                        <td>
                       <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#restoreModal">
                        <img src="{{ asset('images/history.svg') }}" alt="History" style="width: 20px; height:20px">
                       </button>

                    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content border-0 shadow-none">
                    <div class="modal-body">
                    Are you sure you want to restore this product to history?
                    </div>
                    <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary" id="confirmRestore">Restore Product</button>
                </div>
            </div>
        </div>
    </div>
</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="select-item"></td>
                        <td>00123</td>
                        <td><img src="{{ asset('images/lanyard.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                        <td>Lanyard</td>
                        <td>P 160.00</td>
                        <td>P 160.00</td>
                        <td>20</td>
                        <td>Accessories</td>
                        <td>09/26/2024</td>
                        <td>
                       <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#restoreModal">
                        <img src="{{ asset('images/history.svg') }}" alt="History" style="width: 20px; height:20px">
                       </button>

                    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content border-0 shadow-none">
                    <div class="modal-body">
                    Are you sure you want to restore this product to history?
                    </div>
                    <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary" id="confirmRestore">Restore Product</button>
                </div>
            </div>
        </div>
    </div>
</td>
                    </tr>
                    <tr>
                        <td><input type="checkbox" class="select-item"></td>
                        <td>00124</td>
                        <td><img src="{{ asset('images/pins.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                        <td>Pins</td>
                        <td>P 80.00</td>
                        <td>P 80.00</td>
                        <td>26</td>
                        <td>Accessories</td>
                        <td>09/26/2024</td>
                        <td>
                       <button type="button" class="btn btn-link p-0" data-bs-toggle="modal" data-bs-target="#restoreModal">
                        <img src="{{ asset('images/history.svg') }}" alt="History" style="width: 20px; height:20px">
                       </button>

                    <div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                    <div class="modal-content border-0 shadow-none">
                    <div class="modal-body">
                    Are you sure you want to restore this product to history?
                    </div>
                    <div class="modal-footer border-0">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary" id="confirmRestore">Restore Product</button>
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

    <!-- Pagination and Footer -->
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

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>

@endsection
