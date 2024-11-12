@extends('layouts.shop')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    @include('components.profilenav')
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{asset('images/Circuits.svg')}}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students </h2>
    </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Product</h2>
    </div>

    <div class="container d-flex justify-content-center py-3">
    <div class="d-flex align-items-center gap-3">

        <!-- Entries per page -->
        <div class="d-flex align-items-center gap-2">
            <select class="form-select form-select-sm" style="width: auto;">
                <option value="10">10</option>
                <option value="20">20</option>
                <option value="30">30</option>
            </select>
            <span class="text-primary">Entries per page</span>
        </div>

        <!-- Search Input -->
        <div class="input-group input-group-sm" style="width: 200px;">
            <span class="input-group-text bg-white border-end-0">
                <img src="{{ asset('images/search.svg') }}" alt="search" style="width: 12px; height: 12px;">
            </span>
            <input type="text" class="form-control border-start-0" placeholder="Search...">
        </div>

        <!-- Stock Level Selector -->
        <div class="d-flex align-items-center gap-2">
            <span class="text-primary fs-4">Stock Level</span>
            <select class="form-select form-select-sm" style="width: auto;">
                <option value="All">All</option>
                <option value="In stock">In Stock</option>
                <option value="Low Stock">Low Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </div>

        <!-- Category Selector -->
        <div class="d-flex align-items-center gap-2">
            <span class="text-primary fs-4">Category</span>
            <select class="form-select form-select-sm" style="width: auto;">
                <option value="All">All</option>
                <option value="Key Holder/Chain">Key Holder/Chain</option>
                <option value="Lanyard">Lanyard</option>
                <option value="Pins">Pins</option>
                <option value="T-shirts">T-shirts</option>
            </select>
        </div>

        <div class="d-flex align-items-center gap-1">
            <!-- Print Icon -->
            <div>
                <img src="{{ asset('images/print.svg') }}" alt="Print" class="img-thumbnail" style="width: 35px; height: 35px;">
            </div>

            <!-- Export Dropdown -->
            <div class="btn-group">
                <img src="{{ asset('images/Export.svg') }}" alt="Export" class="img-thumbnail dropdown-toggle" 
                    style="width: 35px; height: 35px;" data-bs-toggle="dropdown" aria-expanded="false">
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#" id="exportCsv">Export as CSV</a></li>
                    <li><a class="dropdown-item" href="#" id="exportXlsx">Export as XLSX</a></li>
                    <li><a class="dropdown-item" href="#" id="exportPdf">Export as PDF</a></li>
                </ul>
            </div>

            <!-- History Icon -->
            <a href="{{ route('shop.products.history') }}" class="text-decoration-none">
                <img src="{{ asset('images/history.svg') }}" alt="history" class="img-thumbnail" style="width: 35px; height: 35px;">
            </a>

            <!-- Delete Icon -->
            <img src="{{ asset('images/Delete.svg') }}" alt="Delete" class="img-thumbnail" 
                style="width: 35px; height: 35px;" data-bs-toggle="modal" data-bs-target="#deleteModal">
        </div>

        <!-- Add Category Button -->
        <a href="{{ route('shop.products.add') }}" class="text-decoration-none">
            <button type="button" class="btn btn-outline-primary btn-sm">
                Add Category
                <img src="{{ asset('images/add.svg') }}" alt="" style="width: 8px; height: px; margin-left: 3px;">
            </button>
        </a>

    </div>
</div>

<div class="d-flex px-5 py-4 gap-4 flex-grow-1">
    <div class="border border-primary rounded-4 p-4" style="flex: 4;">
        <table id="example" class="table table-hover table-borderless" style="width: 100%;">
            <thead>
                <tr>
                    <td>
                        <input type="checkbox" class="select-all" id="select-all">
                    </td>
                    <th scope="col" class="sortable" data-sort="id">ID <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="thumbnail">Thumbnail</th>
                    <th scope="col" class="sortable" data-sort="name">Name <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="size">Size<i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="price">Price <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="supplier-price">Supplier Price <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="category">Category <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="stocks">Available Stocks <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="status">Status <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="visibility">Visibility <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="stock-level">Stock Level <i class="fas fa-sort"></i></th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="checkbox" class="select-all" id="select-all">
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_name }}" width="50">
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ number_format($product->retail_price, 2) }}</td>
                    <td>{{ number_format($product->supplier_price, 2) }}</td>
                    <td>{{ $product->category->name ?? 'N/A' }}</td>
                    <td>{{ $product->stocks }}</td>
                    <td>{{ $product->status->name ?? 'N/A' }}</td>
                    <td>{{ $product->visibility ? 'Visible' : 'Hidden' }}</td>
                    <td>{{ $product->stocks_level }}</td>
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
        <!-- Previous button -->
        <a class="page-link" href="#" aria-label="Previous" id="prev-page">
            <span aria-hidden="true">&laquo;</span>
        </a>
        
        <!-- Step back button -->
        <a class="page-link" href="#" aria-label="Previous" id="prev-step">
            <span aria-hidden="true">&lsaquo;</span>
        </a>

        <!-- Page Numbers -->
        <a class="page-link" href="#" data-page="1">1</a>
        <a class="page-link" href="#" data-page="2">2</a>
        <a class="page-link" href="#" data-page="3">3</a>
        <a class="page-link" href="#" data-page="4">4</a>
        <a class="page-link" href="#" data-page="5">5</a>

        <!-- Next button -->
        <a class="page-link" href="#" aria-label="Next" id="next-step">
            <span aria-hidden="true">&rsaquo;</span>
        </a>

        <!-- Last button -->
        <a class="page-link" href="#" aria-label="Next" id="next-page">
            <span aria-hidden="true">&raquo;</span>
        </a>
    </div>
</div>













                
    


 

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

<!-- Add Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
@endsection