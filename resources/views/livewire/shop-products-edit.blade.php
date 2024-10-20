@extends('layouts.shop')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/toggleswitch.css') }}">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</head>

<div class="flex-grow-1" style="width: 100%!important;">
     <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{ asset('images/user.svg') }}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>
            @endauth
        </div>
     </div>
     
     <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height: 70px">
        <div class="ps-3">
            <img src="{{ asset('images/Circuits.svg') }}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students</h2>
     </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Edit Product</h2>
    </div>

    <div class="d-flex px-5 py-4 flex-grow-1">
        <div class="container">
            <div class="row">
                <!-- First Column -->
                <div class="col-md-6 d-flex flex-column gap-3">
                    <div class="form-group mb-1">
                        <label for="product_name" class="fw-bold text-primary">Product Name</label>
                        <input type="text" id="product_name" class="form-control"  value="Circuits T-Shirt" required>
                    </div>

                    <div class="form-group mb-1">
                        <label for="product_description" class="fw-bold text-primary">Product Description</label>
                        <textarea id="product_description" class="form-control" rows="4" required>This is a sample product description for a T-Shirt.</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image_upload" class="fw-bold text-primary">Upload Image</label>
                        
                        <!-- Drag and Drop Zone -->
                        <div id="drop_zone" class="border p-4 text-center" style="cursor: pointer;">
                            <p class="text-muted">Drag and drop an image here, or click to select one</p>
                            <input type="file" id="image_upload" class="form-control-file d-none" accept="image/*">
                            <img id="uploaded_image_preview" class="mt-3" src="{{ asset('images/black code.jpg') }}" alt="Uploaded Image Preview" style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-md-6 d-flex flex-column gap-3"> 
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="fw-bold m-0 text-primary">Organize</p>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal">Edit Category
                            <img src="{{ asset('images/add.svg') }}" alt=""></button>
                    </div>
        
                    <div class="form-group mb-1">
                        <label for="category" class="fw-bold text-primary">Category</label>
                        <select id="category" class="form-select form-control" required>
                            <option value="T-Shirt" selected>T-Shirt</option>
                            <option value="Lanyard">Lanyard</option>
                        </select>
                    </div>

                    <div class="form-group mb-1">
                        <label for="shop_id" class="fw-bold text-primary">Organization</label>
                        <input type="text" id="shop_id" class="form-control" value="Circle of Unified Information Technology Students" readonly disabled> 
                    </div>

                    <div class="col-md-6 gap-3"> 
                        <div class="d-flex justify-content-between align-items-center mt-2">
                            <p class="fw-bold m-0 text-primary">Inventory</p>
                        </div>
                    </div>

                    <form>
                        <div class="row g-2"> 
                            <div class="col-md-6 mb-1"> 
                                <div class="form-group">
                                    <label for="status_id" class="fw-bold text-primary">Status</label>
                                    <select id="status_id" class="form-select form-control" required>
                                        <option value="on-hand" selected>On-Hand</option>
                                        <option value="pre-order">Pre-Order</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-1"> 
                                <div class="form-group">
                                    <label for="visibility" class="fw-bold text-primary">Visibility</label>
                                    <select id="visibility" class="form-select form-control">
                                        <option value="visible" selected>Visible</option>
                                        <option value="hidden">Hidden</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center mt-3 mb-1">
                                <p class="fw-bold m-0 text-primary">Variation</p>
                                <label class="switch">
                                    <input type="checkbox" id="variationToggle" checked>
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <input type="text" class="form-control mb-2" id="disabledInput" aria-label="Disabled input example" disabled style="display:none;">
                        </div>

                        <!-- Hidden Fields -->
                        <div class="row g-3">
                            <div id="inputContainer" class="col-md-12">
                                <div id="hiddenFields">
                                    <table id="myTable" class="table">
                                        <thead>
                                            <tr>
                                                <th class="fw-bold text-primary">Size</th>
                                                <th class="fw-bold text-primary" id="quantity">Quantity</th>
                                                <th class="text-end"></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr id="inputRow_1">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="size_1" class="form-control" value="XL">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" id="quantity_1" class="form-control" value="20" min="0" step="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm" onclick="myDeleteFunction('inputRow_1')">
                                                        <img src="{{ asset('images/Delete.svg') }}" alt="Remove" style="width: 16px; height: 16px; margin-right: 5px;">
                                                    </button>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                    <button id="addNewField" class="btn" type="button" onclick="myCreateFunction()">
                                        <img src="{{ asset('images/add.svg') }}" alt="Add" style="width: 12px; height: 12px;"> Add New Size
                                    </button>

                                </div>
                            </div>
                        </div>

                        <div class="row g-2"> 
                            <div class="col-md-6 mt-3 mb-1"> 
                                <div class="form-group">
                                    <label for="supplier" class="fw-bold text-primary">Supplier Price</label>
                                    <input id="supplier_price" type="text" class="form-control" value="200" required>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3"> 
                                <div class="form-group">
                                    <label for="price" class="fw-bold text-primary">Price</label>
                                    <input id="price" type="text" class="form-control" value="200" required>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="quantity" class="fw-bold text-primary">Quantity</label>
                                    <div class="input-group quantity-selector quantity-selector-sm">
                                        <input type="number" id="quantity_id" class="form-control" min="0" step="1">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('shop.products') }}" class="btn btn-outline-primary me-3">Discard</a>
                <button type="button" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>

    <!-- Category Modal -->
    <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editCategoryModalLabel">Edit Category</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form>
                    <label for="category_name" class="fw-bold text-primary me-2">Category Name</label>
                        <div class="form-group mb-2 d-flex align-items-center">
                            <input type="text" id="category_name" class="form-control me-2" value="T-Shirt">
                            <button type="button" class="btn btn-sm" data-bs-toggle="modal" data-bs-target="#confirmDeleteModal">
                                <img src="{{ asset('images/Delete.svg') }}" alt="Remove" style="width: 16px; height: 16px; margin-right: 5px;">
                            </button>
                        </div>
                    </form>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary">Save</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
                    <button type="button" class="btn btn-primary">Delete</button>
                </div>
            </div>
        </div>
    </div>

