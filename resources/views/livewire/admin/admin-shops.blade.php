@extends('layouts.admin')

@section('content')

<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{asset('images/user.svg')}}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>
            @endauth
        </div>
    </div>

    <!-- Welcome Message Below Navbar -->
    <div class="mt-3">
        <h1 class="page-header">Welcome to {{ Route::current()->uri() }}</h1>
    </div>

    <div class="data-table-section">
        <div class="top-bar">
            <div class="search-container">
                <i class="fa fa-search"></i>
                <input type="search" class="searchbox" placeholder="Search"/>
            </div>
            <div class="button-container">
                <div class="dropdown-container">
                <span>Course</span>
                <select class="course-dropdown">
                    <option value="course1" selected>BS Information Technology</option>
                    <option value="course2">BS Computer Science</option>
                    <option value="course3">BS Biology</option>
                    <option value="course4">BS Chemistry</option>
                    <option value="course5">BS Meteorology</option>
                </select>
            </div>
            <div>
            <button class="create-btn">Create Shop <i class="fa fa-plus"></i></button>
            </div>
            </div>
            

        </div>
        <div class="shops-table-section">
            <table class="table table-hover">
            <thead>
                <tr>
                <th scope="col">Profile Picture</th>
                <th scope="col">Store Name</th>
                <th scope="col">Course</th>
                <th scope="col">Business Manager</th>
                <th scope="col">Status</th>
                <th scope="col"> </th>
                </tr>
            </thead>
            <tbody>
                <tr>
                <th scope="row">image</th>
                <td>CitcUITS</td>
                <td>BS Information Technology</td>
                <td>Juan Dela Cruz</td>
                <td>Active</td>
                <td><button class="view-shop-btn">View Shop</button></td>
                </tr>
            </tbody>
            </table>

        </div>
    </div>
</div>


@endsection
