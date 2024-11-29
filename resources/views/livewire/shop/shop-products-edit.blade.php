@extends('layouts.shop')

@section('content')
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ asset('css/toggleswitch.css') }}">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
    
     {{-- @if(request()->has('product'))
        @php
            // Fetch the specific product based on the ID from the query string
            $productId = request()->query('product');
            $product = DB::table('products')->where('id', $productId)->first();
        @endphp

        @if($product) --}}

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Edit Product</h2>
    </div>

    @if(session('error'))
        <div class="alert alert-danger">{{ session('error') }}</div>
    @endif

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    
    <form action="{{ route('products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex px-5 py-4 flex-grow-1">
            <div class="container">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-6 d-flex flex-column gap-3">
                        <div class="form-group mb-1">
                            <label for="product_name_{{ $product->id }}" class="fw-bold text-primary">Product Name</label>
                            <input type="text" class="form-control" id="product_name" name="product_name" value="{{ $product->product_name }}" required>                        
                        </div>

                        <div class="form-group mb-1">
                            <label for="product_decription_{{ $product->id }}" class="fw-bold text-primary">Product Description</label>
                            <textarea class="form-control" id="product_description" name="product_description" required>{{ $product->product_decription }}</textarea>                        
                        </div>

                        <div class="form-group mb-3">
                            <label for="image_upload" class="fw-bold text-primary">Upload Image</label>
                            
                            <!-- Drag and Drop Zone -->
                            <div id="drop_zone" class="border p-4 text-center" style="cursor: pointer;">
                                <p class="text-muted">Drag and drop an image here, or click to select one</p>
                                <input type="file" id="image_upload" class="form-control-file d-none" name="product_image" accept="image/*" wire:model="product_image">
                                @if ($product->product_image)
                                    <img src="{{ asset('storage/' . $product->product_image) }}" alt="Product Image" class="img-fluid">
                                @else
                                    <p>No image available</p>
                                @endif                            
                            </div>
                        </div>
                    </div>

                    <!-- Second Column -->
                    <div class="col-md-6 d-flex flex-column gap-3"> 
                        <div class="d-flex justify-content-between align-items-center mb-2">
                            <p class="fw-bold m-0 text-primary">Organize</p>
                            <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="modal" data-bs-target="#addCategoryModal">
                                Add Category
                                <img src="{{ asset('images/add.svg') }}" alt="" style="width: 10px; height: 10px; margin-left: 3px;">
                            </button>
                        </div>
            
                        <!-- Category Selection -->
                        <div class="form-group mb-1">
                            <label for="category" class="fw-bold text-primary">Category</label>
                            <div class="dropdown">
                            <button class="form-select w-100 text-start" 
                                    type="button" 
                                    id="dropdownMenuButton" 
                                    data-bs-toggle="dropdown" 
                                    aria-expanded="false">
                                    {{ $product->category->category_name ?? 'Select Category' }}
                            </button>
                                <ul class="dropdown-menu w-100" aria-labelledby="dropdownMenuButton" id="category-dropdown">
                                    <!-- Categories will be populated by AJAX -->
                                </ul>
                            </div>
                        </div>

                        <!-- Add Category Modal -->
                        <form id="addCategoryForm">
                            @csrf
                            <div id="alert-placeholder">
                                <div class="modal fade" id="addCategoryModal" tabindex="-1" aria-labelledby="addCategoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="addCategoryModalLabel">Add Category</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Form field for Category Name -->
                                                <label for="category_name" class="fw-bold text-primary me-2">Category Name</label>
                                                <div class="form-group mb-2 d-flex align-items-center">
                                                    <input type="text" name="category_name" id="category_name" class="form-control me-2" placeholder="Enter Category Name" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
                                                <button type="button" class="btn btn-primary" id="saveCategoryBtn">Save</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>

                        <!-- Delete Category Modal -->
                        <form id="deleteCategoryForm" action="{{ route('categories.delete', ['id' => $category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE') <!-- Simulates DELETE method -->
                            <div class="modal fade" id="deleteCategoryModal" tabindex="-1" aria-labelledby="deleteCategoryModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="deleteCategoryModalLabel">Delete Category?</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <h6>Are you sure you want to delete the category?</h6>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Cancel</button>
                                            <button type="submit" class="btn btn-danger">Delete</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


                        <!-- Edit Category Modal -->
                        <form id="editCategoryForm" action="{{ route('categories.update', ['id' => $category->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <div id="alert-placeholder">
                                <div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="editCategoryModalLabel">Edit Category</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                <!-- Hidden field for Category ID -->
                                                <input type="hidden" name="category_id" id="edit_category_id">
                                                
                                                <!-- Form field for Editing Category Name -->
                                                <label for="edit_category_name" class="fw-bold text-primary me-2">Category Name</label>
                                                <div class="form-group mb-2 d-flex align-items-center">
                                                    <input type="text" name="category_name" id="edit_category_name" class="form-control me-2" required>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
                                                <button type="submit" class="btn btn-primary">Update</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>


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
                                    <select id="status_id" class="form-select form-control" onchange="toggleQuantity()">
                                        <option value="9" {{ old('status_id', $product->status->id) == 9 ? 'selected' : '' }}>Preorder</option>
                                        <option value="8" {{ old('status_id', $product->status->id) == 8 ? 'selected' : '' }}>Onhand</option>
                                    </select>
                                    @error('status_id') <span class="text-red-500">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-1"> 
                                    <div class="form-group">
                                        <label for="visibility" class="fw-bold text-primary">Visibility</label>
                                        <select id="visibility" class="form-select form-control">
                                            <option value="visible" {{ $product->visibility->visibility_name == 'Visible' ? 'selected' : '' }}>Visible</option>
                                            <option value="hidden" {{ $product->visibility->visibility_name == 'Hidden' ? 'selected' : '' }}>Hidden</option>
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
                                        <input type="number" class="form-control" id="supplier_price" name="supplier_price" value="{{ $product->supplier_price }}" required>                                        
                                        @error('supplier_price') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6 mt-3"> 
                                    <div class="form-group">
                                        <label for="price" class="fw-bold text-primary">Price</label>
                                        <input type="number" class="form-control" id="retail_price" name="retail_price" value="{{ $product->retail_price }}" required>                                        
                                        @error('retail_price') <span class="text-red-500">{{ $message }}</span> @enderror
                                    </div>
                                </div>

                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="quantity_id" id="quantity" class="fw-bold text-primary">Quantity</label>
                                        <div class="input-group quantity-selector quantity-selector-sm">
                                            <input type="number" id="quantity_id" class="form-control" value="{{ $product->stocks }} placeholder="e.g. 10" min="0" step="1"  required>
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
                    <button type="submit" class="btn btn-primary" id="saveEditBtn">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
   
