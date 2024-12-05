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
            <form class="d-flex align-items-center">
                <select name="entries_per_page" id="entries-per-page" class="form-select form-select-sm" style="width: auto;">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                    <option value="All">All</option>
                </select>
                <span class="text-primary">Entries per page</span>
            </form>
        
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
                    <a href="{{ route('print.products') }}" target="_blank">
                        <img src="{{ asset('images/print.svg') }}" alt="Print" class="img-thumbnail" style="width: 35px; height: 35px;">
                    </a>
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
                <a class="text-decoration-none" id="deleteSelectedButton" data-bs-toggle="modal" data-bs-target="#deleteMMultipleConfirmationModal">
                    <img src="{{ asset('images/Delete.svg') }}" alt="Delete" class="img-thumbnail" style="width: 35px; height: 35px;">
                </a>
            </div>

           <!-- Delete Confirmation Modal for Multiple Products -->
            <div class="modal fade" id="deleteMultipleConfirmationModal" tabindex="-1" role="dialog" aria-labelledby="deleteMultipleConfirmationModalLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="deleteMultipleConfirmationModalLabel">Confirm Deletion</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Are you sure you want to delete the selected products?
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                            <form id="deleteMultipleForm" method="POST" action="{{ route('shop.products.delete.multiple') }}" style="display: inline;">
                                @csrf
                                <div id="productIdsToDeleteContainer"></div> <!-- Container for hidden inputs -->
                                <button type="submit" class="btn btn-primary">Delete</button>
                            </form>
                        </div>
                    </div>
                </div>
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
                        <th>
                            <input type="checkbox" class="select-all" id="select-all">
                        </th>
                        <th>ID</th>
                        <th>Thumbnail</th>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Supplier Price</th>
                        <th>Category</th>
                        <th>Available Stocks</th>
                        <th>Status</th>
                        <th>Visibility</th>
                        <th>Stock Level</th>
                        <th></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($products as $product)
                    <tr class="product" data-stocks-level="{{ $product->stocks_level }}">
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
                        <td class="product-category" data-category-id="{{ $product->category_id }}">{{ $product->category_name }}</td>
                        <td>{{ $product->stocks }}</td>
                        <td>{{ $product->status_name }}</td>
                        <td>{{ $product->visibility_name }}</td>
                        <td class="stocks-level" data-category-id="{{$product->stocks_level}}">{{ $product->stocks_level }}</td>

                        <!-- Actions Column -->
                        <td>
                            <div class="dropdown">
                                <img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2 dropdown-toggle" id="dropdownMenuButton{{ $product->id }}" data-bs-toggle="dropdown" aria-expanded="false" style="cursor: pointer;">
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton{{ $product->id }}">
                                    <li>
                                        <a class="dropdown-item" href="{{ route('shop.products.edit', $product->id) }}">Edit</a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" href="#" data-bs-toggle="modal" data-bs-target="#deleteConfirmationModal{{ $product->id }}">Delete</a>
                                    </li>
                                </ul>
                            </div>
                        </td>
                    </tr>

                    <!-- Delete Confirmation Modal -->
                    <div class="modal fade" id="deleteConfirmationModal{{ $product->id }}" tabindex="-1" role="dialog" aria-labelledby="deleteConfirmationModalLabel{{ $product->id }}" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="deleteConfirmationModalLabel{{ $product->id }}">Confirm Deletion</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    Are you sure you want to delete this product?
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                    <form action="{{ route('shop.products.delete', $product->id) }}" method="POST" style="display:inline;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-primary">Delete</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="d-flex px-5 py-4 gap-4 flex-grow-1">
        <p id="pagination-info">Showing 1 to 1 of 1 entries</p>
        <div class="ms-auto">
            <nav aria-label="Page navigation example">
            <ul class="pagination" id="pagination">
                <!-- Pagination buttons will go here -->
            </ul>
            </nav>
        </div>
    </div>
</div>


