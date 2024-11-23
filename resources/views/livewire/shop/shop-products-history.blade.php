@extends('layouts.shop')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    @include('components.profilenav')
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{asset('images/Circuits.svg')}}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students</h2>
    </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Product History</h2>
    </div>

    <div class="container py-4">
        <div class="d-flex justify-content-between align-items-center px-5">
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
            </div>

            <div class="d-flex align-items-center gap-3">
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
                </div>

                <!-- Restore Button -->
                <a  class="text-decoration-none">
                <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#restoreModal">
                    Restore Products
                    <img src="{{ asset('images/history.svg') }}" alt="Restore" style="width: 20px; height: 20px; margin-left: 3px;">
                </button>
                </a>
            </div>
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
                        <td>{{ number_format($product->retail_price, 2) }}</td>
                        <td>{{ number_format($product->supplier_price, 2) }}</td>
                        <td class="product-category" data-category-id="{{ $product->category->id }}">{{ $product->category->category_name }}</td>
                        <td>{{ $product->stocks }}</td>
                        <td>{{ $product->status->status_name }}</td>
                        <td>{{ $product->visibility->visibility_name }}</td>
                        <td>{{ $product->stocks_level }}</td>

                        <!-- Actions Column -->
                        <td>
                            <img src="{{ asset('images/history.svg') }}" alt="dotmenu" class="me-2" id="dropdownMenuButton{{ $product->id }}" data-bs-toggle="modal" data-bs-target="#restoreModal">
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
    
        </div>
    </div>
</div>

<div class="modal fade" id="restoreModal" tabindex="-1" aria-labelledby="restoreModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="restoreModalLabel">Confirm Restoration</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                Are you sure you want to restore this product?
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmDelete">Restore</button>
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
                row.style.display = 'none'; // Corrected: Added closing brace
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
