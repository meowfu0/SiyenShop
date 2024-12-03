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
        <h2 class="fw-bold m-0 text-primary"> {{$shop->shop_name}} </h2>
    </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Edit Product</h2>
    </div>

    <form action="{{ route('shop.products.update', $product->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex px-5 py-4 flex-grow-1">
            <div class="container">
                <div class="row">
                    <!-- First Column -->
                    <div class="col-md-6 d-flex flex-column gap-3">
                        <div class="form-group mb-1">
                            <label for="product_name" class="fw-bold text-primary">Product Name</label>
                            <input type="text" name="product_name" id="product_name" class="form-control" value="{{ old('product_name', $product->product_name) }}" required>
                            @error('product_name') <span class="text-danger">{{ $message }}</span> @enderror
                        </div>

                        <div class="form-group mb-1">
                            <label for="product_decription" class="fw-bold text-primary">Product Description</label>
                            <textarea name="product_decription" id="product_decription" class="form-control" required>{{ old('product_decription', $product->product_decription) }}</textarea>
                            @error('product_decription') <span class="text-danger">{{ $message }}</span> @enderror
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
                        <div>
                            <!-- Category Selection -->
                            <div class=" form-group mb-1">
                                <label for="category" class="fw-bold text-primary">Category</label>
                                <select name="category_id" id="category_id" class="form-select" required>
                                    <option value="" disabled>Select a category</option>
                                    @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->category_name }}
                                    </option>
                                    @endforeach
                                </select>
                                @error('category_id') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            <form wire:submit.prevent="save">
                                                <label for="category_name" class="fw-bold text-primary me-2">Category Name</label>
                                                <div class="form-group mb-2 d-flex align-items-center">
                                                    <input type="text" id="category_name" class="form-control me-2" wire:model="categoryName">
                                                </div>
                                                @error('categoryName') <span class="text-danger">{{ $message }}</span> @enderror
                                            </form>
                                        </div>
                                        <div class="modal-footer">
                                            <button type="button" class="btn btn-outline-primary" data-bs-dismiss="modal">Discard</button>
                                            <button type="submit" class="btn btn-primary" wire:click="save">Save</button>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group mb-1">
                                <label for="shop_id" class="fw-bold text-primary">Organization</label>
                                <input type="text" id="shop_id" class="form-control" 
                                    value="{{ $shop->shop_name ?? 'No organization assigned' }}" readonly disabled>
                            </div>
                            <div class="col-md-6 gap-3"> 
                                <div class="d-flex justify-content-between align-items-center mt-2">
                                    <p class="fw-bold m-0 text-primary">Inventory</p>
                                </div>
                            </div>

                            <div class="row g-2"> 
                                <div class="col-md-6 mb-1"> 
                                    <label for="status_id" class="form-label">Status</label>
                                    <select name="status_id" id="status_id" class="form-select" required>
                                        <option value="" disabled>Select a status</option>
                                        <option value="9" {{ old('status_id', $product->status_id) == 9 ? 'selected' : '' }}>Pre-Order</option>
                                        <option value="8" {{ old('status_id', $product->status_id) == 8 ? 'selected' : '' }}>On-Hand</option>
                                    </select>
                                    @error('status_id') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>

                                <div class="col-md-6 mb-1"> 
                                    <div class="form-group">
                                        <label for="visibility_id" class="form-label">Visibility</label>
                                        <select name="visibility_id" id="visibility_id" class="form-select" required>
                                            <option value="" disabled>Select visibility</option>
                                            <option value="1" {{ old('visibility_id', $product->visibility_id) == 1 ? 'selected' : '' }}>Visible</option>
                                            <option value="2" {{ old('visibility_id', $product->visibility_id) == 2 ? 'selected' : '' }}>Hidden</option>
                                        </select>
                                        @error('visibility_id') <span class="text-danger">{{ $message }}</span> @enderror
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
                                            @foreach ($variants as $variant)
                                                
                                            
                                            <tr id="inputRow_1">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="size_1" class="form-control" value="{{$variant->size}}">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" class="form-control" value="{{$variant->stock}}" min="0" step="1">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn btn-sm" onclick="myDeleteFunction('inputRow_1')">
                                                        <img src="{{ asset('images/Delete.svg') }}" alt="Remove" style="width: 16px; height: 16px; margin-right: 5px;">
                                                    </button>
                                                </td>
                                            </tr>
                                            @endforeach
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
                                    <label for="supplier_price" class="form-label">Supplier Price</label>
                                    <input type="number" name="supplier_price" id="supplier_price" class="form-control" step="0.01" value="{{ old('supplier_price', $product->supplier_price) }}" required>
                                    @error('supplier_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="col-md-6 mt-3"> 
                                <div class="form-group">
                                    <label for="retail_price" class="form-label">Retail Price</label>
                                    <input type="number" name="retail_price" id="retail_price" class="form-control" step="0.01" value="{{ old('retail_price', $product->retail_price) }}" required>
                                    @error('retail_price') <span class="text-danger">{{ $message }}</span> @enderror
                                </div>
                            </div>

                            <div class="row g-2"> 
                                <div class="col-md-6"> 
                                    <div class="form-group">
                                        <label for="stocks" id="stock" class="form-label">Stocks</label>
                                        <input type="number" name="stocks" id="stocks" class="form-control" value="{{ old('stocks', $product->stocks) }}">
                                        @error('stocks') <span class="text-danger">{{ $message }}</span> @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Submit Button -->
                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ route('shop.products') }}" class="btn btn-outline-primary me-2">Discard</a>
                    <button type="submit" class="btn btn-primary">Save Changes</button>
                </div>
            </div>
        </div>
    </form>
