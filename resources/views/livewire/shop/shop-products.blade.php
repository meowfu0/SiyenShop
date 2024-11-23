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
            <!-- Livewire binds the input to the $search property -->
            <input type="text" class="form-control border-start-0" placeholder="Search..." wire:model="search" />
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
                    <li><a class="dropdown-item" href="{{ route('export.csv') }}" id="exportCsv">Export as CSV</a></li>
                    <li><a class="dropdown-item" href="{{ route('export.xlsx') }}" id="exportXlsx">Export as XLSX</a></li>
                    <li><a class="dropdown-item" href="{{ route('export.pdf') }}" id="exportPdf">Export as PDF</a></li>
                </ul>
            </div>

            <!-- History Icon -->
            <a href="{{ route('shop.products.history') }}" class="text-decoration-none">
                <img src="{{ asset('images/history.svg') }}" alt="history" class="img-thumbnail" style="width: 35px; height: 35px;">
            </a>

            <!-- Delete Icon -->
            <a href="{{ route('shop.products.history') }}" class="text-decoration-none">
                <img src="{{ asset('images/Delete.svg') }}" alt="Delete" class="img-thumbnail" 
                    style="width: 35px; height: 35px;" data-bs-toggle="modal" data-bs-target="#deleteModal">
            </a>
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
                    <!-- Select All Checkbox -->
                    <th>
                        <input type="checkbox" class="select-all" id="select-all">
                    </th>
                    <th scope="col" class="sortable" data-sort="id">ID <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="thumbnail">Thumbnail</th>
                    <th scope="col" class="sortable" data-sort="name">Name <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="size">Size <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="price">Price <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="supplier-price">Supplier Price <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="category">Category <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="stocks">Available Stocks <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="status">Status <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="visibility">Visibility <i class="fas fa-sort"></i></th>
                    <th scope="col" class="sortable" data-sort="stock-level">Stock Level <i class="fas fa-sort"></i></th>
                    <th scope="col"></th> 
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <!-- Select Individual Item -->
                    <td>
                        <input type="checkbox" class="select-item" data-id="{{ $product->id }}">
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_image }}" width="50">
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->size }}</td>
                    <td>{{ number_format($product->retail_price, 2) }}</td>
                    <td>{{ number_format($product->supplier_price, 2) }}</td>
                    <td>{{ $product->category->category_name }}</td>
                    <td>{{ $product->stocks }}</td>
                    <td>{{ $product->status->status_name }}</td>
                    <td>{{ $product->visibility->visibility_name }}</td>
                    <td>{{ $product->stocks_level }}</td>

                    <!-- Actions Column -->
                    <td>
                        <div class="dropdown">
                            <!-- Dropdown Button -->
                            <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2 dropdown-toggle" id="dropdownMenuButton{{ $product->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $product->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('shop.products.edit', $product->id) }}">Edit</a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal">Delete</a>
                                </li>
                            </ul>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
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

@endsection
