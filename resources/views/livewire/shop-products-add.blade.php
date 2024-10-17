@extends('layouts.shop')

@section('content')
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
                        <input type="text" id="product_name" class="form-control" placeholder="Input product name">
                    </div>

                    <div class="form-group mb-1">
                        <label for="product_description" class="fw-bold text-primary">Product Description</label>
                        <textarea id="product_description" class="form-control" rows="4" placeholder="Input product description"></textarea>
                    </div>

                    <div class="form-group mb-3">
                        <label class="fw-bold text-primary">Display Image</label>
                        <div class="border p-3 rounded text-center" id="drop-area">
                            <p>Drag and drop your photo here or <span class="text-primary" id="file-upload-link">Browse from device</span></p>
                            <input type="file" class="d-none" id="file" name="file[]" multiple>
                        </div>
                        <p class="mt-2 text-muted">Supported formats: JPEG, PNG</p>
                    </div>
                </div>

                <!-- Second Column -->
                <div class="col-md-6 d-flex flex-column gap-3"> 
                    <div class="d-flex justify-content-between align-items-center mb-2">
                        <p class="fw-bold m-0 text-primary">Organize</p>
                        <button type="button" class="btn btn-outline-primary btn-sm">Add Category</button>
                    </div>
        
                    <div class="form-group mb-1">
                        <label for="category" class="fw-bold text-primary">Category</label>
                        <select id="category" class="form-select form-control">
                            <option value="">Select Category</option>
                            <option value="T-Shirt">T-Shirt</option>
                            <option value="Hoodie">Lanyard</option>
                        </select>
                    </div>

                    <div class="form-group mb-1">
                        <label for="organization" class="fw-bold text-primary">Organization</label>
                       <!-- <input type="text" id="organization" class="form-control" 
                            value="{{ Auth::user()->organization ?? 'No organization assigned' }}" readonly disabled> for backend part-->
                            <input type="text" id="organization" class="form-control" value="Circle of Unified Information Technology Students" readonlyd disabled> <!-- For frontend part only-->
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
                                <label for="status" class="fw-bold text-primary">Status</label>
                                <select id="status" class="form-select form-control">
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

                        <div class="row g-2"> 
                            <div class="col-md-6 mt-3 mb-1"> 
                                <div class="form-group">
                                    <label for="status" class="fw-bold text-primary">Supplier Price</label>
                                    <input id="postfix" value="₱" type="text" id="form2" class="form-control" />
                                </div>
                            </div>

                            <div class="col-md-6 mt-3"> 
                                <div class="form-group">
                                    <label for="visibility" class="fw-bold text-primary">Price</label>
                                    <input id="postfix" value="₱" type="text" id="form2" class="form-control" />
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="row g-2"> 
                        <div class="col-md-6 mt-3 mb-1"> 
                            <div class="form-group">
                                <label for="status" class="fw-bold text-primary">Supplier Price</label>
                                <input id="postfix" value="₱" type="text" id="form2" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6 mt-3"> 
                            <div class="form-group">
                                <label for="visibility" class="fw-bold text-primary">Price</label>
                                <input id="postfix" value="₱" type="text" id="form2" class="form-control" />
                            </div>
                        </div>

                        <div class="col-md-6"> 
                            <div class="form-group">
                                <label for="visibility" class="fw-bold text-primary">Quantity</label>
                                <div class="input-group quantity-selector quantity-selector-sm">
                                    <input type="number" id="inputQuantitySelectorSm" class="form-control" aria-live="polite" data-bs-step="counter" name="quantity" title="quantity" value="0" min="0" max="10" step="1" data-bs-round="0" aria-label="Quantity selector">
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
            

            <!-- Submit Button -->
            <div class="d-flex justify-content-end mt-4">
                <button type="submit" class="btn btn-outline-primary me-2">Discard</button>
                <button type="submit" class="btn btn-primary">Save Changes</button>
            </div>
        </div>
    </div>
</div>
@endsection
