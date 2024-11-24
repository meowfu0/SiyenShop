@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')
    <div class="container-fluid">
    <div class="row px-4 py-2 gap-4">
        <div class="col">
            
            <div class="m-0 mt-1">
                <h1 class="mb-2 fw-bold text-primary">Update Shop</h1>
            </div>
            
           
<!-- FORM ROUTE-->   
            <form action="{{ route('shops.store') }}" method="POST" enctype="multipart/form-data" id="shopForm">
            @csrf
<!--LOGO/PROFILE PIC--> 
            <div class="d-flex gap-4 ms-3">
                <img
                src="https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcRjvKVPWNACMZqeZEIKjjn4_ihfsK1y9jUjiw&s"
                class="profile-picture1" style="margin-right: 20px;"
                alt="Profile Picture"
                />
                <div class="form-group d-flex align-items-center gap-3">
                    
                    <button class="btn btn-outline-primary d-flex align-items-center gap-2 hoverinvert p-3 flex-grow-1" style="height: 2rem">Upload Photo
                        <img src="{{ asset('images/add.svg')}}" alt="">
                    </button>
                    <button class="btn btn-secondary h-25">Remove</button>
                </div>
            </div>

            <!-- INPUT FIELDS--> 
                        <div class="form-group">
                            <label for="shopName" class="fw-bold mb-1">Shop Name</label>
                            <input type="text" class="form-control px-3 py-2" id="shopName" placeholder="Enter Shop Name" >
                        </div>
                        
                        
                        <div class="form-group">
                            <label for="course"  class="fw-bold mb-1">Course</label>
                            <select class="form-control px-3 py-2" id="course" name="course_id">
                                <option value="" selected>Choose...</option>
                                <option value="1">BS Information Technology</option>
                                <option value="2">BS Computer Science</option>
                                <option value="3">BS Biology</option>
                                <option value="4">BS Chemistry</option>
                                <option value="5">BS Meteorology</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="shopEmail" class="fw-bold mb-1">Shop Email Address</label>
                            <input type="text" class="form-control px-3 py-2" id="shopEmail" name="shop_email" placeholder="Enter Shop Email Address" >
                        </div>
                        <div class="form-group">
                            <label for="businessManager"  class="fw-bold mb-1 ">Assign Business Manager(s)</label>
                                <div class="align-items-center gap-3" id="managerRow1" style="display:flex;">
                                    <select class="form-control px-3 py-2" id="managerName1"  name="managers[]">
                                        <option value="" selected>Choose Business Manager</option>
                                        <option value="1">Name</option>
                                        <option value="2">Name</option>
                                        <option value="3">Name</option>
                                    </select>
                                    <button class="m-0 btn btn-outline-primary hoverinvert px-3 py-2" id="trash-btn1">
                                            <img src="{{ asset('images/trash.svg')}}" alt="">
                                        </button>  
                                        
                                </div>

                                <!--Hidden by default-->
                                <div class="mt-2 align-items-center gap-3" id="managerRow2" style="display: none;">
                                    <select class="form-control px-3 py-2" id="managerName2" name="managers[]">
                                    <option value="" selected>Choose Business Manager</option>
                                        <option value="1">Name</option>
                                        <option value="2">Name</option>
                                        <option value="3">Name</option>
                                    </select>
                                        <button class="m-0 btn btn-outline-primary hoverinvert px-3 py-2" id="trash-btn2">
                                            <img src="{{ asset('images/trash.svg')}}" alt="">
                                        </button >
                                        
                                </div>

                               
                        </div>
                        
                        
                        <button class="btn btn-outline-primary hoverinvert d-flex align-items-center gap-2 px-3 fs-3" onclick="addManager(event)">Add 
                            <img src="{{ asset('images/add.svg')}}" alt="">
                        </button>
                                
                            
                    </form>
            <div class="d-flex gap-2 justify-content-end ">
                <button class="btn btn-link text-primary fw-medium fs-4" type="reset" onclick="cancel()">Cancel</button>
                <button class="btn btn-primary p-2 px-4 fs-4" type="submit" onclick="shops()">Save Changes</button>
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
                    <h3 id="displayShopName" class="fw-bold fs-7">Shop Name</h3>
                    <p class="mb-0" id="displayCourse">Course</p>
                    <p id="displayShopEmail">shopemail@email.com</p>
                    <div class="text-start">
                        <p class="mb-1"><strong id="displayManager">Business Manager Name</strong></p>
                        <p class="mb-1"><strong id="displayManager2" style="display: none;">Business Manager Name</strong></p>
                        <p class="m-0" id="gcashNumber">GCash Number</p>
                        <p class="m-0" id="gcashReceiver">GCash Receiver</p>
                    </div>
                </div>

        </div>
    </div>
    
