//Search Handle
const searchInput = document.getElementById("search-input"); //Select input at the search bar
const courseSelect = document.getElementById("course-filter"); //dropdown for the filter
const resultsContainer = document.getElementById("display"); //tbody / container

if (searchInput && courseSelect) {
    // Event listener to trigger search on input change
    searchInput.addEventListener("input", handleSearchInput);
    courseSelect.addEventListener("change", handleSearchInput); // Trigger when course filter changes
} 
else {
    console.error("Search input or course select element not found.");
}

// Fetch data from the API based on the search query and course filter
async function fetchUsers(query = "", course = "") {
    try {
        const url = '/api/users'; // Full URL to your API endpoint
        const params = new URLSearchParams(); // Initialize URLSearchParams

        if (query) params.append("search", query);
        if (course) params.append("courseCall", course);

        // Make the fetch request
        const response = await fetch(`${url}?${params.toString()}`);

        const data = await response.json();
        displayUsers(data); // Pass data to display
    } 
    catch (error) {
        console.error('Error fetching data:', error);
    }
}
// Function to display users inside the results container (table rows)
function displayUsers(users) {
    resultsContainer.innerHTML = ""; // Clear previous results

    // Check if there are any users
    if (users.length > 0) {
        users.forEach(user => {
            const row = document.createElement("tr");

            // Profile Picture
            const profilePicCell = document.createElement("td");
            const profilePic = document.createElement("img");
            profilePic.classList.add("img-thumbnail");
            profilePic.style.width = "40px";
            profilePic.style.height = "40px";
            profilePic.src = user.profile_picture ? `/storage/${user.profile_picture}` : '/images/default-avatar.png';
            profilePicCell.appendChild(profilePic);
            row.appendChild(profilePicCell);

            // Full Name
            const fullNameCell = document.createElement("td");
            fullNameCell.textContent = `${user.first_name} ${user.last_name}`;
            row.appendChild(fullNameCell);

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
            resultsContainer.appendChild(row);
        });
    } 
    
    else {
        resultsContainer.innerHTML = "<tr><td colspan='7'>No users found</td></tr>";
    }
}

// Function to handle search input and trigger AJAX search
// Handle the search input change and trigger API fetch
function handleSearchInput() {
    const query = searchInput.value.trim(); // Get query from search input
    const course = courseSelect.value; // Get selected course value

// Call fetchUsers with parameters only if there's input; otherwise, call without parameters to reset
if (query || course) {
    fetchUsers(query, course); // Fetch data based on search input
} 

else {
    fetchUsers(); // Reset to default state if no input
}
}

    
    // Event delegation: Listen for clicks on .view-users-btn within resultsContainer
    document.addEventListener('click', function(event) {
    if (event.target.classList.contains('view-users-btn')) {
        const button = event.target;
        const userId = button.getAttribute('data-user-id'); // Get user ID
        const user = usersData.find(user => user.id == userId);
        const roleAccess = "role";

        if(user) {
            // Extract and set user data for the modal
            const name = `${user.first_name} ${user.last_name}`;
            const email = user.email;
            const role = user.role?.role_name || "N/A"; 
            const course = user.course?.course_name || "N/A";
            const status = user.status?.status_name || "N/A";
            const block = user.course_bloc;
            const year = user.year;

            // Insert data into modal
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalStatus').innerText = status;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('modalCourse').innerText = course;
            document.getElementById('modalYear').innerText = year;
            document.getElementById('modalBlock').innerText = block;
            const dropdown = document.getElementById('modalRole');
            dropdown.value = roleAccess.concat(user.role?.id || "");

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('userInfoModal'));
            myModal.show();
            } 
    else {
        console.error(`User with ID ${userId} not found.`);
        }
    }
});

        // Edit/Deactivate Button functionality
const editBtn = document.getElementById('editBtn');
const deactivateBtn = document.getElementById('deactivateBtn');
const modalRole = document.getElementById('modalRole'); // Dropdown
let isEditing = false;
let savedRoleValue = modalRole.value; // Store initial dropdown value

// Initially disable the dropdown
modalRole.disabled = true;

// Edit button functionality
editBtn?.addEventListener('click', function() {
    if (!isEditing) {
        // Switch to editing mode
        editBtn.innerText = 'Save Changes';
        deactivateBtn.innerText = 'Cancel';
        isEditing = true;

        // Enable the dropdown for editing
        modalRole.disabled = false;
    } else {
        // Handle saving changes
        savedRoleValue = modalRole.value; // Save the selected value
        alert('Changes saved!');

        // After saving, disable the dropdown and reset button states
        modalRole.disabled = true;
        resetButtons();
    }
});

// Deactivate (Cancel) button functionality
deactivateBtn?.addEventListener('click', function() {
    if (isEditing) {
        // If editing, reset to the saved value (in case of cancel)
        modalRole.value = savedRoleValue;
        alert('Changes canceled!');

        // After cancel, disable the dropdown and reset button states
        modalRole.disabled = true;
        resetButtons();
    }
});

// Function to reset the buttons after save or cancel
function resetButtons() {
    editBtn.innerText = 'Edit Account';
    deactivateBtn.innerText = 'Deactivate Account';
    isEditing = false;
}


        deactivateBtn?.addEventListener('click', function() {
            if (isEditing) {
                alert('Edit canceled!');
                resetButtons();
            } 
            else {
                var confirmDeactivateModal = new bootstrap.Modal(document.getElementById(
                    'confirmDeactivateModal'));
                confirmDeactivateModal.show();
            }
        });

        // Confirm deactivation
        document.getElementById('confirmDeactivateBtn')?.addEventListener('click', function() {
            alert('Account deactivated!');
            var confirmDeactivateModal = bootstrap.Modal.getInstance(document.getElementById(
                'confirmDeactivateModal'));
            confirmDeactivateModal.hide();
        });

        // Reset buttons function
        function resetButtons() {
            editBtn.innerText = 'Edit Account';
            deactivateBtn.innerText = 'Deactivate Account';
            isEditing = false;
        }

        // Role dropdown and permissions link
        const roleDropdown = document.getElementById('modalRole');
        const editPermissionsLink = document.getElementById('editPermissionsLink');

        roleDropdown?.addEventListener('change', function() {
            editPermissionsLink.style.display = (roleDropdown.value === 'role2') ? 'inline-block' :
                'none';
        });

        // Save changes in Edit Permissions modal
        document.getElementById('saveChangesBtn')?.addEventListener('click', function() {
            closeAndOpenModal('editPermissionsModal', 'userInfoModal');
        });

        // Close Edit Permissions modal and reopen User Info modal
        document.getElementById('closeBtn')?.addEventListener('click', function() {
            closeAndOpenModal('editPermissionsModal', 'userInfoModal');
        });

        // Utility function for closing one modal and opening another
        function closeAndOpenModal(closeModalId, openModalId) {
            var closeModal = bootstrap.Modal.getInstance(document.getElementById(closeModalId));
            closeModal.hide();
            setTimeout(function() {
                var openModal = new bootstrap.Modal(document.getElementById(openModalId));
                openModal.show();
            }, 300);
        }
    
 