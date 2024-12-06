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

                <!-- FORM -->
                <form method="POST" enctype="multipart/form-data" id="shopForm" action="{{ route('admin.shopUpdate.reflect', $shop->id) }}">
                    @csrf
                    @method('PUT')

                    <!-- LOGO/PROFILE PIC -->
                    <div class="d-flex gap-1 ms-3">
                        <!-- Profile Picture -->
                        <div id="profilePictureContainer">
                            <img
                                id="profileImage"
                                src="{{ $shop->shop_logo ? asset('storage/shop_logos/' . $shop->shop_logo) : asset('images/default-profile.png') }}"
                                class="profile-picture1"
                                style="margin-right: 20px; width: 200px; height: 200px; object-fit: contain;"
                                alt="Profile Picture"
                            />
                        </div>

                        <!-- Form Group with Buttons -->
                        <div class="form-group d-flex align-items-center gap-3">
                            <!-- Upload Photo Button -->
                            <label for="fileInput" class="btn btn-outline-primary d-flex align-items-center gap-2 hoverinvert p-3 flex-grow-1" style="height: 2rem; cursor: pointer;">
                                Upload Photo
                                <img src="{{ asset('images/add.svg') }}" alt="">
                            </label>
                            <input
                                type="file"
                                id="fileInput"
                                style="display: none;"
                                accept="image/*"
                                name="shop_logo"
                                onchange="previewImage(event)"
                            />

                            <!-- Remove Button -->
                            <button type="button" class="btn btn-secondary h-25" id="removeBtn" onclick="removeImage()">Remove</button>
                        </div>
                    </div>

                    <!-- INPUT FIELDS -->
                    <!-- INPUT FIELDS -->
                    <div class="form-group">
                        <label for="shopName" class="fw-bold mb-1">Shop Name</label>
                        <input type="text" class="form-control px-3 py-2" id="shopName" name="shop_name" value="{{ old('shop_name', $shop->shop_name) }}" placeholder="Enter Shop Name">
                    </div>

                    <div class="form-group">
                        <label for="course" class="fw-bold mb-1">Course</label>
                        <select class="form-control px-3 py-2" id="course" name="course_id">
                            <option value="" selected>Choose...</option>
                            @foreach($courses as $course)
                                <option value="{{ $course->id }}" {{ $shop->course_id == $course->id ? 'selected' : '' }}>{{ $course->course_name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="shopEmail" class="fw-bold mb-1">Shop Email</label>
                        <input type="text" class="form-control px-3 py-2" id="shopEmail" name="shop_email" value="{{ $shop->user->email }}" placeholder="Enter Shop Email">
                    </div>

                    <div class="form-group">
                        <label for="managerRow1" class="fw-bold mb-1">Assign Business Manager(s)</label>
                        <div id="managerRow1" class="align-items-center gap-3" style="display: flex;">
                            <select class="form-control px-3 py-2" id="managerName1" name="managers[]">
                                @foreach($managers as $manager)
                                    <option value="{{ $manager->id }}" {{ $shop->businessManager && $shop->businessManager->id == $manager->id ? 'selected' : '' }}>
                                        {{ $manager->first_name }} {{ $manager->last_name }}
                                    </option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="d-flex gap-2 justify-content-end mt-5">
                        <button class="btn btn-link text-primary fw-medium fs-4" type="reset" onclick="cancel()">Cancel</button>
                        <button class="btn btn-primary p-2 px-4 fs-4" type="submit">Save Changes</button>
                    </div>
                </form>
            </div>

            <div class="col d-flex align-items-center justify-content-center">
                <div class="d-flex flex-column border border-primary p-5" style="border-radius: 1rem">
                    <div class="mb-3 d-flex justify-content-center w-100">
                        <img
                            id="displayProfileImage"
                            src="{{ $shop->shop_logo ? asset('storage/shop_logos/' . $shop->shop_logo) : asset('images/default-profile.png') }}"
                            class="profile-picture1"
                            style="margin-right: 20px; width: 200px; height: 200px; object-fit: contain;"
                            alt="Profile Picture"
                        />
                    </div>
                    <div class="d-flex flex-column justify-content-start px-5">
                        <h3 id="displayShopName" class="fw-bold fs-7">{{ old('shop_name', $shop->shop_name) }}</h3>
                        <p class="mb-0" id="displayCourse">{{$shop->course->name }}</p>
                        <p id="displayShopEmail">{{ old('shop_email', $shop->user->email) }}</p>
                        <div class="text-start d-flex w-100 gap-3">
                            <div class="gcashDetails">
                                <p class="mb-1">
                                    <strong id="displayManager">
                                        @foreach($shop->businessManagers as $businessManager)
                                            {{ $businessManager->user->first_name }} {{ $businessManager->user->last_name }}<br>
                                        @endforeach
                                    </strong>
                                </p>
                                <p class="m-0" id="gcashNum"></p>
                                <p class="m-0" id="gcashReceiver"></p>
                            </div>

                            <div class="gcashDetails2">
                                <p class="mb-1">
                                    <strong id="displayManager2" style="display: none;">Business Manager Name</strong>
                                </p>
                                <p class="m-0" id="gcashNum2"></p>
                                <p class="m-0" id="gcashReceiver2"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<script>
    const uploadChange = @json(route('admin.shopUpdate.reflect', ['shopId' => ':shopId']));
</script>

<script src="{{asset('js/create-update-shops.js')}}" ></script>


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


    function cancel(){
        
        window.location.href = "{{ route('admin.shops') }}";
    
    }

    function shops(){
        //create function tbf
        window.location.href = "{{ route('admin.shops') }}";
    }
;
    
    

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
