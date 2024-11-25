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
       <!-- Entries per page Dropdown -->
       <select id="entries-per-page" class="form-select form-select-sm" style="width: auto;">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
            </select>
            <span class="text-primary">Entries per page</span>
    
        <!-- Search Input -->
        <div class="input-group input-group-sm" style="width: 200px;">
            <span class="input-group-text bg-white border-end-0">
                <img src="{{ asset('images/search.svg') }}" alt="search" style="width: 12px; height: 12px;">
            </span>
            <input id="search-input" type="text" class="form-control border-start-0" placeholder="Search...">
        </div>

        <!-- Stock Level Selector -->
        <div class="d-flex align-items-center gap-2">
            <span class="text-primary fs-4">Stock Level</span>
            <select class="form-select form-select-sm" style="width: auto;" id="stocksLevel">
                <option value="All">All</option>
                <option value="In Stock">In Stock</option>
                <option value="Low Stock">Low Stock</option>
                <option value="Out of Stock">Out of Stock</option>
            </select>
        </div>


       <!-- Category Selector -->
        <div class="d-flex align-items-center gap-2">
            <span class="text-primary fs-4">Category</span>
            <select id="category-select" class="form-select form-select-sm" style="width: auto;">
                <option value="All">All</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->category_name }}</option>
                @endforeach
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
            <a class="text-decoration-none">
                <img src="{{ asset('images/Delete.svg') }}" alt="Delete" class="img-thumbnail" 
                    style="width: 35px; height: 35px;" data-bs-toggle="modal" data-bs-target="#deleteModal">
            </a>
        </div>

        <!-- Add Category Button -->
        <a href="{{ route('shop.products.add') }}" class="text-decoration-none">
            <button type="button" class="btn btn-outline-primary btn-sm">
                Add Product
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
                <tr class="product" data-stocks-level="{{ $product->stocks_level }}">
                    <!-- Select Individual Item -->
                    <td>
                        <input type="checkbox" class="select-item" data-id="{{ $product->id }}">
                    </td>
                    <td>{{ $product->id }}</td>
                    <td>
                        <img src="{{ asset('storage/' . $product->product_image) }}" alt="{{ $product->product_image }}" width="50">
                    </td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ number_format($product->retail_price, 2) }}</td>
                    <td>{{ number_format($product->supplier_price, 2) }}</td>
                    <td class="product-category" data-category-id="{{ $product->category_id }}">{{ $product->category_name }}</td> <!-- Access category_name directly -->
                    <td>{{ $product->stocks }}</td>
                    <td>{{ $product->status_name }}</td>
                    <td>{{ $product->visibility_name }}</td>
                    <td class="stocks-level" data-category-id="{{$product->stocks_level}}">{{ $product->stocks_level }}</td>

                    <!-- Actions Column -->
                    <td>
                        <div class="dropdown">
                            <!-- Dropdown Button -->
                            <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2 dropdown-toggle" id="dropdownMenuButton{{ $product->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                            <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $product->id }}">
                                <li>
                                    <a class="dropdown-item" href="{{ route('shop.products.edit', ['product' => $product->id]) }}">Edit</a>
                                </li>
                                <li>
                                <a class="dropdown-item" href="#" wire:click.prevent="confirmDelete({{ $product->id }})" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal">Delete</a>
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
<div class="d-flex justify-content-between align-items-center px-5 py-4 flex-grow-1">
    <p>
        Showing {{ $products->count() }} of {{ $products->total() }} entries.
    </p>
    
        <!--{{ $products->links('') }}-->
    
</div>





<!-- Delete Confirmation Modal -->
<div wire:ignore.self class="modal fade" id="deleteConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteConfirmationModalLabel">Confirm Deletion</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to delete this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmDelete'product' => $product->id]   ">Delete</button>
            </div>
        </div>
    </div>
</div>


