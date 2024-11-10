var ShopItems = Array.from({ length: 100 }, (_, i) => (i + 1).toString()); // Array of ShopItem IDs (1 to 100)
var TotalAmount = "total-amount";
var totalItem = "item-count";
var checked_Item = "selectAll-count";

// Function to add checked products
function AddCheckedProducts() {
    var totalValue = 0.0;
    var totalQuantity = 0;

    // Loop through each ShopItem
    for (var i = 0; i < ShopItems.length; i++) {
        var checkbox = document.getElementById(ShopItems[i]); // Get checkbox element by ID

        if (checkbox && checkbox.checked) { // If the checkbox is checked
            var quantityInput = document.getElementById("quantity_" + ShopItems[i]); // Get the quantity input element for the product
            var quantity = parseInt(quantityInput.value) || 1;
            totalValue += parseFloat(checkbox.value) * quantity;
            totalQuantity += quantity; // Calculate total quantity of checked products
        }
    }

    // Update the displayed total value and item count
    document.getElementById(TotalAmount).innerHTML = totalValue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById(totalItem).innerHTML = totalQuantity;
    document.getElementById(checked_Item).innerHTML = totalQuantity;
}

// Decrement quantity function
function decrementQuantity(inputId) {
    let input = document.getElementById(inputId);
    let value = parseInt(input.value); // Get current value of the quantity input
    if (value > 1) {
        input.value = value - 1;
    }
    AddCheckedProducts(); // Recalculate total when quantity is changed (minus)
}

// Increment quantity function
function incrementQuantity(inputId) {
    let input = document.getElementById(inputId);
    let value = parseInt(input.value);
    input.value = value + 1;
    AddCheckedProducts(); // Recalculate total when quantity is changed (add)
}

// Function to toggle select all checkboxes and set their quantities
function toggleSelectAll(selectAllCheckbox) {
    var selectedCount = 0;

    // Loop through each ShopItem
    for (var i = 0; i < ShopItems.length; i++) {
        var checkbox = document.getElementById(ShopItems[i]);

        if (checkbox) {
            checkbox.checked = selectAllCheckbox.checked; // Set checkbox checked status based on select all checkbox

            var quantityInput = document.getElementById("quantity_" + ShopItems[i]);
            if (selectAllCheckbox.checked && quantityInput.value == "0") {
                quantityInput.value = "1"; // Reset quantity value to 1 if select all is checked and quantity is 0
            }

            // Count the number of checked items
            if (checkbox.checked) {
                selectedCount++;
            }
        }
    }

    // Update the count displayed in the span
    document.getElementById("selectAll-count").innerText = selectedCount;

    AddCheckedProducts(); // Recalculate total when select all button is checked
}

// Function to update item IDs dynamically
function updateShopItemsId() {
    var idCounter = 1;
    var items = document.querySelectorAll('.checkboxs'); // Select all checkboxes

    items.forEach(function (checkbox) {
        checkbox.id = idCounter; // Set checkbox ID dynamically
        var quantityInput = document.getElementById("quantity_" + idCounter);
        if (quantityInput) {
            quantityInput.id = "quantity_" + idCounter; // Set the corresponding quantity input ID dynamically
        }

        // Automatically check all checkboxes on page load
        checkbox.checked = true; // Set each checkbox to be checked

        idCounter++; // Increment the counter for the next item
    });
}

// Function to automatically select the "Select All" checkbox and check all items
function autoSelectAll() {
    var selectAllCheckbox = document.getElementById('selectAll'); // Assuming your "Select All" checkbox has the ID 'selectAll'
    selectAllCheckbox.checked = true; // Set "Select All" checkbox to checked
    toggleSelectAll(selectAllCheckbox); // Call the toggleSelectAll function to check all individual checkboxes
}

// Call the function to update item IDs and auto-select all checkboxes after the page has loaded
window.onload = function() {
    updateShopItemsId(); // Update IDs of items
    autoSelectAll(); // Automatically check all items and call toggleSelectAll
};

document.addEventListener('DOMContentLoaded', function() {
    // Listen for when the modal is shown
    const deleteModals = document.querySelectorAll('.modal');

    deleteModals.forEach(deleteModal => {
        deleteModal.addEventListener('show.bs.modal', function(event) {
            const button = event.relatedTarget; // The button that triggered the modal
            const productId = button.getAttribute('data-id'); // Get the item id from the button's data-id attribute

            // Update the delete button's data-id with the correct item id
            const confirmDeleteButton = deleteModal.querySelector('.btn-danger.remove');
            confirmDeleteButton.setAttribute('data-id', productId);
        });
    });

    // Attach a click event to all delete buttons inside the modal footer
    document.querySelectorAll('.modal-footer .btn-danger.remove').forEach(button => {
        button.addEventListener('click', function() {
            const productId = this.getAttribute('data-id'); // Get the item id from the button's data-id attribute

            // Send an AJAX request to delete the item
            fetch('/cart/remove/' + productId, {
                method: 'DELETE', // Use DELETE request
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId
                })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    // Find and remove the item card in the DOM
                    const itemCard = document.querySelector(`[data-id="${productId}"]`).closest('.card-body');
                    if (itemCard) {
                        itemCard.remove();
                    }

                    // Update modal content to indicate success
                    const modalBody = this.closest('.modal').querySelector('.modal-body');
                    const modalFooter = this.closest('.modal').querySelector('.modal-footer');

                    const logo = modalBody.querySelector('img');
                    const buttons = modalFooter.querySelectorAll('button');

                    // Hide the buttons and display the logo
                    modalFooter.style.display = 'none';
                    logo.style.display = 'block';
                    buttons.forEach(button => {
                        button.style.display = 'none';
                    });

                    // Update the modal body text to indicate success
                    const message = modalBody.querySelector('p');
                    message.textContent = 'Item removed successfully!';

                    // Auto reload the page after a short delay
                    setTimeout(() => {
                        window.location.reload(); // Reload the page
                    }, 1000); // Wait 1 second before reloading
                } else {
                    alert('An error occurred while removing the item.');
                }
            })
            .catch(error => {
                console.error('Error:', error);
                alert('An error occurred while removing the item.');
            });
        });
    });
});