</div>


<script src="{{asset('js/admin-shops.js')}}" ></script>

<script>
    function cancel(){
        
        window.location.href = "{{ route('admin.shops') }}";
    
    }

    function shops(){
        //create function tbf
        window.location.href = "{{ route('admin.shops') }}";
    }

</script>
<!--
<script>


    // Get references to input fields
    const shopNameInput = document.getElementById('shopName');
    const shopEmailInput = document.getElementById('shopEmail');
    const courseInput = document.getElementById('course');
    const managerInput = document.getElementById('managerName1');
    const managerInput2 = document.getElementById('managerName2');
    const managerRow2 = document.getElementById('managerRow2');
    const dropdown2 = document.getElementById('managerName2');
    const trashButton2 = document.getElementById('trash-btn2');

    // Reference to the dropdown and trash button
const dropdown1 = document.getElementById('managerName1');
    const trashButton1 = document.getElementById('trash-btn1');

    
    

    // Get references to display elements
    const displayShopName = document.getElementById('displayShopName');
    const displayCourse = document.getElementById('displayCourse');
    const displayShopEmail = document.getElementById('displayShopEmail');
    const displayManager = document.getElementById('displayManager');
    const displayManager2 = document.getElementById('displayManager2');


    
    
    

    // Update display elements when input fields change
    shopNameInput.addEventListener('input', () => {
        displayShopName.textContent = shopNameInput.value;
    });

    shopEmailInput.addEventListener('input', () => {
        displayShopEmail.textContent = shopEmailInput.value;
    });


    managerInput.addEventListener('change', () => {
        const selectedOptionText = managerInput.options[managerInput.selectedIndex].text;

        displayManager.textContent = selectedOptionText;
       
    });

    managerInput2.addEventListener('change', () => {
        const selectedOptionText = managerInput2.options[managerInput2.selectedIndex].text;
        displayManager2.textContent = selectedOptionText;
       
    });

    
        



    courseInput.addEventListener('change', () => {
    // Get the text of the selected option
    const selectedOptionText = courseInput.options[courseInput.selectedIndex].text;


    // Update the display element
    displayCourse.textContent = selectedOptionText !== 'Choose...' ? selectedOptionText : 'Course';
});




//add button

function addManager(event) {
    // Prevent the form from submitting
    event.preventDefault();

    // Get the elements for managerRow2 and managerRow3
    const managerRow2 = document.getElementById('managerRow2');
    const displayManager2 = document.getElementById('displayManager2');

    // Show the elements
    if (managerRow2) {
        managerRow2.style.display = 'flex'; // Or 'block'
    }

    if (displayManager2) {
        displayManager2.style.display = 'flex'; // Or 'block'
    }


   
}





    // Reset dropdown to default when delete button is clicked
    trashButton1.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent any default behavior
        dropdown1.selectedIndex = 0; // Reset dropdown to the first option
        // Display the newly selected option (default option)

    const selectedText = dropdown1.options[dropdown1.selectedIndex].text; // Get the text of the selected option
    displayManager.textContent = selectedText; 
    });







// Hide managerRow2 when the delete button is clicked
trashButton2.addEventListener('click', function () {

    event.preventDefault();
        managerRow2.style.display = 'none'; // Hide the row
        dropdown2.selectedIndex = 0;
       const selectedText = dropdown2.options[dropdown2.selectedIndex].text; // Get the text of the selected option
    displayManager2.textContent = selectedText; 
    displayManager2.style.display = 'none';
    });



</script>
-->

@endsection
