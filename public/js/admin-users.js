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

        // Fetch user details and roles
        fetch(toEdit.replace(':userId', userId), {
            method: 'GET',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            }
        })
        .then(response => response.json())
        .then(data => {
            console.log('Fetched data:', data);

            if (!data.roles || !data.user) {
                alert('Invalid data format from the server.');
                return;
            }

            // Set the hidden input field for userId
            document.getElementById('userId').value = userId;
            
            // Extract and set user data for the modal
            const name = `${data.user.first_name} ${data.user.last_name}`;
            const email = data.user.email;
            const course = data.user.course?.course_name || "N/A";
            const status = data.user.status?.status_name || "N/A";
            const block = data.user.course_bloc;
            const year = data.user.year;

            // Insert data into modal
            document.getElementById('modalName').innerText = name;
            document.getElementById('modalStatus').innerText = status;
            document.getElementById('modalEmail').innerText = email;
            document.getElementById('modalCourse').innerText = course;
            document.getElementById('modalYear').innerText = year;
            document.getElementById('modalBlock').innerText = block;

            // Set the role dropdown value
            const rolesDropdown = document.getElementById('modalRole');
            rolesDropdown.innerHTML = ''; // Clear existing options
            rolesDropdown.disabled = true;
            data.roles.forEach(role => {
                const option = document.createElement('option');
                option.value = role.id; // Use the correct role ID
                option.textContent = role.role_name; // Display the role name
                if (role.id === data.user.role_id) { // Check FK
                    option.selected = true; // Mark the current role as selected
                }
                else if (role.role_name === 'Admin'){
                    option.hidden = true;
                }
                rolesDropdown.appendChild(option); // Append the option to the dropdown
            });

            // Show "Edit Permissions" link if role is "Business Manager"
            const editPermissionsLink = document.getElementById('editPermissionsLink');
            if (data.user.role && data.user.role.id === 2) { // Adjust role ID for "Business Manager"
                editPermissionsLink.style.display = 'inline-block';
            } 
            else {
                editPermissionsLink.style.display = 'none';
            }

            editPermissionsLink?.addEventListener('click', function(){
                var myModal = new bootstrap.Modal(document.getElementById('editPermissionsModal'));
                fetchPermissions(userId); 
                myModal.show();
                
            });

            // Set the user ID on the modal to pass it to the update function
            document.getElementById('userInfoModal').setAttribute('data-user-id', userId);

            // Show the modal
            var myModal = new bootstrap.Modal(document.getElementById('userInfoModal'));
            myModal.show();

            const saveBtn = document.getElementById('saveBtn'); // Define Save button
            const editBtn = document.getElementById('editBtn');
            const deactivateBtn = document.getElementById('deactivateBtn');
            const cancelBtn = document.getElementById('cancelBtn');
            const roleDropdown = document.getElementById('modalRole');
            const confirmDeactivateBtn = document.getElementById('confirmDeactivateBtn'); 
            const cancelDeactBtn = document.getElementById('cancelDeactBtn');
            let savedRoleValue = roleDropdown.value;
            let isEditing = false;
        
            // When the Edit button is clicked
            editBtn?.addEventListener('click', function () {
                if (!isEditing) {
                    roleDropdown.disabled = false;
                    editBtn.style.display = 'none';
                    saveBtn.style.display = 'inline';
                    deactivateBtn.style.display = 'none';
                    cancelBtn.style.display = "inline"; 
                    document.querySelectorAll('.editable-field').forEach(field => field.disabled = false);
                    isEditing = true;
                } 
            });
        
            // When Save Changes is clicked, update the role and save changes
            saveBtn?.addEventListener('click', function () {
                const selectedRoleId = roleDropdown.value; // Get updated role ID from the dropdown
                updateRole(userId, selectedRoleId); // Pass both user ID and role ID to the updateRole function
            
                // After saving, reset the buttons to their original state
                resetButtons();
            });

            confirmDeactivateBtn?.addEventListener('click', function(){
                const userStatus = 2;
                deactivate(userId, userStatus); 
            })
            
        
            // Cancel edit when Cancel button is clicked
            cancelBtn?.addEventListener('click', function () {
                if (isEditing) {
                    alert('Edit canceled!');
                    roleDropdown.value = savedRoleValue;
                    resetButtons();
                } 
            });

            deactivateBtn?.addEventListener('click', function(){
                const confirmDeactivateModal = new bootstrap.Modal(document.getElementById('confirmDeactivateModal'));
                confirmDeactivateModal.show();
            }); 

            cancelDeactBtn?.addEventListener('click', function(){
                const cancelDeactivateModal = new bootstrap.Modal(document.getElementById('confirmDeactivateModal'));
                cancelDeactivateModal.hide();
            }); 
                
            
                            // Reset the modal buttons
    function resetButtons() {
        roleDropdown.disabled = true;
        editBtn.style.display = 'inline';
        saveBtn.style.display = 'none';
        deactivateBtn.style.display = 'inline';
        cancelBtn.style.display = "none"; 
        document.querySelectorAll('.editable-field').forEach(field => field.disabled = true);
        isEditing = false;
    }
                
        });
    }
});

// Function to fetch and display user permissions
function fetchPermissions(userId) {
    console.log('User ID:', userId);

    fetch(permissionFetch.replace(':userId', userId), {
        method: 'GET',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
    })
    .then(response => response.json())
    .then(data => {
        
        console.log('Fetched permissions:', data);

        if (!data.permissions) {
            console.error('Permissions not found in the response.');
            return;
        }
        data.permissions.forEach(permission => {
            // Find the checkbox that corresponds to the permission
            const permissionCheckbox = document.getElementById(`allowable-${permission.id}`);
            if (permissionCheckbox) {
                permissionCheckbox.checked = true; // Check the checkbox
            }
        });
    })
    .catch(error => {
        console.error('Error fetching permissions:', error);
        alert('Error fetching permissions.');
    });
}


// Function to update the role in the database
function updateRole(userId, selectedRoleId) {
    console.log('User ID:', userId);
    console.log('Selected Role ID:', selectedRoleId);

    fetch(updateRoles.replace(':userId', userId), {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ role_id: selectedRoleId })
    })
    .then(response => {
        console.log('Response status:', response.status); // Log status code
        if (response.ok) {
            alert('User role updated successfully.');
            location.reload();
        } 
        else {
            return response.json().then(data => {
                throw new Error(data.message || 'Failed to update role');
            });
        }
    })
    .catch(error => {
        console.error('Error updating role:', error);
        alert('Failed to update role. User ID: ' + userId + ', Role ID: ' + selectedRoleId + '. Error: ' + error.message);
    });
}

function deactivate(userId, status){
    fetch(alterStatus.replace(':userId', userId), {
        method: 'PUT',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body: JSON.stringify({ statusId: status })
    })
    .then(response => {
        console.log('Response status:', response.status); // Log status code
        if (response.ok) {
            alert('User account deactivated successfully.');
            location.reload();
        } 
        else {
            return response.json().then(data => {
                throw new Error(data.message || 'Deactivation failed');
            });
        }
    })
    .catch(error => {
        console.error('Error deactivating user:', error);
        alert('Error deactivating user. User ID: ' + userId + ', Status: ' + status + '. Error: ' + error.message);
    });
}




