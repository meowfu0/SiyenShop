
// FOR CHECKBOXES IN CART
var TotalAmount = "total-amount";
var totalItem = "item-count";
var checked_Item = "selectAll-count";

// Function to add checked products
function AddCheckedProducts() {
    var totalValue = 0.0;
    var totalQuantity = 0;

    // Loop through each checkbox with class 'checkboxs'
    document.querySelectorAll('.checkboxs').forEach(function(checkbox) {
        if (checkbox.checked) { // If the checkbox is checked
            const productId = checkbox.id; // Use checkbox ID as product ID
            const quantityInput = document.querySelector(`#quantity_${productId}`);
            
            if (quantityInput) { // Ensure the quantity input exists
                let quantity = parseInt(quantityInput.value);

                totalValue += parseFloat(checkbox.value) * quantity;
                totalQuantity += quantity; // Calculate total quantity of checked products
            }
        }
    });

    // Update the displayed total value and item count
    document.getElementById(TotalAmount).innerHTML = totalValue.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
    document.getElementById(totalItem).innerHTML = totalQuantity;
    document.getElementById(checked_Item).innerHTML = totalQuantity;
}


//SELECT ALL CHECKBOXES
function toggleSelectAll(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll('.checkboxs');
    checkboxes.forEach(function(checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
    });
    AddCheckedProducts(); // Update totals after selecting/deselecting all
}

function autoSelectAll() {
    var selectAllCheckbox = document.getElementById('selectAll'); 
    if (selectAllCheckbox) { // Check if the selectAll checkbox exists
        selectAllCheckbox.checked = true; 
        toggleSelectAll(selectAllCheckbox); 
    }
}

window.onload = function() {
    autoSelectAll(); // Automatically check all items and call toggleSelectAll
};



//TO UPDATE QUANTITY OF ITEM IN CART IN DATABASE
document.addEventListener('DOMContentLoaded', function () {
    // Add event listeners to the increment and decrement buttons
    document.querySelectorAll('.quantity-button').forEach(button => {
        button.addEventListener('click', function () {
            const productId = this.getAttribute('data-id'); // Get the item id from the button's data-id attribute
            const action = this.getAttribute('data-action'); // Get the action (increment or decrement)
            const quantityInput = document.querySelector(`#quantity_${productId}`);
            let quantity = parseInt(quantityInput.value);

            // Adjust quantity based on action
            if (action === 'increment') {
                quantity += 1;
               
                
            } else if (action === 'decrement' && quantity > 1) {
                quantity -= 1;
            }
            
            quantityInput.value = quantity;
            AddCheckedProducts();

            // Send an AJAX request to update the quantity
            fetch('/cart/update/' + productId, {
                method: 'PATCH', // Use PATCH request for updates
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity
                })
            }).then(response => response.json())
              .then(data => {
                  if (data.success) {
                      // Update the UI as needed, such as refreshing the cart summary
                  }
              });
        });
    });
});


//TO DELETE ITEM FROM CART IN DATABASE
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