<script>
    document.addEventListener('DOMContentLoaded', function () {
        const entriesPerPageSelect = document.getElementById('entries-per-page');
        const paginationInfo = document.getElementById('pagination-info');
        const paginationContainer = document.getElementById('pagination');
        const productRows = Array.from(document.querySelectorAll('#example tbody tr'));
        const stockLevelSelect = document.getElementById('stocksLevel');
        const categorySelect = document.getElementById('category-select');
        const searchInput = document.getElementById('search-input');
        
        let currentPage = 1;
        let entriesPerPage = parseInt(entriesPerPageSelect.value);
        let filteredRows = [...productRows]; // Start with all rows as filtered rows
        let totalPages = Math.ceil(filteredRows.length / entriesPerPage);
        const visiblePageCount = 3; // Number of page buttons to show at once
        const halfVisible = Math.floor(visiblePageCount / 2);

        // Function to update the table and pagination
        function updateTable() {
            filteredRows = filterRows(); // Apply filters to the rows
            totalPages = Math.ceil(filteredRows.length / entriesPerPage); // Recalculate total pages
            const startIndex = (currentPage - 1) * entriesPerPage;
            const endIndex = startIndex + entriesPerPage;

            // Update the "Showing" info text
            if (entriesPerPage === -1) {
                paginationInfo.textContent = `Showing all ${filteredRows.length} entries`;
            } else {
                paginationInfo.textContent = `Showing ${startIndex + 1} to ${Math.min(endIndex, filteredRows.length)} of ${filteredRows.length} entries`;
            }

            // Clear existing table rows
            const tableBody = document.querySelector('#example tbody');
            tableBody.innerHTML = '';

            // If "All" is selected, display all rows
            if (entriesPerPage === -1) {
                filteredRows.forEach((row) => {
                    tableBody.appendChild(row); // Add all rows
                });
                paginationContainer.style.display = 'none'; // Hide pagination
            } else {
                // Otherwise, paginate the rows
                const rowsToDisplay = filteredRows.slice(startIndex, endIndex);
                rowsToDisplay.forEach((row) => {
                    tableBody.appendChild(row); // Add the sliced rows
                });
                paginationContainer.style.display = ''; // Show pagination
                updatePagination();
            }
        }

        // Function to filter rows based on the selected stock level, category, and search term
        function filterRows() {
            const selectedStockLevel = stockLevelSelect.value;
            const selectedCategory = categorySelect.value;
            const searchTerm = searchInput.value.toLowerCase(); // Get the search term in lowercase

            return productRows.filter(row => {
                const rowStockLevel = row.getAttribute('data-stocks-level');
                const rowCategory = row.querySelector('.product-category')?.getAttribute('data-category-id');
                const rowText = row.textContent.toLowerCase(); // Get all text in the row for searching

                // Check stock level
                if (selectedStockLevel !== 'All' && rowStockLevel !== selectedStockLevel) {
                    return false;
                }

                // Check category
                if (selectedCategory !== 'All' && rowCategory !== selectedCategory) {
                    return false;
                }

                // Check if the search term exists in the row text
                if (searchTerm && !rowText.includes(searchTerm)) {
                    return false;
                }

                return true;
            });
        }

        // Function to update pagination buttons
        function updatePagination() {
            paginationContainer.innerHTML = ''; // Clear current pagination

            // Add "Previous" button
            const prevLi = document.createElement('li');
            prevLi.classList.add('page-item');
            prevLi.innerHTML = `<a class="page-link" href="#" aria-label="Previous">&lsaquo;</a>`;
            prevLi.addEventListener('click', () => {
                if (currentPage > 1) {
                    currentPage--;
                    updateTable();
                }
            });
            prevLi.classList.toggle('disabled', currentPage === 1);
            paginationContainer.appendChild(prevLi);

            // Calculate start and end page for the visible page range
            let startPage = Math.max(1, currentPage - halfVisible);
            let endPage = Math.min(totalPages, currentPage + halfVisible);

            if (currentPage - halfVisible <= 1) {
                endPage = Math.min(totalPages, visiblePageCount);
            }

            if (currentPage + halfVisible >= totalPages) {
                startPage = Math.max(1, totalPages - visiblePageCount + 1);
            }

            // Add first page if necessary
            if (startPage > 1) {
                const firstLi = document.createElement('li');
                firstLi.classList.add('page-item');
                firstLi.innerHTML = `<a class="page-link" href="#">1</a>`;
                firstLi.addEventListener('click', () => {
                    currentPage = 1;
                    updateTable();
                });
                paginationContainer.appendChild(firstLi);
                if (startPage > 2) {
                    const ellipsisLi = document.createElement('li');
                    ellipsisLi.classList.add('page-item');
                    ellipsisLi.innerHTML = `<a class="page-link" href="#">...</a>`;
                    paginationContainer.appendChild(ellipsisLi);
                }
            }

            // Add page buttons for the range
            for (let i = startPage; i <= endPage; i++) {
                const li = document.createElement('li');
                li.classList.add('page-item');
                li.innerHTML = `<a class="page-link" href="#">${i}</a>`;
                li.addEventListener('click', () => {
                    currentPage = i;
                    updateTable();
                });
                if (i === currentPage) li.classList.add('active');
                paginationContainer.appendChild(li);
            }

            // Add last page if necessary
            if (endPage < totalPages) {
                if (endPage < totalPages - 1) {
                    const ellipsisLi = document.createElement('li');
                    ellipsisLi.classList.add('page-item');
                    ellipsisLi.innerHTML = `<a class="page-link" href="#">...</a>`;
                    paginationContainer.appendChild(ellipsisLi);
                }
                const lastLi = document.createElement('li');
                lastLi.classList.add('page-item');
                lastLi.innerHTML = `<a class="page-link" href="#">${totalPages}</a>`;
                lastLi.addEventListener('click', () => {
                    currentPage = totalPages;
                    updateTable();
                });
                paginationContainer.appendChild(lastLi);
            }

            // Add "Next" button
            const nextLi = document.createElement('li');
            nextLi.classList.add('page-item');
            nextLi.innerHTML = `<a class="page-link" href="#" aria-label="Next">&rsaquo;</a>`;
            nextLi.addEventListener('click', () => {
                if (currentPage < totalPages) {
                    currentPage++;
                    updateTable();
                }
            });
            nextLi.classList.toggle('disabled', currentPage === totalPages);
            paginationContainer.appendChild(nextLi);
        }

        // Event listener for changing entries per page
        entriesPerPageSelect.addEventListener('change', function () {
            entriesPerPage = this.value === 'All' ? -1 : parseInt(this.value);
            currentPage = 1; // Reset to the first page
            updateTable();
        });

        // Event listeners for dropdowns to filter by category and stock level
        stockLevelSelect.addEventListener('change', function () {
            currentPage = 1; // Reset to the first page on filter change
            updateTable();
        });

        categorySelect.addEventListener('change', function () {
            currentPage = 1; // Reset to the first page on filter change
            updateTable();
        });

        // Event listener for search input to filter by search term
        searchInput.addEventListener('input', function () {
            currentPage = 1; // Reset to the first page on search change
            updateTable();
        });

        // Initial table setup
        updateTable();
    });

    document.addEventListener('DOMContentLoaded', function () {
    const deleteSelectedButton = document.getElementById('deleteSelectedButton');
    const selectedCheckboxes = document.querySelectorAll('.select-item');
    const selectAllCheckbox = document.getElementById('select-all');
    const productIdsInputContainer = document.getElementById('productIdsToDeleteContainer'); // Create a container for hidden inputs
    
    // Show the modal when the delete button is clicked
    deleteSelectedButton.addEventListener('click', function () {
        // Clear previous hidden inputs
        productIdsInputContainer.innerHTML = '';

        const selectedProductIds = Array.from(selectedCheckboxes)
            .filter(checkbox => checkbox.checked)
            .map(checkbox => checkbox.getAttribute('data-id'));

        // If no products are selected, prevent modal from opening
        if (selectedProductIds.length === 0) {
            alert('Please select at least one product to delete.');
            return;
        }

        // Create hidden inputs for each selected product ID
        selectedProductIds.forEach(id => {
            const input = document.createElement('input');
            input.type = 'hidden';
            input.name = 'product_ids[]'; // Use the array notation
            input.value = id;
            productIdsInputContainer.appendChild(input);
        });

        // Show the confirmation modal
        const deleteMultipleConfirmationModal = new bootstrap.Modal(document.getElementById('deleteMultipleConfirmationModal'));
        deleteMultipleConfirmationModal.show();
    });

    // Handle select all functionality
    selectAllCheckbox.addEventListener('change', function () {
        selectedCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked; // Check or uncheck all checkboxes based on the "Select All" checkbox
        });
    });

    // Update the "Select All" checkbox state based on individual selections
    selectedCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function () {
            // If any checkbox is unchecked, uncheck the "Select All" checkbox
            if (!this.checked) {
                selectAllCheckbox.checked = false;
            } else {
                // If all checkboxes are checked, check the "Select All" checkbox
                const allChecked = Array.from(selectedCheckboxes).every(checkbox => checkbox.checked);
                selectAllCheckbox.checked = allChecked;
            }
        });
    });
});
</script>


@endsection
