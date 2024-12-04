// Search function
const inputShops = document.getElementById("search-input"); //Select input at the search bar
const courseFilter = document.getElementById("course-filter"); //dropdown for the filter
const shopsList = document.getElementById("display"); //tbody / container

if (inputShops && courseFilter) {
    // Event listener to trigger search on input change
    inputShops.addEventListener("input", handleSearchInput);
    courseFilter.addEventListener("change", handleSearchInput); // Trigger when course filter changes
} 
else {
    console.error("Search input or course select element not found.");
}

// Fetch data from the API based on the search query and course filter
async function fetchUsers(query = "", course = "") {
    try {
        const url = '/api/shops'; // Full URL to your API endpoint
        const params = new URLSearchParams(); // Initialize URLSearchParams

        if (query) params.append("search", query);
        if (course) params.append("courseCall", course);

        // Make the fetch request
        const response = await fetch(`${url}?${params.toString()}`);

        const data = await response.json();
        console.log("Fetched:", data);
        displayUsers(data); // Pass data to display
    } 
    catch (error) {
        console.error('Error fetching data:', error);
    }
}
// Function to display users inside the results container (table rows)
function displayUsers(shops) {
    shopsList.innerHTML = ""; // Clear previous results

    // Check if there are any users
    if (shops.length > 0) {
        shops.forEach(user => {
            const row = document.createElement("tr");

            // Profile Picture
            const shopLogoTd = document.createElement("td");
            const shopLogo = document.createElement("img");
            shopLogo.classList.add("img-thumbnail");
            shopLogo.style.width = "40px";
            shopLogo.style.height = "40px";
            shopLogo.src = `/storage/${shop.shop_logo}` || '/images/default-avatar.png';
            shopLogoTd.appendChild(shopLogo);
            row.appendChild(shopLogoTd);

            // Full Name
            const shopName = document.createElement("td");
            shopName.textContent = `${shop.shop_name}`;
            row.appendChild(shopName);

            // Email
            const emailCell = document.createElement("td");
            emailCell.textContent = user.email;
            row.appendChild(emailCell);

            // Role
            const roleCell = document.createElement("td");
            roleCell.textContent = user.role?.role_name || 'Unknown';
            row.appendChild(roleCell);

            // Course
            const courseCell = document.createElement("td");
            courseCell.textContent = user.course?.course_name || 'Unknown';
            row.appendChild(courseCell);

            // Status
            const statusCell = document.createElement("td");
            statusCell.textContent = user.status?.status_name || 'No status assigned';
            row.appendChild(statusCell);

            // Actions
            const actionsCell = document.createElement("td");
            const viewButton = document.createElement("button");
            viewButton.classList.add("view-users-btn", "fs-2", "p-1", "px-2");
            viewButton.setAttribute("data-user-id", user.id);
            viewButton.textContent = "View Account ";
            const redirectIcon = document.createElement("img");
            redirectIcon.src = '/images/redirect.svg';
            viewButton.appendChild(redirectIcon);
            actionsCell.appendChild(viewButton);
            row.appendChild(actionsCell);

            // Append the row to the table
            shopsList.appendChild(row);
        });
    } 
    
    else {
        shopsList.innerHTML = "<tr><td colspan='7'>No users found</td></tr>";
    }
}

// Function to handle search input and trigger AJAX search
// Handle the search input change and trigger API fetch
function handleSearchInput() {
    const query = inputShops.value.trim(); // Get query from search input
    const course = courseFilter.value; // Get selected course value

// Call fetchUsers with parameters only if there's input; otherwise, call without parameters to reset
if (query || course) {
    fetchUsers(query, course); // Fetch data based on search input
} 

else {
    fetchUsers(); // Reset to default state if no input
    }
}

//Modal activator
document.addEventListener('click', function(event) {
    if (event.target.classList.contains('view-shops-btn')) {
        const button = event.target;
        const shopID = button.getAttribute('data-user-id'); // Get shop ID
        const shopAccess = shopsData.find(shop => shop.id == shopID);

        if(shopAccess) {
            console.log(shopAccess.g_cash_info);
            // Extract and set user data for the modal
            const shopName = `${shopAccess.shop_name}`;
            const shopCourse = shopAccess.course?.course_name || "N/A";
            const shopBusinessMngr = `${shopAccess.user.first_name} ${shopAccess.user.last_name}`;
            const gcashCtrl = shopAccess.g_cash_info?.gcash_name || "N/A";
            const gcashNum = shopAccess.g_cash_info?.gcash_number || "N/A"; 
            const shopPic = `${shopAccess.shop_logo}`; 

            // Insert data into modal
            document.getElementById('org-name').innerText = shopName;
            document.getElementById('course-origin').innerText = shopCourse;
            document.getElementById('business_mngr').innerText = shopBusinessMngr;
            document.getElementById('gcash-num').innerText = gcashNum;
            document.getElementById('gcash-ctrl-name').innerText = gcashCtrl;
            const shopImg = document.getElementById('shopLogo');
            shopImg.src = `${imageBaseUrl}/${shopPic}`;

            // Show the modal
            var shop_modal = new bootstrap.Modal(document.getElementById('shopModal'));
            shop_modal.show();
            } 
    else {
        console.error(`User with ID ${shopID} not found.`);
        }
    }
});



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

// Cancel function to go back
function cancel(){
    window.location.href = "{{ route('admin.shops') }}";
}

// Function to navigate to the shop page
function shops(){
    window.location.href = "{{ route('admin.shops') }}";
}

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
