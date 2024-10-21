@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')

    <div class="container-fluid">
    <div class="row p-4 gap-4">
        <div class="col">
            
            <div class="m-0 mt-3">
                <h1 class="mb-4 fw-bold text-primary">Update Shop</h1>
            </div>
            <div class="d-flex gap-4 ms-3">
                <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
                class="profile-picture1" style="margin-right: 20px;"
                alt="Profile Picture"
                />
                <div class="d-flex align-items-center gap-3">
                    <button class="btn btn-outline-primary d-flex align-items-center gap-2 hoverinvert p-3 flex-grow-1" style="height: 2rem">Upload Photo
                        <img src="{{ asset('images/add.svg')}}" alt="">
                    </button>
                    <button class="btn btn-secondary h-25">Remove</button>
                </div>
            </div>
           
               
                    <form>
                        <div class="form-group">
                            <label for="shopName" class="fw-bold mb-2">Shop Name</label>
                            <input type="text" class="form-control p-3" id="shopName" placeholder="Enter Shop Name">
                        </div>
                        <div class="form-group">
                            <label for="course"  class="fw-bold mb-2">Course</label>
                            <select class="form-control p-3" id="course">
                                <option selected>Choose...</option>
                                <option value="course1">BS Information Technology</option>
                                <option value="course2">BS Computer Science</option>
                                <option value="course3">BS Biology</option>
                                <option value="course4">BS Chemistry</option>
                                <option value="course5">BS Meteorology</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="businessManager"  class="fw-bold mb-2 ">Assign Business Manager(s)</label>
                            <div class="d-flex align-items-center gap-3">
                                <input type="text" class="form-control p-3" id="businessManager" placeholder="Enter Business Manager Name">
                                <button class="m-0 btn btn-outline-primary hoverinvert p-3" id="trash-btn">
                                    <img src="{{ asset('images/trash.svg')}}" alt="">
                                </button><!--Palitan ng trash-->    
                            </div>
                        
                        </div>
                        
                        <button class="btn btn-outline-primary hoverinvert d-flex align-items-center gap-2 px-3 fs-3">Add 
                            <img src="{{ asset('images/add.svg')}}" alt="">
                        </button>
                                
                            
                    </form>
            <div class="d-flex gap-2 justify-content-end ">
                <button class="btn btn-link text-primary fw-medium fs-4">Cancel</button>
                <button class="btn btn-primary p-2 px-4 fs-4">Save Changes</button>
            </div>
        </div>
        <div class="col d-flex align-items-center justify-content-center">
            <div class="d-flex flex-column  border border-primary p-5" style="border-radius: 1rem">
                <div class="mb-3 d-flex justify-content-center w-100">
                    <img src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
                         class="profile-picture1"
                         alt="Profile Picture"
                         style="width: 200px; height: 200px;">
                </div>
                <div class="d-flex flex-column justify-content-start px-5">
                    <h3 class="fw-bold fs-7">CirCUITS</h3>
                    <p>Bachelor of Science in Information Technology</p>
                    <div class="text-start">
                        <p class="mb-1"><strong>Archie Onoya</strong></p>
                        <p class="m-0">GCash Number: 09123456789</p>
                        <p class="m-0">GCash Receiver: Robert Rodejo</p>
                    </div>
                </div>
        </div>
    </div>
    </div>
    
</div>

<script>
    function cancel(){
        
        window.location.href = "{{ route('admin.shops') }}";
    
    }

    function shops(){
        //save changes function tbf
        window.location.href = "{{ route('admin.shops') }}";
    }
</script>
@endsection
