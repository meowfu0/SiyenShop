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
                        <input type="text" id="product_name" class="form-control" placeholder="Input product name" value="Circuits T-Shirt" required>
                    </div>

                    <div class="form-group mb-1">
                        <label for="product_description" class="fw-bold text-primary">Product Description</label>
                        <textarea id="product_description" class="form-control" rows="4" placeholder="Input product description">Sample Circuits T-Shirt description.</textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label for="image_upload" class="fw-bold text-primary">Upload Image</label>
                        
                        <!-- Drag and Drop Zone -->
                        <div id="drop_zone" class="border p-4 text-center" style="cursor: pointer;">
                            <p class="text-muted">Drag and drop an image here, or click to select one</p>
                            <input type="file" id="image_upload" class="form-control-file d-none" accept="image/*">
                            <img id="uploaded_image_preview" class="mt-3 d-none" src="path/to/current_image.jpg" alt="Uploaded Image Preview" style="max-width: 100%; height: auto;">
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
                            <option value="T-Shirt" selected>T-Shirt</option>
                            <option value="Lanyard">Lanyard</option>
                        </select>
                    </div>

                    <div id="action-buttons" class="form-group mb-1" style="display: none;">
                        <button type="button" class="btn btn-warning me-2" onclick="editCategory()">Edit</button>
                        <button type="button" class="btn btn-danger" onclick="deleteCategory()">Delete</button>
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

                            <input type="text" class="form-control mb-2" placeholder="Disabled" aria-label="Disabled input example" disabled id="disabledInput">
                        </div>

                        <!-- Hidden Fields -->
                        <div class="row g-3">
                            <div id="inputContainer" class="col-md-12">
                                <div id="hiddenFields" style="display:block;">
                                    <div class="col-md-12">
                                    <a href="#" id="addNewField" class="text-primary" style="cursor: pointer;">
                                        <img src="{{ asset('images/search.svg') }}" alt="Add" style="width: 16px; height: 16px;"> Add New Size
                                    </a>
                                    <div class="row g-3 mb-3" id="inputRow_1">
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label for="size_1" class="fw-bold text-primary">Size</label>
                                                <input type="text" id="size_1" class="form-control" placeholder="e.g. XL" value="XL">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group" id="quantity_1">
                                                <label for="quantity_1" class="fw-bold text-primary">Quantity</label>
                                                <input type="number" id="quantity_1" class="form-control" placeholder="e.g. 10" min="0" step="1" value="10">
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
                                    <input id="supplier_price" type="text" class="form-control" value="100.00" required>
                                </div>
                            </div>

                            <div class="col-md-6 mt-3"> 
                                <div class="form-group">
                                    <label for="price" class="fw-bold text-primary">Price</label>
                                    <input id="price" type="text" class="form-control" value="150.00" required>
                                </div>
                            </div>

                            <div class="col-md-6"> 
                                <div class="form-group">
                                    <label for="quantity" class="fw-bold text-primary">Quantity</label>
                                    <div class="d-flex gap-2">
                                        <input id="quantity" type="number" class="form-control" value="" required>
                                    </div>
                                </div>
                            </div>
                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end mt-4">
                                <a href="{{ route('shop.products') }}" class="btn btn-outline-primary me-2">Discard</a>
                                <button type="submit" class="btn btn-primary">Save Changes</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
