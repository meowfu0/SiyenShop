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
        <h2 class="fw-bold m-0 text-primary">Add Product</h2>
    </div>

    <div class="d-flex px-5 py-4 flex-grow-1">
        <div class="container">
            <div class="row">
                <!-- First Column -->
                <div class="col-md-6 d-flex flex-column gap-3">
                    <div class="form-group mb-1">
                        <label for="product_name" class="fw-bold text-primary">Product Name</label>
                        <input type="text" id="product_name" class="form-control" placeholder="Input product name" required>
                    </div>

                    <div class="form-group mb-1">
                        <label for="product_description" class="fw-bold text-primary">Product Description</label>
                        <textarea id="product_description" class="form-control" rows="4" placeholder="Input product description"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image_upload" class="fw-bold text-primary">Upload Image</label>
                        
                        <!-- Drag and Drop Zone -->
                        <div id="drop_zone" class="border p-4 text-center" style="cursor: pointer;">
                            <p class="text-muted">Drag and drop an image here, or click to select one</p>
                            <input type="file" id="image_upload" class="form-control-file d-none" accept="image/*">
                            <img id="uploaded_image_preview" class="mt-3 d-none" src="" alt="Uploaded Image Preview" style="max-width: 100%; height: auto;">
                        </div>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-md-6 d-flex flex-column gap-3"> 
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="fw-bold m-0 text-primary">Organize</p>
                        <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">Add Category
                            <img src="{{ asset('images/add.svg') }}" alt=""></button>
                    </div>
        
                    <div class="form-group mb-1">
                        <label for="category" class="fw-bold text-primary">Category</label>
                        <select id="category" class="form-select form-control" required>
                            <option value="">Select Category</option>
                            <option value="T-Shirt">T-Shirt </option>
                            <option value="Lanyard">Lanyard</option>
                        </select>
                    </div>

                    <div id="action-buttons" class="form-group mb-1" style="display: none;">
                        <button type="button" class="btn btn-warning me-2" onclick="editCategory()">Edit</button>
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Delete</button>
                    </div>

                    <div class="form-group mb-1">
                        <label for="shop_id" class="fw-bold text-primary">Organization</label>
                       <!-- <input type="text" id="organization" class="form-control" 
                            value="{{ Auth::user()->organization ?? 'No organization assigned' }}" readonly disabled> for backend part-->
                            <input type="text" id="shop_id" class="form-control" value="Circle of Unified Information Technology Students" readonly disabled> <!-- For frontend part only-->
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
                                        <option value="">Select Status</option>
                                        <option value="on-hand">On-Hand</option>
                                        <option value="pre-order">Pre-Order</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6 mb-1"> 
                                <div class="form-group">
                                    <label for="visibility" class="fw-bold text-primary">Visibility</label>
                                    <select id="visibility" class="form-select form-control">
                                        <option value="">Select Visibility</option>
                                        <option value="visible">Visible</option>
                                        <option value="hidden">Hidden</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="form-group">
                            <div class="d-flex justify-content-between align-items-center mt-3 mb-1">
                                <p class="fw-bold m-0 text-primary">Variation</p>
                                <label class="switch">
                                    <input type="checkbox" id="variationToggle">
                                    <span class="slider round"></span>
                                </label>
                            </div>

                            <input type="text" class="form-control mb-2" placeholder="Disabled" aria-label="Disabled input example" disabled id="disabledInput">
                        </div>

                        <!-- Hidden Fields -->
                        <div class="row g-3">
                            <div id="inputContainer" class="col-md-12">
                                <div id="hiddenFields" style="display:none;">
                                    <div class="col-md-12">
                                    <a href="#" id="addNewField" class="text-primary" style="cursor: pointer;">
                                        <img src="{{ asset('images/search.svg') }}" alt="Add" style="width: 16px; height: 16px;"> Add New Size
                                    </a>
                                    <div class="row g-3 mb-3" id="inputRow_1">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="size_1" class="fw-bold text-primary">Size</label>
                                                <input type="text" id="size_1" class="form-control" placeholder="e.g. XL">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group" id="quantity_1">
                                                <label for="quantity_1" class="fw-bold text-primary">Quantity</label>
                                                <input type="number" id="quantity_1" class="form-control" placeholder="e.g. 10" min="0" step="1">
                                            </div>
                                        </div>
                                        <div class="col-md-2 text-end d-flex align-items-center justify-content-end">
                                            <button type="button" class="btn btn-sm removeField" data-row-id="inputRow_1">
                                                <img src="{{ asset('images/search.svg') }}" alt="Remove" style="width: 16px; height: 16px;">
                                            </button>
                                        </div>
                                    </div>
                                    
                                </div>
                                </div>
                            </div>
                        </div>


                        <div class="row g-2"> 
                            <div class="col-md-6 mt-3 mb-1"> 
                                <div class="form-group">
                                    <label for="supplier" class="fw-bold text-primary">Supplier Price</label>
                                    <input id="supplier_price"  type="text" id="form2" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3"> 
                                <div class="form-group">
                                    <label for="price" class="fw-bold text-primary">Price</label>
                                    <input id="price"  type="text" id="form2" class="form-control" required>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="quantity" class="fw-bold text-primary">Quantity</label>
                                    <div class="input-group quantity-selector quantity-selector-sm">
                                        <input type="number" id="quantity_id" class="form-control" placeholder="e.g. 10" min="0" step="1" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-4">
                <a href="{{ route('shop.products') }}" class="btn btn-outline-primary me-2">Discard</a>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
            
        </div>
    </div>