{{-- 
    @else
            <div class="alert alert-warning">
                Product not found.
            </div>
        @endif
    @else
        <div class="alert alert-warning">
            No product ID provided. Please select a product to edit.
        </div>
    @endif --}}
</div>


<script>

    $(document).ready(function () {
        $('#saveCategoryBtn').on('click', function (e) {
            e.preventDefault();

            // Gather form data
            const categoryName = $('#category_name').val();
            const csrfToken = $('input[name="_token"]').val();

            // Send AJAX request
            $.ajax({
                url: "{{ route('categories.add') }}", // Ensure this matches your route
                method: "POST",
                data: {
                    _token: csrfToken,
                    category_name: categoryName,
                },
                success: function (response) {
                    if (response.success) {
                        $('#addCategoryModal').modal('hide'); // Close modal
                        $('#category_name').val(''); // Clear input field
                        location.reload();
                    } else {
                        alert(response.message); // Show error message
                    }
                },
                error: function (xhr) {
                    alert('An error occurred. Please try again.');
                    console.log(xhr.responseText); // Debugging
                },
            });
        });
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

        // Fetch categories using AJAX
        const selectedCategoryId = document.getElementById('dropdownMenuButton').getAttribute('data-selected-category-id'); 
        fetchCategories(selectedCategoryId);

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
        
       
        // Fetch categories via AJAX and highlight the selected one
        function fetchCategories(selectedCategoryId = null) {
            fetch('/api/categories') // Update with your correct API route
                .then(response => response.json())
                .then(data => {
                    populateCategoryDropdown(data.categories, selectedCategoryId);
                })
                .catch(error => {
                    console.error('Error fetching categories:', error);
                });
        }

        // Populate the dropdown with categories and highlight the selected one
        function populateCategoryDropdown(categories, selectedCategoryId) {
            const dropdown = document.getElementById('category-dropdown');
            const dropdownButton = document.getElementById('dropdownMenuButton');
            dropdown.innerHTML = ''; // Clear existing options

            categories.forEach(category => {
                const listItem = document.createElement('li');
                listItem.className = 'dropdown-item d-flex justify-content-between align-items-center';
                listItem.setAttribute('onclick', `selectCategory('${category.id}', '${category.category_name}')`);

                // Highlight the selected category
                if (category.id == selectedCategoryId) {
                    selectedCategoryName = category.category_name; // Update label to selected category
                }

                listItem.innerHTML = `
                    <span>${category.category_name}</span>
                    <div class="d-flex justify-content-end">
                        <button class="btn p-0" onclick="openEditModalHandler('${category.id}', '${category.category_name}');">
                            <img src="/images/edit.svg" alt="edit" style="width: 15px; height: 15px; margin-right: 5px;">
                        </button>
                        <button class="btn p-0" onclick="deleteCategoryHandler(event, '${category.id}');">
                            <img src="/images/delete.svg" alt="delete" style="width: 15px; height: 15px;">
                        </button>
                    </div>
                `;
                dropdown.appendChild(listItem);
            });

            // Update dropdown button text
            dropdownButton.textContent = selectedCategoryName;
        }

        // Function to handle category selection
        function selectCategory(id, name) {
            const dropdownButton = document.getElementById('dropdownMenuButton');
            dropdownButton.textContent = name;
            console.log(`Selected Category ID: ${id}, Name: ${name}`);
        }

    });

    // Function to handle the edit button click
    function openEditModalHandler(categoryId, categoryName) {
        const form = document.getElementById('editCategoryForm');
        form.action = `/shop/products/edit/categories/${categoryId}`; // Ensure categoryId is passed correctly

        // Set the values in the form fields
        document.getElementById('edit_category_id').value = categoryId;  // Set category ID in hidden input
        document.getElementById('edit_category_name').value = categoryName;  // Set category name in input field

        // Show the modal
        var myModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        myModal.show();
    }

    function deleteCategoryHandler(event, categoryId) {
        event.preventDefault();

        // Set the form action dynamically based on the category ID
        const deleteForm = document.getElementById('deleteCategoryForm');
        deleteForm.action = `/shop/products/edit/categories/${categoryId}`;

        // Show the modal
        const deleteModal = new bootstrap.Modal(document.getElementById('deleteCategoryModal'));
        deleteModal.show();
    }
   
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

    function toggleQuantity() {
        const statusSelect = document.getElementById('status_id');
        const quantityInput = document.getElementById('quantity_id');
        const quantityInput1 = document.getElementById('quantity_1');
        const quantityTitle = document.getElementById('quantity');
        const quantityTitle2 = document.getElementById('quantity_1');
        const variationToggle = document.getElementById('variationToggle');

        if (statusSelect.value === '9' || variationToggle.checked) { //Hides the quantity field
            quantityInput.style.display = 'none';
            quantityTitle.style.display = 'none';
            
            //Hide the quantity in the hidden fields
            if (statusSelect.value === '9') {
                quantityTitle2.style.visibility = 'hidden'; 
                quantityInput1.style.display = 'none';
            } else {
                quantityTitle2.style.visibility = 'visible'; 
                quantityInput1.style.display = 'block';
            }
        } else if (statusSelect.value === '8' && !variationToggle.checked){ //Shows the quantity field
            quantityInput.style.display = 'block';
            quantityTitle.style.display = 'block';
        }
    }

</script>

@endsection
