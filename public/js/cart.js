//declarations

var ShopItems = new Array("item1", "item2"); //array same process php
    
var TotalAmount= "total-amount";
var totalItem = "item-count";

//adding the products
function AddCheckedProducts() {
var totalValue = 0.0;
var totalQuantity = 0;
for (var i = 0; i < ShopItems.length; i++) {
    var checkbox = document.getElementById(ShopItems[i]);
    if (checkbox.checked) {
        var quantityInput = document.getElementById("quantity_" + ShopItems[i]);
        var quantity = parseInt(quantityInput.value) || 1;
        totalValue += parseFloat(checkbox.value) * quantity;
        totalQuantity += quantity;  // the total quantity of checked checkbox
    }
}
document.getElementById(TotalAmount).innerHTML = totalValue.toLocaleString('en-US');//set the total amount
document.getElementById(totalItem).innerHTML = totalQuantity; //set  no. of items of prod.

}

function decrementQuantity(inputId) {
let input = document.getElementById(inputId);
let value = parseInt(input.value);
if (value > 1) {
    input.value = value - 1;
}
AddCheckedProducts();  // Recalculate total when quantity is changed(minus)
}

function incrementQuantity(inputId) {
let input = document.getElementById(inputId);
let value = parseInt(input.value);
input.value = value + 1;
AddCheckedProducts();  // Recalculate total when quantity is changed(add)
}

// Select All and changing the quantity per item
function toggleSelectAll(selectAllCheckbox) {
for (var i = 0; i < ShopItems.length; i++) {
    var checkbox = document.getElementById(ShopItems[i]);

    checkbox.checked = selectAllCheckbox.checked;  // Set all chekbox to chcked status
    var quantityInput = document.getElementById("quantity_" + ShopItems[i]);
    if (selectAllCheckbox.checked && quantityInput.value == "0") {
        quantityInput.value = "1";  // to reset the value
    }
}
AddCheckedProducts();  // Recalculate total when select all button is checked
}