</div>

<!-- Modal: Add New Category -->
<div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="addCategoryModalLabel">Add New Category</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <div class="form-group">
            <label for="category" class="fw-bold text-primary">Category Name</label>
            <input type="text" id="category" class="form-control" placeholder="Input Category Name">
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
        <button type="button" class="btn btn-primary">Save</button>
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
        

        // Function to enable or disable the toggle based on category and status
        function checkToggleAvailability() {
            const category = categorySelect.value;
            const status = statusSelect.value;

            if (category === 'T-Shirt' && (status === 'on-hand' || status === 'pre-order')) {
                variationToggle.removeAttribute('disabled');
                quantity.setAttribute('disabled', 'disabled');
            } else {
                variationToggle.checked = false; // Reset toggle to off
                variationToggle.setAttribute('disabled', 'disabled');
                hiddenFields.style.display = 'none'; 
                sizeInput.style.display = 'none';
                quantityInput.style.display = 'none';
                quantity.removeAttribute('disabled'); // Enable quantity when toggle is off
            }
        }

        categorySelect.addEventListener('change', checkToggleAvailability);
        statusSelect.addEventListener('change', checkToggleAvailability);

        // Function to handle the toggle switch behavior
        variationToggle.addEventListener('change', function() {
            if (this.checked) {
                disabledInput.style.display = 'none';
                hiddenFields.style.display = 'block';

                if (statusSelect.value === 'pre-order') {
                    sizeInput.style.display = 'block'; 
                    quantityInput.style.display = 'none';
                } else if (statusSelect.value === 'on-hand') {
                    sizeInput.style.display = 'block';
                    quantityInput.style.display = 'block';
                }
                quantity.setAttribute('disabled', 'disabled');
            } else {
                hiddenFields.style.display = 'none';
                sizeInput.style.display = 'none';
                quantityInput.style.display = 'none';
                disabledInput.style.display = 'block';
                quantity.removeAttribute('disabled');
            }
        });
    });

    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('drop_zone');
        const fileInput = document.getElementById('image_upload');
        const imagePreview = document.getElementById('uploaded_image_preview');

        // Click on drop zone triggers the file input click
        dropZone.addEventListener('click', () => {
            fileInput.click();
        });

        // Handle file selection via input
        fileInput.addEventListener('change', handleFile);

        // Drag and Drop Handlers
        dropZone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropZone.classList.add('border-success');
        });

        dropZone.addEventListener('dragleave', () => {
            dropZone.classList.remove('border-success');
        });

        dropZone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropZone.classList.remove('border-success');
            const files = e.dataTransfer.files;
            if (files.length > 0) {
                fileInput.files = files;
                handleFile(); // Show preview
            }
        });

        function handleFile() {
            const file = fileInput.files[0];
            if (file && file.type.startsWith('image/')) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imagePreview.classList.remove('d-none');
                }
                reader.readAsDataURL(file);
            }
        }
    });

    document.addEventListener('DOMContentLoaded', function () {
        let fieldCount = 1; // Initialize counter, starting from 1 as the first row is already present

        // Click event for adding new input fields
        document.getElementById('addNewField').addEventListener('click', function () {
            fieldCount++; // Increment field count

            // Create a new input field row
            const newFieldRow = document.createElement('div');
            newFieldRow.classList.add('row', 'g-3', 'mb-3');
            newFieldRow.id = `inputRow_${fieldCount}`; // Assign unique ID
            newFieldRow.innerHTML = `
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="size_${fieldCount}" class="fw-bold text-primary">Size</label>
                        <input type="text" id="size_${fieldCount}" class="form-control" placeholder="e.g. XL">
                    </div>
                </div>
                <div class="col-md-5">
                    <div class="form-group">
                        <label for="quantity_${fieldCount}" class="fw-bold text-primary">Quantity</label>
                        <input type="number" id="quantity_${fieldCount}" class="form-control" placeholder="e.g. 10" min="0" step="1">
                    </div>
                </div>
                <div class="col-md-2 text-end d-flex align-items-center justify-content-end">
                    <button type="button" class="btn removeField" data-row-id="inputRow_${fieldCount}">
                        <img src="{{ asset('images/search.svg') }}" alt="Remove" style="width: 16px; height: 16px;">
                    </button>
                </div>
            `;

            // Append the new input field row to the container
            document.getElementById('inputContainer').appendChild(newFieldRow);
        });

        // Event delegation to handle the "Move to Trash" (delete) button
        document.addEventListener('click', function (e) {
            if (e.target && e.target.classList.contains('removeField')) {
                const rowId = e.target.getAttribute('data-row-id');
                document.getElementById(rowId).remove(); // Remove the selected input row
            }
        });
    });


</script>

@endsection
