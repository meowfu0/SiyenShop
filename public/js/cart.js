// FOR CHECKBOXES IN CART
var TotalAmount = "total-amount";
var totalItem = "item-count";
//var checked_Item = "selectAll-count";

// Function to add checked products
function AddCheckedProducts() {
    var totalValue = 0.0;
    var totalQuantity = 0;

    // Loop through each checkbox with class 'checkboxs'
    document.querySelectorAll(".checkboxs").forEach(function (checkbox) {
        if (checkbox.checked) {
            // If the checkbox is checked
            const productId = checkbox.id; // Use checkbox ID as product ID
            const quantityInput = document.querySelector(
                `#quantity_${productId}`
            );

            if (quantityInput) {
                // Ensure the quantity input exists
                let quantity = parseInt(quantityInput.value);

                totalValue += parseFloat(checkbox.value) * quantity;
                totalQuantity += quantity; // Calculate total quantity of checked products
            }
        }
        
    });

    // Update the displayed total value and item count
    document.getElementById(TotalAmount).innerHTML = totalValue.toLocaleString(
        "en-US",
        { minimumFractionDigits: 2, maximumFractionDigits: 2 }
    );
    document.getElementById(totalItem).innerHTML = totalQuantity;
    // document.getElementById(checked_Item).innerHTML = totalQuantity;
}

// SELECT ALL CHECKBOXES
function toggleSelectAll(selectAllCheckbox) {
    const checkboxes = document.querySelectorAll(".checkboxs");
    checkboxes.forEach(function (checkbox) {
        checkbox.checked = selectAllCheckbox.checked;
    });
    AddCheckedProducts(); // Update totals after selecting/deselecting all
    updateCheckedProductIds(); // Call this to update displayed IDs
}

function autoSelectAll() {
    const selectAllCheckbox = document.getElementById("selectAll");
    if (selectAllCheckbox) {
        // Check if the selectAll checkbox exists
        selectAllCheckbox.checked = true;
        toggleSelectAll(selectAllCheckbox);
    }
}

window.onload = function () {
    // autoSelectAll(); // Automatically check all items and call toggleSelectAll
    updateCheckedProductIds(); // Set up event listeners and initial display
};

// Function to update the display of checked product IDs
function updateCheckedProductIds() {
    // Array to store checked product IDs
    let checkedProductIds = [];

    // Add event listener to each checkbox
    document.querySelectorAll(".checkboxs").forEach(function (checkbox) {
        checkbox.addEventListener("click", function () {
            updateProductIdList(checkbox, checkedProductIds);
        });
    });

    // Initialize the list for the current state
    document.querySelectorAll(".checkboxs").forEach((checkbox) => {
        updateProductIdList(checkbox, checkedProductIds);
    });
}

// Helper function to add/remove product ID and update display
function updateProductIdList(checkbox, checkedProductIds) {
    const productId = checkbox.id;

    if (checkbox.checked) {
        // Add productId to the array if it’s not already there
        if (!checkedProductIds.includes(productId)) {
            checkedProductIds.push(productId);
        }
    } else {
        // Remove productId from the array if it’s unchecked
        const index = checkedProductIds.indexOf(productId);
        if (index > -1) {
            checkedProductIds.splice(index, 1);
        }
    }

    //AALISIN SOON PANG CHECK LANG NG ID ITO
    //  document.getElementById("PROD").innerHTML = checkedProductIds.join(', ');

    // Update the checkout button based on the number of checked items

    if (checkedProductIds.length === 0) {
        // Disable the checkout button or show an error message
        const checkoutButton = document.querySelector("#button-size");

        const modalBody = document.querySelector("#ModalProceed .modal-body p");
        modalBody.textContent = "Please choose an item!"; // Change the message

        const noButton = document.querySelector(
            "#ModalProceed .modal-footer .btn-outline-primary"
        );
        const yesButton = document.querySelector(
            "#ModalProceed .modal-footer .btn-primary"
        );

        noButton.style.display = "none"; // Hide the 'Yes' button

        yesButton.style.display = "none"; // Hide the 'Yes' button

        // Show the modal
        $("#ModalProceed").modal("show");
    } else {
        // Update the href for the checkout button with the product IDs
        const encodedIds = btoa(checkedProductIds.join(","));
        const checkoutButton = document.querySelector(
            "#ModalProceed .modal-footer .btn-primary"
        );
        //PASS THE DATA IN THE ARRAY TO OTHER PAGE   - THE ARRAY VALUE IS ID
        checkoutButton.setAttribute(
            "href",
            `/checkOutPage/Checkout-Items/${encodedIds}`
        );

        const noButton = document.querySelector(
            "#ModalProceed .modal-footer .btn-outline-primary"
        );
        const yesButton = document.querySelector(
            "#ModalProceed .modal-footer .btn-primary"
        );

        noButton.style.display = "block";
        yesButton.style.display = "block";

        // Show the modal with the original message
        const modalBody = document.querySelector("#ModalProceed .modal-body p");
        modalBody.textContent = "Proceed to Checkout?"; // Reset to the original message
    }
}

