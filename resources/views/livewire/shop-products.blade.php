@extends('layouts.shop')

@section('content')

<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navigation with User Info -->
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

    <!-- Title Section -->
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{ asset('images/Circuits.svg') }}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students</h2>
    </div>

    <!-- Product Title Section -->
    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Product</h2>
    </div>

    <!-- Filters and Actions Row -->
     
    <div class="row g-4 px-5">
        <!-- Entities per page -->
        <div class="col-md-2 d-flex flex-column">
            <div class="d-flex align-items-center gap-2">
                <select class="border border-primary rounded-2 p-2 text-primary">
                    <option value="10">10</option>
                    <option value="20">20</option>
                    <option value="30">30</option>
                </select>
                <p class="fs-3 fw-small m-0 text-primary">Entities per page</p>
            </div>
        </div>

        <!-- Search -->
        <div class="col-md-2 d-flex flex-column">
    <div class="input-group border border-primary rounded-2">
        <span class="input-group-text bg-white border-0">
            <img class="icons" src="{{ asset('images/search.svg') }}" alt="search">
        </span>
        <input type="search" class="form-control border-0 text-primary" placeholder="Search...">
    </div>
</div>

        <!-- Category -->
        <div class="col-md-2 d-flex flex-column">
            <div class="d-flex align-items-center gap-2">
                <p class="fs-3 fw-small m-0 text-primary">Category</p>
                <select class="border border-primary rounded-2 p-2 text-primary">
                    <option value="All">All</option>
                    <option value="Key Holder/Chain">Key Holder/Chain</option>
                    <option value="Lanyard">Lanyard</option>
                    <option value="Pins">Pins</option>
                    <option value="T-shirts">T-shirts</option>
                </select>
            </div>
        </div>

        <!-- Stock Level -->
        <div class="col-md-2 d-flex flex-column px-5">
            <div class="d-flex align-items-center gap-2">
                <p class="fs-3 fw-small m-0 text-primary">Stock Level</p>
                <select class="border border-primary rounded-2 p-2 text-primary">
                    <option value="All">All</option>
                    <option value="In stock">In Stock</option>
                    <option value="Low Stock">Low Stock</option>
                    <option value="Out of Stock">Out of Stock</option>
                </select>
            </div>
        </div>

        <!-- Action Buttons (Print, Export, etc.) -->
<!-- Action Buttons (Print, Export, History, Delete) -->
    <div class="col-md-2 d-flex align-items-center px-2 justify-content-end gap-2">
         <img class="img-thumbnail" src="{{ asset('images/print.svg') }}" alt="Print" style="width: 35px; height: 35px;">
            <img class="img-thumbnail" src="{{ asset('images/Export.svg') }}" alt="Export" style="width: 35px; height: 35px;">
         <img class="img-thumbnail" src="{{ asset('images/history.svg') }}" alt="History" style="width: 35px; height: 35px;">
         <img class="img-thumbnail" src="{{ asset('images/Delete.svg') }}" alt="Delete" style="width: 35px; height: 35px;">
    </div>


        <!-- Add Product Button -->
        <div class="col-md-2 d-flex align-items-center justify-content-center">
        <button class="btn-primary position-relative p-2 rounded-2 fs-3">
            <span>Add Product</span>
            <img src="{{ asset('images/add.svg') }}" alt="add" class="me-2" style="width: 12px; height: 12px;">        
    </button>
    </div>
    </div>

    <!-- Product Table -->
<!-- Product Table -->
<div class="d-flex px-5 py-4 gap-4 flex-grow-1" style="max-height: 60%">
    <div class="border border-primary rounded-4 p-4" style="flex: 4;">
        <table class="table table-hover table-borderless">
            <thead>
                <tr>
                    </th>
                    <th></th>                                   
                    <th scope="col">ID</th>
                    <th scope="col">Thumbnail</th>
                    <th scope="col">Name</th>
                    <th scope="col">Price</th>
                    <th scope="col">Category</th>
                    <th scope="col">Available Stocks</th>
                    <th scope="col">Status</th>
                    <th scope="col">Visibility</th>
                    <th scope="col">Stock Level</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="checkbox" class="select-item">
                    </td>
                    <td>00121</td>
                    <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                    <td>Name</td>
                    <td>P 250.00</td>
                    <td>T-Shirt</td>
                    <td>20</td>
                    <td>Available</td>
                    <td>Visible</td>
                    <td>In Stock</td>
                    <td><img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2" style="width: 15px; height: 15px;"></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="select-item">
                    </td>
                    <td>00122</td>
                    <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                    <td>Name</td>
                    <td>P 250.00</td>
                    <td>T-Shirt</td>
                    <td>30</td>
                    <td>Available</td>
                    <td>Visible</td>
                    <td>In Stock</td>
                    <td><img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2" style="width: 15px; height: 15px;"></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="select-item">
                    </td>
                    <td>00123</td>
                    <td><img src="{{ asset('images/lanyard.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                    <td>Name</td>
                    <td>P 165.00</td>
                    <td>Lanyard</td>
                    <td>40</td>
                    <td>Available</td>
                    <td>Visible</td>
                    <td>In Stock</td>
                    <td><img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2" style="width: 15px; height: 15px;"></td>
                </tr>
                <tr>
                    <td>
                        <input type="checkbox" class="select-item">
                    </td>
                    <td>00124</td>
                    <td><img src="{{ asset('images/black code.jpg') }}" alt="Thumbnail" style="width: 50px;"></td>
                    <td>Product Name</td>
                    <td>P 80.00</td>
                    <td>Pins</td>
                    <td>26</td>
                    <td>Available</td>
                    <td>Visible</td>
                    <td>In Stock</td>
                    <td><img src="{{ asset('images/dotmenu.svg') }}" alt="dotmenu" class="me-2" style="width: 15px; height: 15px;"></td>
                </tr>
            </tbody>
        </table>
    </div>
</div>


@endsection
