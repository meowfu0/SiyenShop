@extends('layouts.shop')

@section('content')
<head>
    <link rel="stylesheet" href="{{ asset('css/toggleswitch.css') }}">
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
    
     @if(request()->has('product'))
        @php
            // Fetch the specific product based on the ID from the query string
            $productId = request()->query('product');
            $product = DB::table('products')->where('id', $productId)->first();
        @endphp

        @if($product)

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Edit Product</h2>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form action="{{ route('shop.products.update', $product->id) }}" method="POST">
        @csrf
        <div class="d-flex px-5 py-4 flex-grow-1">
            <div class="container">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-6 d-flex flex-column gap-3">
                        <div class="form-group mb-1">
                            <label for="product_name_{{ $product->id }}" class="fw-bold text-primary">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="" required>                        
                        </div>

                        <div class="form-group mb-1">
                            <label for="product_decription_{{ $product->id }}" class="fw-bold text-primary">Product Description</label>
                            <textarea class="form-control" id="product_description" name="product_description" required></textarea>                        
                        </div>

                        <div class="form-group mb-3">
                            <label for="image_upload" class="fw-bold text-primary">Upload Image</label>
                            
                            <!-- Drag and Drop Zone -->
                            <div id="drop_zone" class="border p-4 text-center" style="cursor: pointer;">
                                <p class="text-muted">Drag and drop an image here, or click to select one</p>
                                <input type="file" id="image_upload" class="form-control-file d-none" accept="image/*" wire:model="product_image">
                                <img id="uploaded_image_preview" class="mt-3 d-none" src="" alt="Uploaded Image Preview" style="max-width: 100%; height: auto;">
                            </div>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6 d-flex flex-column gap-3"> 
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="fw-bold m-0 text-primary">Organize</p>
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#editCategoryModal" onclick="resetModal()">
                                Add Category
                                <img src="{{ asset('images/add.svg') }}" alt="" style="width: 10px; height: 10px; margin-left: 3px;">
                            </button>
                        </div>
            
                        <!-- Category Selection -->
                        <div class="form-group mb-1">
                            <label for="category" class="fw-bold text-primary">Category</label>
                            <div class="dropdown">
                                <button class="form-select w-100 text-start" type="button" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    Select Category
                                </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" id="category-dropdown">
                                    <li class="dropdown-item d-flex justify-content-between align-items-center" onclick="selectCategory('T-Shirt')">
                                        <span>T-Shirt</span>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn p-0" onclick="openEditModal('T-Shirt'); event.stopPropagation();">
                                                <img src="{{ asset('images/edit.svg') }}" alt="edit" style="width: 15px; height: 15px; margin-right: 5px;">
                                            </button>
                                            <button class="btn p-0" onclick="deleteCategory('T-Shirt'); event.stopPropagation();">
                                                <img src="{{ asset('images/delete.svg') }}" alt="delete" style="width: 15px; height: 15px;">
                                            </button>
                                        </div>
                                    </li>
                                    <li class="dropdown-item d-flex justify-content-between align-items-center" onclick="selectCategory('Lanyard')">
                                        <span>Lanyard</span>
                                        <div class="d-flex justify-content-end">
                                            <button class="btn p-0" onclick="openEditModal('Lanyard'); event.stopPropagation();">
                                                <img src="{{ asset('images/edit.svg') }}" alt="edit" style="width: 15px; height: 15px; margin-right: 5px;">
                                            </button>
                                            <button class="btn p-0" onclick="deleteCategory('Lanyard'); event.stopPropagation();">
                                                <img src="{{ asset('images/delete.svg') }}" alt="delete" style="width: 15px; height: 15px;">
                                            </button>
                                        </div>
                                    </li>
                                </ul>
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
                                        <form id="editCategoryForm">
                                            <label for="category_name" class="fw-bold text-primary me-2">Category Name</label>
                                            <div class="form-group mb-2 d-flex align-items-center">
                                                <input type="text" id="category_name" class="form-control me-2" value="">
                                            </div>
                                        </form>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
                                        <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save</button>
                                    </div>
                                </div>
                            </div>
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
                                    <label for="status_id" class="fw-bold text-primary">Status</label>
                                    <select id="status_id" class="form-select form-control" onchange="toggleQuantity()"  wire:model="status_id">
                                        <option value="">Select Status</option>
                                            <option value="preorder" {{ old('status_id') == 'preorder' ? 'selected' : '' }}>Preorder</option>
                                            <option value="onhand" {{ old('status_id') == 'onhand' ? 'selected' : '' }}>Onhand</option>
                                        </select>
                                    @error('status_id') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-1"> 
                                    <div class="form-group">
                                        <label for="visibility" class="fw-bold text-primary">Visibility</label>
                                        <select id="visibility" class="form-select form-control" wire:model="visibility_id">
                                            <option value="">Select Visibility</option>
                                            <option value="visible" {{ old('visibility_id') == 'visible' ? 'selected' : '' }}>Visible</option>
                                            <option value="hidden" {{ old('visibility_id') == 'hidden' ? 'selected' : '' }}>Hidden</option>
                                        </select>
                                        @error('visibility_id') <span class="text-red-500">{{ $message }}</span> @enderror

                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <div class="d-flex justify-content-between align-items-center mt-3 mb-1">
                                    <p class="fw-bold m-0 text-primary">Size Variation</p>
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
                                    <div id="hiddenFields" style="display: none;">
                                        <table id="myTable" class="table">
                                            <thead>
                                                <tr>
                                                    <th class="fw-bold text-primary">Size</th>
                                                    <th class="fw-bold text-primary" id="quantity_1">Quantity</th>
                                                    <th class="text-end"></th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <tr id="inputRow_1">
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="text" id="size_1" class="form-control" placeholder="e.g. XL">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" class="form-control" placeholder="e.g. 10" min="0" step="1">
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
                                        <input type="number" class="form-control" id="supplier_price" name="supplier_price" value="" required>                                        
                                        @error('supplier_price') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3"> 
                                    <div class="form-group">
                                        <label for="price" class="fw-bold text-primary">Price</label>
                                        <input type="number" class="form-control" id="retail_price" name="retail_price" value="" required>                                        
                                        @error('retail_price') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="quantity_id" id="quantity" class="fw-bold text-primary">Quantity</label>
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
                    <button type="submit" class="btn btn-primary">Save Changes</a>
                </div>

            </div>
        </div>
   

    @else
            <div class="alert alert-warning">
                Product not found.
            </div>
        @endif
    @else
        <div class="alert alert-warning">
            No product ID provided. Please select a product to edit.
        </div>
    @endif