//TO UPDATE QUANTITY OF ITEM IN CART IN DATABASE
document.addEventListener("DOMContentLoaded", function () {
    // Add event listeners to the increment and decrement buttons
    document.querySelectorAll(".quantity-button").forEach((button) => {
        button.addEventListener("click", function () {
            const productId = this.getAttribute("data-id"); // Get the item id from the button's data-id attribute
            const action = this.getAttribute("data-action"); // Get the action (increment or decrement)
            const quantityInput = document.querySelector(
                `#quantity_${productId}`
            );
            let quantity = parseInt(quantityInput.value);

            // Adjust quantity based on action
            if (action === "increment") {
                quantity += 1;
            } else if (action === "decrement" && quantity > 1) {
                quantity -= 1;
            }

            quantityInput.value = quantity;
            AddCheckedProducts();

            // Send an AJAX request to update the quantity
            fetch("/cart/update/" + productId, {
                method: "PATCH", // Use PATCH request for updates
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({
                    product_id: productId,
                    quantity: quantity,
                }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        // Update the UI as needed, such as refreshing the cart summary
                    }
                });
        });
    });
});
//END OF UPDATE QUANTITY OF ITEM IN CART IN DATABASE

// //TO DELETE ITEM FROM CART IN DATABASE
document.addEventListener("DOMContentLoaded", function () {
    const deleteModals = document.querySelectorAll(".delete_modal");

    deleteModals.forEach((deleteModal) => {
        deleteModal.addEventListener("show.bs.modal", function (event) {
            const button = event.relatedTarget; // Button that triggered the modal
            const productId = button.getAttribute("data-id");
            const confirmDeleteButton =
                deleteModal.querySelector("#delete_items");
            confirmDeleteButton.setAttribute("data-id", productId);

            // Only add the event listener if it hasn't been added yet
            const existingDeleteHandler = confirmDeleteButton._deleteHandler;
            if (!existingDeleteHandler) {
                const newDeleteHandler = handleDeleteClick.bind(
                    null,
                    productId,
                    confirmDeleteButton
                );
                confirmDeleteButton.addEventListener("click", newDeleteHandler);
                confirmDeleteButton._deleteHandler = newDeleteHandler;
            }
        });
    });

    function handleDeleteClick(productId, button) {
        fetch(`/cart/remove/${productId}`, {
            method: "DELETE",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": document
                    .querySelector('meta[name="csrf-token"]')
                    .getAttribute("content"),
            },
            body: JSON.stringify({ product_id: productId }),
        })
            .then((response) => response.json())
            .then((data) => {
                console.log(data); // Debugging: Check if "success: true" is received
                if (data.success) {
                    // Find and remove the item card in the DOM
                    const itemCard = document
                        .querySelector(`[data-id="${productId}"]`)
                        .closest(".card-body");
                    if (itemCard) itemCard.remove();

                    // Update modal content to indicate success
                    const modalBody = button
                        .closest(".delete_modal")
                        .querySelector(".modal-body");
                    const modalFooter = button
                        .closest(".delete_modal")
                        .querySelector(".modal-footer");
                    const logo = modalBody.querySelector("img");
                    const buttons = modalFooter.querySelectorAll("button");

                    // Hide the buttons and display the logo
                    modalFooter.style.display = "none";
                    logo.style.display = "block";
                    buttons.forEach(
                        (button) => (button.style.display = "none")
                    );

                    // Update the modal body text to indicate success
                    const message = modalBody.querySelector("p");
                    message.textContent = "Item removed successfully!";

                    // Auto reload the page after a short delay
                    setTimeout(() => {
                        window.location.reload(); // Reload the page
                    }, 300); // Wait 1 second before reloading
                } else {
                    alert("An error occurred while removing the item.");
                }
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while removing the item.");
            });
    }
});
//end of delete item//

//TO UPDATE SIZE OF ITEM IN CART IN DATABASE
document.addEventListener("DOMContentLoaded", function () {
    // Event delegation for dynamically loaded elements
    document.body.addEventListener("change", function (event) {
        if (event.target.classList.contains("sizeDropdown")) {
            let selectedSize = event.target.value;
            let itemId = event.target.dataset.itemId; // Get the item ID from the data-item-id attribute

            // Send the fetch request
            fetch(`/cart/update/size/${itemId}`, {
                method: "PATCH",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": document
                        .querySelector('meta[name="csrf-token"]')
                        .getAttribute("content"),
                },
                body: JSON.stringify({ size: selectedSize }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        //alert("Size updated successfully.");
                    } else {
                        alert("Failed to update size.");
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                    alert("Error occurred while updating the size.");
                });
        }
    });
});