</div>




<script>
document.addEventListener('DOMContentLoaded', function() {
    const statusSelect = document.getElementById('status_id');
    const categorySelect = document.getElementById('category');
    const variationToggle = document.getElementById('variationToggle');
    const hiddenFields = document.getElementById('hiddenFields');
    const sizeInput = document.getElementById('size_1');
    const quantityInput = document.getElementById('quantity_1');
    const disabledInput = document.getElementById('disabledInput');
    const quantity = document.getElementById('quantity_id'); 
    const quantityTitle = document.getElementById('quantity');
    
    let currentStatus = '';

    // Function to enable or disable the toggle based on category and status
    function checkToggleAvailability() {
        const category = categorySelect.value;
        currentStatus = statusSelect.value;  // Save the current status

        if (category === 'T-Shirt' && (currentStatus === 'on-hand' || currentStatus === 'pre-order')) {
            // Enable the toggle if category is T-Shirt and status is on-hand or pre-order
            variationToggle.removeAttribute('disabled');
            if (!variationToggle.checked) {
                variationToggle.checked = true; // Ensure the toggle is on if it's not
                disabledInput.style.display ='none';
                hiddenFields.style.display = 'block';
                
                if (currentStatus === 'pre-order') {
                    sizeInput.style.display = 'block'; 
                    quantityInput.style.display = 'none';
                } else if (currentStatus === 'on-hand') {
                    sizeInput.style.display = 'block';
                    quantityInput.style.display = 'block';
                }
            }
            else {
                variationToggle.checked = true; // Ensure the toggle is on if it's not
                disabledInput.style.display ='none';
                hiddenFields.style.display = 'block';
                
                if (currentStatus === 'pre-order') {
                    sizeInput.style.display = 'block'; 
                    quantityInput.style.display = 'none';
                } else if (currentStatus === 'on-hand') {
                    sizeInput.style.display = 'block';
                    quantityInput.style.display = 'block';
                }
            
            }
            
        } else {
            // If the category is changed to something else, handle the toggle accordingly
            if (variationToggle.checked) {
                variationToggle.checked = false; // Reset toggle to off if it was on
            }
            variationToggle.setAttribute('disabled', 'disabled'); // Disable toggle
            hiddenFields.style.display = 'none'; 
            sizeInput.style.display = 'none';
            quantityInput.style.display = 'none';
            quantity.removeAttribute('disabled'); // Enable quantity when toggle is off (only for non-shirts)

            if (currentStatus === 'pre-order') {
                quantity.setAttribute('disabled', 'disabled'); // Disable quantity
            } else {
                quantity.removeAttribute('disabled'); // Enable quantity if it's not pre-order
            }
        }
    }
    quantity.setAttribute('disabled', 'disabled'); // Disable quantity input (for shirt)

    categorySelect.addEventListener('change', checkToggleAvailability);
    statusSelect.addEventListener('change', checkToggleAvailability);
});

//Updated Add Size fields
let rowCount = 1; // Keeps track of the number of rows
    function myCreateFunction() {
        var table = document.getElementById("myTable").getElementsByTagName('tbody')[0];

        var row = table.insertRow();

        row.id = `inputRow_${++rowCount}`; // Set a unique ID for the row

        var sizeCell = row.insertCell(0);
        var quantityCell = row.insertCell(1);
        var deleteCell = row.insertCell(2); // For the delete button

        // Populate the cells with input fields
        sizeCell.innerHTML = `
            <div class="form-group">
                <input type="text" id="size_${rowCount}" class="form-control" placeholder="e.g. XL">
            </div>`;

        // Check the current status to decide whether to show the quantity field
        updateQuantityCell(quantityCell, rowCount);

        quantityCell.classList.add('text-end');
        deleteCell.innerHTML = `
            <button type="button" class="btn btn-sm" onclick="myDeleteFunction('${row.id}')">
                <img src="{{ asset('images/Delete.svg') }}" alt="Remove" style="width: 16px; height: 16px; margin-right: 5px;">
            </button>`;
    }

    // Function to update the quantity cell based on status
    function updateQuantityCell(cell, rowCount) {
        if (document.getElementById('status_id').value === 'pre-order') {
            cell.innerHTML = ''; // Clear the cell for quantity if pre-order
        } else {
            cell.innerHTML = `
                <div class="form-group">
                    <input type="number" id="quantity_${rowCount}" class="form-control" placeholder="e.g. 10" min="0" step="1">
                </div>`;
        }
    }

    // Event listener to handle status change
    document.getElementById('status_id').addEventListener('change', function() {
        var rows = document.getElementById("myTable").getElementsByTagName('tbody')[0].rows;

        for (var i = 0; i < rows.length; i++) {
            var cell2 = rows[i].cells[1]; // Get the second cell (Quantity cell)
            updateQuantityCell(cell2, i + 1); // Update quantity cell for each row
        }
    });

    // Delete the specified row from the table
    function myDeleteFunction(rowId) {
        var row = document.getElementById(rowId);
            if (row) {
                row.remove();
            } else {
                console.error('Row not found:', rowId);
        }
    }


</script>


@endsection