</div>

<script>
    function toggleQuantity() {
        const statusSelect = document.getElementById('status_id');
        const stocksTitle = document.getElementById('stock'); 
        const quantityTitle = document.getElementById('quantity_1');
        const variationToggle = document.getElementById('variationToggle');
        const stocksInput = document.getElementById('stocks');

        // Handle stocks input visibility
        if (statusSelect.value === '9' || variationToggle.checked) { 
            stocksInput.style.display = 'none';
            stocksTitle.style.display = 'none';
            if (statusSelect.value === '9' && variationToggle.checked) { 
                quantityTitle.style.display = 'none';
            }
            else if (statusSelect.value === '8' && variationToggle.checked) { 
                quantityTitle.style.display = 'block';
            }

        } else if (statusSelect.value === '8') { 
            stocksInput.style.display = 'block';
            stocksTitle.style.display = 'block';
            quantityTitle.style.display = 'block';

        }


    }

    document.addEventListener('DOMContentLoaded', function() {
        const statusSelect = document.getElementById('status_id');
        const variationToggle = document.getElementById('variationToggle');
        const hiddenFields = document.getElementById('hiddenFields');
        const sizeInput = document.getElementById('size_1'); 
        const quantityInput = document.getElementById('quantity_1'); 
        const disabledInput = document.getElementById('disabledInput');
        const stocksInput = document.getElementById('stocks');
        const stocksTitle = document.getElementById('stock'); 

        // Initial call to set visibility based on default selection
        toggleQuantity();

        variationToggle.addEventListener('change', function() {
            if (variationToggle.checked) {
                hiddenFields.style.display = 'block'; // Show hidden fields
                disabledInput.style.display = 'none';  // Hide the disabled input
                quantityInput.style.display = 'block'; // Show quantity input if toggle is on
                stocksInput.style.display = 'none'; // Hide stocks input if toggle is on
                stocksTitle.style.display = 'none'; // Hide stocks title if toggle is on
            } else {
                hiddenFields.style.display = 'none'; // Hide hidden fields
                disabledInput.style.display = 'block';  // Show the disabled input
                toggleQuantity(); // Call toggleQuantity to handle visibility
            }
        });

        // Attach event listener to status select
        statusSelect.addEventListener('change', toggleQuantity);
    });

    // Updated Add Size fields
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
        if (document.getElementById('status_id').value === '9') {
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

    document.addEventListener('DOMContentLoaded', function() {
        const dropZone = document.getElementById('drop_zone');
        const fileInput = document.getElementById('image_upload');
        const imagePreview = document.getElementById('uploaded_image_preview');
        const removeButton = document.getElementById('remove_image');

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
                    removeButton.classList.remove('d-none'); // Show the "X" button
                }
                reader.readAsDataURL(file);
            }
        }

        // Remove image and hide button
        removeButton.addEventListener('click', function() {
            imagePreview.classList.add('d-none'); // Hide the image
            removeButton.classList.add('d-none'); // Hide the button
            fileInput.value = ''; // Clear the file input
        });
    });
</script>

@endsection