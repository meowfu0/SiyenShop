
////////CREATE SHOP AND UPDATE SHOP/////////

// Get references to input fields
const shopNameInput = document.getElementById('shopName');
const shopEmailInput = document.getElementById('shopEmail');
const courseInput = document.getElementById('course');
const managerInput = document.getElementById('managerName1');
const managerInput2 = document.getElementById('managerName2');
const managerRow2 = document.getElementById('managerRow2');
const dropdown2 = document.getElementById('managerName2');
const trashButton2 = document.getElementById('trash-btn2');

// Reference to the dropdown and trash button for first manager
const dropdown1 = document.getElementById('managerName1');
const trashButton1 = document.getElementById('trash-btn1');

// Get references to display elements
const displayShopName = document.getElementById('displayShopName');
const displayCourse = document.getElementById('displayCourse');
const displayShopEmail = document.getElementById('displayShopEmail');
const displayManager = document.getElementById('displayManager');
const displayManager2 = document.getElementById('displayManager2');
const gcashNum = document.getElementById('gcashNum');
const gcashReceiver = document.getElementById('gcashReceiver');
const gcashNum2 = document.getElementById('gcashNum2');
const gcashReceiver2 = document.getElementById('gcashReceiver2');

// Update display for the first Business Manager
 managerInput.addEventListener('change', () => {
    const selectedOption = managerInput.options[managerInput.selectedIndex];
    const selectedOptionText = selectedOption.text;

    // Display the selected Business Manager's name
    displayManager.textContent = selectedOptionText;

    // Get GCash details for the first manager
    const gcashName = selectedOption.getAttribute('data-gcash-name');
    const gcashNumber = selectedOption.getAttribute('data-gcash-number');

    // Display the GCash Name and Number
    if (gcashName && gcashNumber) {
        gcashNum.textContent = gcashNumber;
        gcashReceiver.textContent = gcashName;
    } else {
        gcashNum.textContent = "N/A";
        gcashReceiver.textContent = "N/A";
    }
});


// Update display for the second Business Manager
managerInput2.addEventListener('change', () => {
    const selectedOption = managerInput2.options[managerInput2.selectedIndex];
    const selectedOptionText = selectedOption.text;

    // Display the selected Business Manager's name
    displayManager2.textContent = selectedOptionText;

    // Get GCash details for the second manager
    const gcashName = selectedOption.getAttribute('data-gcash-name');
    const gcashNumber = selectedOption.getAttribute('data-gcash-number');

    // Display the GCash Name and Number
    if (gcashName && gcashNumber) {
        gcashNum2.textContent = gcashNumber;
        gcashReceiver2.textContent = gcashName;
    } else {
        gcashNum2.textContent = "N/A";
        gcashReceiver2.textContent = "N/A";
    }
});

// Reset dropdown to default and clear GCash info when delete button is clicked (1st Manager)
trashButton1.addEventListener('click', function (event) {
    event.preventDefault();

    // Reset dropdown to the first option (default option)
    dropdown1.selectedIndex = 0;

    // Reset display for Business Manager
    const selectedText = dropdown1.options[dropdown1.selectedIndex].text;
    displayManager.textContent = selectedText;

    // Reset the GCash info
    gcashNum.textContent = "N/A";  
    gcashReceiver.textContent = "N/A";  
});

// Hide managerRow2, reset dropdown, and clear GCash info when delete button is clicked (2nd Manager)
trashButton2.addEventListener('click', function (event) {
    event.preventDefault();

    // Hide the manager row
    managerRow2.style.display = 'none';

    // Reset dropdown to the first option (default option)
    dropdown2.selectedIndex = 0;

    // Reset display for Business Manager
    const selectedText = dropdown2.options[dropdown2.selectedIndex].text;
    displayManager2.textContent = selectedText;
    displayManager2.style.display = 'none'; // Hide the second manager name display

    // Reset the GCash info
    gcashNum2.textContent = " "; 
    gcashReceiver2.textContent = " "; 
});

