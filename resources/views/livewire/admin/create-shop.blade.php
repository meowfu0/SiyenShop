@extends('welcome')

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
        <h1 class="page-header">Create Shop</h1>
    </div>


<!--content-->

<div class="container-sm px-4">
    <div class="row">
        <div class="col-lg-6">
             <img
            src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
            class="profile-picture1"
            alt=""
            />
            
            <button class="btn btn-outline-secondary">Upload Profile Picture <i class="fa fa-plus"></i></button>
            <button class="btn btn-secondary">Remove</button>
       
                <form>
                    <div class="form-group">
                        <label for="shopName">Shop Name</label>
                        <input type="text" class="form-control" id="shopName" placeholder="Enter Shop Name">
                    </div>
                    <div class="form-group">
                        <label for="course">Course</label>
                        <select class="form-control" id="course">
                            <option selected>Choose...</option>
                            <option>BS Information Technology</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="businessManager">Assign Business Manager(s)</label>
                        <div class="d-flex align-items-center">
                            <input type="text" class="form-control" id="businessManager" placeholder="Enter Business Manager(s)">
                            <button class="btn btn-outline-primary" id="trash-btn"><i class="fa fa-trash"></i></button><!--Palitan ng trash-->    
                        </div>
                       
                    </div>
                    
                    <button class="btn btn-outline-primary">Add <i class="fa fa-plus"></i></button>
                            
                           
                </form>
        </div>
        
    
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <img
                    src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
                    class="profile-picture1"
                    alt=""
                    />
                    
                    <h4 class="card-title">Shop Name</h4> <!--Automatic display of name after fill-->
                    <p class="card-text">Bachelor of Science in Information Technology</p>
                        <hr>
                        <p>Full Name</p>
                        <p>GCash Number: </p>
                        <p>GCash Receiver: </p>
                        <hr>
                </div>

                
            </div>
        </div>
        <div class="footer">
            <button type="submit" class="btn btn-primary">Create</button>
            <button type="submit" class="btn btn-secondary" onclick="cancel()">Cancel</button>
        </div>
        
    </div>
 
</div>

<script>
    function cancel(){
        
        window.location.href = "{{ route('admin.shops') }}";
    
    }
</script>
@endsection
