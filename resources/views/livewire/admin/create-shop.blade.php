@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')
    <div class="container-fluid">
    <div class="row px-4 py-2 gap-4">
        <div class="col">
            
            <div class="m-0 mt-1">
                <h1 class="mb-2 fw-bold text-primary">Create Shop</h1>
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
           
               
            <form >
            @csrf
                        <div class="form-group">
                            <label for="shopName" class="fw-bold mb-1">Shop Name</label>
                            <input type="text" class="form-control px-3 py-2" id="shopName" placeholder="Enter Shop Name" >
                        </div>
                        <div class="form-group">
                            <label for="shopEmail" class="fw-bold mb-1">Shop Email Address</label>
                            <input type="text" class="form-control px-3 py-2" id="shopEmail" placeholder="Enter Shop Email Address" >
                        </div>
                        
                        <div class="form-group">
                            <label for="course"  class="fw-bold mb-1">Course</label>
                            <select class="form-control px-3 py-2" id="course" >
                                <option selected>Choose...</option>
                                <option value="course1">BS Information Technology</option>
                                <option value="course2">BS Computer Science</option>
                                <option value="course3">BS Biology</option>
                                <option value="course4">BS Chemistry</option>
                                <option value="course5">BS Meteorology</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="businessManager"  class="fw-bold mb-1 ">Assign Business Manager(s)</label>
                                <div class="align-items-center gap-3" id="managerRow1" style="display:flex;">
                                    <select class="form-control px-3 py-2" id="managerName1" >
                                        <option selected>Choose Business Manager</option>
                                        <option value="manager1">Name</option>
                                        <option value="manager2">Name</option>
                                        <option value="manager3">Name</option>
                                    </select>
                                    <button class="m-0 btn btn-outline-primary hoverinvert px-3 py-2" id="trash-btn1">
                                            <img src="{{ asset('images/trash.svg')}}" alt="">
                                        </button><!--Palitan ng trash-->  
                                        
                                </div>

                                <!--Hidden by default-->
                                <div class="mt-2 align-items-center gap-3" id="managerRow2" style="display: none;">
                                    <select class="form-control px-3 py-2" id="managerName2" >
                                        <option selected>Choose Business Manager</option>
                                        <option value="manager1">Name</option>
                                        <option value="manager2">Name</option>
                                        <option value="manager3">Name</option>
                                    </select>
                                        <button class="m-0 btn btn-outline-primary hoverinvert px-3 py-2" id="trash-btn2">
                                            <img src="{{ asset('images/trash.svg')}}" alt="">
                                        </button><!--Palitan ng trash-->  
                                        
                                </div>

                               
                        </div>
                        
                        
                        <button class="btn btn-outline-primary hoverinvert d-flex align-items-center gap-2 px-3 fs-3" onclick="addManager(event)">Add 
                            <img src="{{ asset('images/add.svg')}}" alt="">
                        </button>
                                
                            
                    </form>
            <div class="d-flex gap-2 justify-content-end ">
                <button class="btn btn-link text-primary fw-medium fs-4" type="reset" onclick="cancel()">Cancel</button>
                <button class="btn btn-primary p-2 px-4 fs-4" type="submit" onclick="shops()">Create</button>
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
                    <p id="displayCourse">Course</p>
                    <p id="displayShopEmail">shopemail@email.com</p>
                    <div class="text-start">
                        <p class="mb-1"><strong id="displayManager">Business Manager Name</strong></p>
                        <p class="mb-1"><strong id="displayManager" style="display: none;">Business Manager Name</strong></p>
                        <p class="m-0" id="gcashNum">GCash Number</p>
                        <p class="m-0" id="gcashReceiver">GCash Receiver</p>
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
        //create function tbf
        window.location.href = "{{ route('admin.shops') }}";
    }

    // Get references to input fields
    const shopNameInput = document.getElementById('shopName');
    const shopEmailInput = document.getElementById('shopEmail');
    const courseInput = document.getElementById('course');
    const managerInput = document.getElementById('managerName1', 'managerName2');

    // Get references to display elements
    const displayShopName = document.getElementById('displayShopName');
    const displayCourse = document.getElementById('displayCourse');
    const displayShopEmail = document.getElementById('displayShopEmail');
    const displayManager = document.getElementById('displayManager');

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
    

    // Show the elements
    if (managerRow2) {
        managerRow2.style.display = 'flex'; // Or 'block'
    }

   
}



// Reference to the dropdown and trash button
const dropdown1 = document.getElementById('managerName1');
    const trashButton1 = document.getElementById('trash-btn1');

    // Reset dropdown to default when delete button is clicked
    trashButton1.addEventListener('click', function (event) {
        event.preventDefault(); // Prevent any default behavior
        dropdown1.selectedIndex = 0; // Reset dropdown to the first option
    });



const managerRow2 = document.getElementById('managerRow2');
    
    const trashButton2 = document.getElementById('trash-btn2');
// Hide managerRow2 when the delete button is clicked
trashButton2.addEventListener('click', function () {

    event.preventDefault();
        managerRow2.style.display = 'none'; // Hide the row
    });



</script>
@endsection