// Add Manager Button: Show the second manager row and display
function addManager(event) {
    event.preventDefault();

    // Get the elements for managerRow2 and managerRow3
    const managerRow2 = document.getElementById('managerRow2');
    const displayManager2 = document.getElementById('displayManager2');

    // Show the elements
    if (managerRow2) {
        managerRow2.style.display = 'flex'; 
    }

    if (displayManager2) {
        displayManager2.style.display = 'flex'; 
    }
}

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
    const selectedOptionText = courseInput.options[courseInput.selectedIndex].text;
    displayCourse.textContent = selectedOptionText !== 'Choose...' ? selectedOptionText : 'Course';
});

// Reset dropdown to default when delete button is clicked for the first manager
trashButton1.addEventListener('click', function (event) {
    event.preventDefault();
    dropdown1.selectedIndex = 0;
    const selectedText = dropdown1.options[dropdown1.selectedIndex].text;
    displayManager.textContent = selectedText; 
});

// Hide managerRow2 when the delete button is clicked for the second manager
trashButton2.addEventListener('click', function (event) {
    event.preventDefault();
    managerRow2.style.display = 'none'; // Hide the row
    dropdown2.selectedIndex = 0;
    const selectedText = dropdown2.options[dropdown2.selectedIndex].text;
    displayManager2.textContent = selectedText; 
    displayManager2.style.display = 'none';
});

// Image Preview and Removal Functions
function previewImage(event) {
    const file = event.target.files[0];
    if (file) {
        const reader = new FileReader();
        reader.onload = function (e) {
            // Set the uploaded image as the profile picture
            document.getElementById('profileImage').src = e.target.result;

            // Set the uploaded image in the second section
            document.getElementById('displayProfileImage').src = e.target.result;

            // Show the remove button
            document.getElementById('removeBtn').style.display = 'block'; 
        };
        reader.readAsDataURL(file);
    }
}

// Function to remove the image and reset the profile picture
function removeImage() {
    const defaultImage = 'https://www.pngitem.com/pimgs/m/30-307416_profile-icon-png-image-free-download-searchpng-employee.png';
    document.getElementById('profileImage').src = defaultImage;
    document.getElementById('displayProfileImage').src = defaultImage;

    // Hide the remove button
    document.getElementById('removeBtn').style.display = 'none'; 

    // Clear the file input value so no file is selected
    document.getElementById('fileInput').value = ''; 
}

function cancel(){
    window.location.href = "{{ route('admin.shops') }}";
}

function submitShopUpdate() {
    // Gather form data

    const shopId = document.getElementById("storeFetch").getAttribute("data-id");
    console.log(shopId);

    let shopData = {
        shop_name: document.getElementById('shopName').value,
        course_id: document.getElementById('course').value,
        shop_description: document.getElementById('shopDescription').value,
        managers: Array.from(document.querySelectorAll('select[name="managers[]"]')).map(select => select.value),
        // Add any other form fields here, such as profile picture
    };

    // Handle file upload if present
    let fileInput = document.getElementById('fileInput');
    let formData = new FormData();
    formData.append('_method', 'PUT');

    // Append all the shop data to the form data object
    for (let key in shopData) {
        formData.append(key, shopData[key]);
    }

    // If there's a file selected, append it as well
    if (fileInput.files.length > 0) {
        formData.append('shop_logo', fileInput.files[0]);
    }

    console.log('Form Data:', formData);
    console.log("Final URL:", uploadChange.replace(':shopId', shopId));
    // Perform the fetch request
    fetch(uploadChange.replace(':shopId', shopId), {
        method: 'POST', // Using POST with _method spoofing for PUT
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').content,
        },
        body: formData
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            alert('Shop updated successfully!');
            window.location.href = "{{ route('admin.shops') }}"; // Redirect after successful update
        } 
        
        else {
            alert('Failed to update shop. Please try again.');
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while updating the shop.');
    });
}

function addManager(event) {
    // Logic to add new manager row
}