</div>


<script>

    function toggleQuantity() {
        const statusSelect = document.getElementById('status_id');
        const quantityInput = document.getElementById('quantity_id');
        const quantityTitle = document.getElementById('quantity');
        const quantityTitle2 = document.getElementById('quantity_1');
        const variationToggle = document.getElementById('variationToggle');

        if (statusSelect.value === 'preorder' || variationToggle.checked) { //Hides the quantity field
            quantityInput.style.display = 'none';
            quantityTitle.style.display = 'none';
            
            //Hide the quantity in the hidden fields
            if (statusSelect.value === 'preorder') {
                quantityTitle2.style.visibility = 'hidden'; 
            } else {
                quantityTitle2.style.visibility = 'visible'; 
            }
        } else if (statusSelect.value === 'onhand' && !variationToggle.checked){ //Shows the quantity field
            quantityInput.style.display = 'block';
            quantityTitle.style.display = 'block';
        }
    }

    function openEditModal(category) {
        // Set the value of the input to the category name
        document.getElementById('category_name').value = category;

        // Show the modal
        const modal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        modal.show();

        // Handle the Save button click
        document.getElementById('saveCategoryBtn').onclick = function() {
            saveCategory(category);
            modal.hide();
        };
    }

    function selectCategory(category) {
        // Update the button text
        document.getElementById('dropdownMenuButton').innerText = category;

        // Close the dropdown
        const dropdown = new bootstrap.Dropdown(document.getElementById('dropdownMenuButton'));
        dropdown.hide(); // This will close the dropdown
    }

    function resetModal() {
        const categoryInput = document.getElementById('category_name');
        categoryInput.value = ''; // Clear the input field
        categoryInput.placeholder = 'Input Text'; // Reset the placeholder if needed
        document.getElementById('editCategoryModalLabel').textContent = 'Add Category';
    }

    function saveCategory(oldCategory) {
        const newCategory = document.getElementById('category_name').value.trim();
        if (newCategory && newCategory !== oldCategory) {
            const items = document.querySelectorAll('#category-dropdown .dropdown-item');
            items.forEach(item => {
                const span = item.querySelector('span');
                if (span.textContent === oldCategory) {
                    span.textContent = newCategory;

                    // Update the onclick function for the buttons
                    item.querySelector('button[onclick^="openEditModal"]').setAttribute('onclick', `openEditModal('${newCategory}')`);
                    item.querySelector('button[onclick^="deleteCategory"]').setAttribute('onclick', `deleteCategory('${newCategory}')`);
                }
            });
        }
    }

    function deleteCategory(category) {
        if (confirm(`Are you sure you want to delete the category "${category}"?`)) {
            const items = document.querySelectorAll('#category-dropdown .dropdown-item');
            items.forEach(item => {
                const span = item.querySelector('span');
                if (span.textContent === category) {
                    item.remove();
                }
            });
        }
    }

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
        if (document.getElementById('status_id').value === 'preorder') {
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

    //Uploading Image
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

    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status_id');
        const categorySelect = document.getElementById('category');
        const variationToggle = document.getElementById('variationToggle');
        const hiddenFields = document.getElementById('hiddenFields');
        const sizeInput = document.getElementById('size_1');
        const quantityInput = document.getElementById('quantity_1');
        const disabledInput = document.getElementById('disabledInput');

        // Initial call to set visibility based on default selection
        toggleQuantity();

        variationToggle.addEventListener('change', function() {
            if (variationToggle.checked) {
                hiddenFields.style.display = 'block'; // Show hidden fields
                disabledInput.style.display = 'none';  // Hide the disabled input
            } else {
                hiddenFields.style.display = 'none'; // Hide hidden fields
                disabledInput.style.display = 'block';  // Show the disabled input
            }

            toggleQuantity(); // Call toggleQuantity to handle visibility
        });

        // Attach event listener to status select
        statusSelect.addEventListener('change', toggleQuantity);
    });

</script>

@endsection