<script>
    const selectAllCheckbox = document.getElementById('select-all');
    const checkboxes = document.querySelectorAll('.select-item');
    selectAllCheckbox.addEventListener('change', function() {
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else if (Array.from(checkboxes).every(cb => cb.checked)) {
                selectAllCheckbox.checked = true;
            }
        });
    });

        // Search filter
        document.addEventListener('DOMContentLoaded', function () {
        const searchInput = document.getElementById('search-input');
        const productRows = document.querySelectorAll('#example tbody tr');

        searchInput.addEventListener('input', function () {
            const searchTerm = this.value.toLowerCase(); // Get the search term and convert to lowercase

            productRows.forEach(row => {
                const cells = row.querySelectorAll('td'); // Select all <td> elements in the row
                let rowContainsSearchTerm = false; // Flag to check if the row contains the search term

                // Check each cell in the row
                cells.forEach(cell => {
                    const cellText = cell.textContent.toLowerCase(); // Get the text content of the cell
                    if (cellText.includes(searchTerm)) {
                        rowContainsSearchTerm = true; // Set the flag to true if the cell matches
                    }
                });

                // Show or hide the row based on whether it contains the search term
                if (rowContainsSearchTerm) {
                    row.style.display = ''; // Show the row
                } else {
                    row.style.display = 'none'; // Hide the row
                }
            });
        });
    });

    //stocks level and category filter
    document.addEventListener('DOMContentLoaded', function () {
        const categorySelect = document.getElementById('category-select');
        const stockLevelSelect = document.getElementById('stocksLevel');
        const productRows = document.querySelectorAll('#example tbody tr');

        function filterProducts() {
            const selectedCategory = categorySelect.value;
            const selectedStockLevel = stockLevelSelect.value.trim();

            console.log('Selected Category:', selectedCategory); // Debugging line
            console.log('Selected Stock Level:', selectedStockLevel); // Debugging line

            productRows.forEach(row => {
                const categoryCell = row.querySelector('.product-category');
                const categoryId = categoryCell.getAttribute('data-category-id');
                const productStockLevel = row.getAttribute('data-stocks-level'); // Get the stock level from the row

                let showRow = true; // Assume we want to show the row

                // Check category filter
                if (selectedCategory !== 'All' && selectedCategory !== categoryId) {
                    showRow = false; // Hide if category doesn't match
                }

                // Check stock level filter
                if (selectedStockLevel !== 'All' && selectedStockLevel !== productStockLevel) {
                    showRow = false; // Hide if stock level doesn't match
                }

                // Show or hide the row based on the filters
                row.style.display = showRow ? '' : 'none';
            });
        }

        // Event listeners for both dropdowns
        categorySelect.addEventListener('change', filterProducts);
        stockLevelSelect.addEventListener('change', filterProducts);
    });

    document.addEventListener('DOMContentLoaded', function () {
        const entriesPerPageSelect = document.getElementById('entries-per-page');
        const productRows = document.querySelectorAll('#example tbody tr');

        // Define the options you want to show in the dropdown
        const options = [10, 20, 30];
        console.log('Options to populate:', options); // Log the options array

        // Clear existing options
        entriesPerPageSelect.innerHTML = '';

        // Populate the dropdown with options
        options.forEach(option => {
            const opt = document.createElement('option');
            opt.value = option;
            opt.textContent = option;
            entriesPerPageSelect.appendChild(opt);
            console.log('Added option:', option); // Log each added option
        });

        // Set the default value to 10
        entriesPerPageSelect.value = '10'; // Set the default value to 10
        console.log('Default value set to:', entriesPerPageSelect.value); // Log the default value

        // Function to update displayed rows based on selected entries per page
        function updateDisplayedRows() {
            const selectedValue = parseInt(entriesPerPageSelect.value, 10);
            console.log('Selected entries per page:', selectedValue); // Log the selected value

            // Hide all rows initially
            productRows.forEach(row => {
                row.style.display = 'none';
                console.log(row);
            });

            // Show the selected number of rows
            for (let i = 0; i < selectedValue && i < productRows.length; i++) {
                productRows[i].style.display = ''; // Show the row
            }
        }

        // Initial display based on default value
        updateDisplayedRows();

        // Add event listener to update displayed rows when selection changes
        entriesPerPageSelect.addEventListener('change', updateDisplayedRows);
    });
</script>

@endsection
