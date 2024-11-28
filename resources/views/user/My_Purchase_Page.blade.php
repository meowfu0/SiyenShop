<header>
    <title>My Purchases</title>
    <!-- jQuery (optional, if needed for other purposes) -->
    <!-- jQuery -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</header>


    <!--modal cover-->

<div class="adjust">
    <div class="content-purchase">
    <!-- Title and Buttons -->
    <div class="content-title-purchase">
        <img src="{{ asset('images/products.svg') }}" class="logo-img">
        <h1>My Purchases</h1>
    </div>

    <div class="buttons">
            <button id="pend" onclick="filterOrders(7)">Pending</button>
            <button id="prec" onclick="filterOrders(10)">Received Payment</button>
            <button id="fpick" onclick="filterOrders(11)">For Pickup</button>
            <button id="ocomp" onclick="filterOrders(12)">Completed Orders</button>
            <button id="den" onclick="filterOrders(6)">Denied Payments</button>
    <div id="innerLine"></div>
    </div>

    <div class="lineBar">
        <div id="dLine"></div>
    </div>
            <!-- Orders Table -->
            <table id="ordersTable">
                @foreach ($orders as $order)
                    <tr class="order-row" data-status="{{ $order->order_status_id }}"
                        style="
                            @if($order->order_status_id == 6)
                                display: none;
                            @elseif($order->order_status_id == 12 || $order->order_status_id == 11 || $order->order_status_id == 10)
                                display: none;
                            @else
                                display: table;
                            @endif
                        ">
                        <script>console.log("{{ $order->id }}")</script>
                        <td class="order-cell">
                            <!-- Header Content -->
                            <div class="other-content-high">
                                <button class="shopName">{{ $order->shop ? $order->shop->shop_name : 'Unknown Shop' }}</button>
                                <button class="status-box" style="
                                    @if($order->order_status_id == 6)
                                        border-color: #eb5757; color: #eb5757;
                                    @elseif($order->order_status_id == 12)
                                        border-color: #28a745; color: #28a745;
                                    @else
                                        border-color: #ffc107; color: #ffc107;
                                    @endif
                                ">
                                    {{ 
                                        $order->order_status_id == 7 ? 'Pending' : 
                                        ($order->order_status_id == 10 ? 'Payment Received' : 
                                        ($order->order_status_id == 11 ? 'Ready for Pickup' : 
                                        ($order->order_status_id == 12 ? 'Completed' : 'Denied'))) 
                                    }}
                                </button>
                            </div>

                            <!-- Item Image -->
                            <div class="item-img"></div>

                            <!-- Order Details Table -->
                            <table class="dets">
                                <tr>
                                    <th>Item</th>
                                    <th>Category</th>
                                    <th>Variant/Size</th>
                                    <th>Quantity</th>
                                    <th>Price</th>
                                </tr>
                                <tr>
                                    <td data-label="Item">N / A</td>
                                    <td data-label="Category">Category</td>
                                    <td data-label="Variant/Size">Size</td>
                                    <td data-label="Quantity">{{ $order->total_items }}</td>
                                    <td data-label="Price">P {{ $order->supplier_price_total_amount }}</td>
                                </tr>
                            </table>

                            <!-- Additional Order Info -->
                            <div class="other-content-low">
                                <h5>TOTAL:</h5>
                                <p id="idTaker" style="display: none">{{ $order->id }}</p>
                                <p class="costPrice">P{{ number_format($order->total_amount, 2) }}</p>
                                <p class="itemLab">Item(s):</p>
                                <p class="itemCount">{{ $order->total_items }}</p>
                                <p class="dateLabel">Date:</p>
                                <p class="date">{{ \Carbon\Carbon::parse($order->order_date)->format('m-d-Y') }}</p>
                                <p class="time">{{ \Carbon\Carbon::parse($order->order_date)->format('h:i a') }}</p>
                                <button class="btn btn-light">Contact Seller</button>
                                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetailsModal" onclick="openModalYes({{ $order }}, {{ $orderItems }}, {{ $categories }})">View Details</button>

                                <!-- Multiple Indicator -->
                                <p class="multiple-indicator" id="multipleIndicator_{{ $order->id }}">Multiple items available. Click 'View Details' to see more</p>
                                <script>
                                    console.log("{{ $order->id }}");
                                    fetch("{{ route('count_orders', ['orderId' => $order->id]) }}")
                                        .then(response => response.json())
                                        .then(data => {
                                            console.log("Item No" +data.distinct_item_count);
                                            if (data.distinct_item_count <= 1) {
                                                document.getElementById('multipleIndicator_{{ $order->id }}').style.display = 'none';
                                            }
                                        });
                                </script>
                                
                            </div>
                        </td>
                    </tr>
                @endforeach      
            </table>
            <!-- Modal -->
            <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsLabel-{{ $order->id }}" aria-hidden="true">
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">
                                <!-- Modal Header -->
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                <div class="modal-header">
                                    <img alt="Toggle navigation" style="width: 25px; height: 25px;" id="shopImg">
                                    <h5 class="modal-title" id="orderDetailsLabel"></h5>
                                    <div class="p-10 mb-2 bg-light text-dark" id="modalStatus" style="padding-top:18px;">Test</div>
                                </div>
                                
                                <!-- Modal Body -->
                                <div class="modal-body">
                                <div class="modal-items">
                                    <table class="modal-item-table">
                                    <tr class="modal-rows">
                                        <td class="modal-td">
                                            <div class="img-holder">
                                            </div>
                                            <table class="modal-item-details">
                                                <tr>
                                                    <th>Item</th>
                                                    <th>Category</th>
                                                    <th>Variant/Size</th>
                                                    <th>Quantity</th>
                                                    <th>Price</th>
                                                </tr>
                                                <tr>
                                                    <td>Peter's Sweat Juice</td>
                                                    <td>Parang Human</td>
                                                    <td>Small</td>
                                                    <td>1</td>
                                                    <td>P2.00</td>
                                                </tr>
                                            </table>
                                        </td>
                                    </tr>
                                
                                </table>
                                </div>
                                <hr style="width: 100%; margin-left: 5px;">
                                    <div class="transact-col1">
                                        <p>Order ID:</p>
                                        <p>Total Amount:</p>
                                        <p>Payment Method:</p>
                                        <p>Proof of Payment:</p>
                                        <p>Reference No.:</p>
                                    </div>
                                    <div class="transact-col2">
                                        <p id="modalOrderId"></p>
                                        <p id="modalTotalAmount"></p>
                                        <p id="modalPaymentMethod"></p>
                                        <p id="modalProofOfPayment"></p>
                                        <p id="modalReferenceNumber"></p>
                                    </div>
                                    <div class="transact-col3">
                                        <p>Date:</p>
                                        <p>Time:</p>
                                        <p>Item(s):</p>
                                    </div>
                                    <div class="transact-col4">
                                        <p id="modalDate"></p>
                                        <p id="modalTime"></p>
                                        <p id="modalItemCount"></p>
                                    </div>
                                <!-- Modal Footer -->
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                                    <button type="button" class="btn btn-primary" id="rateButton" data-bs-dismiss="modal" onclick="showRate()">Rate Order</button>
                                    <button type="button" class="btn btn-primary">Contact Seller</button>

                                </div>
                            </div>
                        </div>
                    </div>
            </div>
    </div>
    <div id="modal-cover">
    </div>
    <div id="msg-modal" class="custom-modal">
        <img src="{{ asset('images/check.svg') }}" class="logo-img">
        <h3>Thanks for your review.</h3>
        <button type="button" class="btn btn-primary" onclick="closeMsg()">Proceed</button>
    </div>
    <div id="rateModal" class="custom-modal">
            <button type="button" class="btn-close" data-bs-dismiss="modal" onclick="closeRate()"></button> 
                <h3>Rate Order</h3>
                    <div class="rate-stars">
                        <button id="star-button1" class="star-button"></button>
                        <button id="star-button2" class="star-button"></button>
                        <button id="star-button3" class="star-button"></button>
                        <button id="star-button4" class="star-button"></button>
                        <button id="star-button5" class="star-button"></button>
                    </div>
                <button id="clear-stars">Clear Ratings</button>
                <div class="rate-comment">
                <h5>Comment</h5>
                <textarea name="comment" rows="4" cols="50" id="revMsg"></textarea>
            </div>
            <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="closeRate()">Close</button>
            <button type="button" class="btn btn-primary" id="submit-ratings" onclick="submitRate()">Submit</button>
    </div>
</div>
    <script>
        
function filterOrders(statusId) {
    const rows = document.querySelectorAll('#ordersTable .order-row');
    
    rows.forEach(row => {
        const orderStatus = parseInt(row.getAttribute('data-status'), 10);
        if (orderStatus === statusId) {
            row.style.display = '';
        } else {
            row.style.display = 'none';
        }
    });
}

    document.addEventListener('DOMContentLoaded', function () {
        filterOrders(7);
    });

    function openModalYes(yesId, orderItem, category) {
    // Modal field references
    if(yesId.order_status_id == 12){
        document.getElementById('rateButton').style.setProperty('display', 'block', 'important');
    }else{
        document.getElementById('rateButton').style.setProperty('display', 'none', 'important');
    }
    console.log(yesId.order_status_id);
    document.getElementById('orderDetailsLabel').textContent = yesId.shop.shop_name;
    document.getElementById('shopImg').src = yesId.shop.shop_logo;
    setStatus(yesId.order_status_id);

    console.log('Current Order: '+yesId.shop.shop_logo);
    const specificItems = orderItem.filter(orderItem => orderItem.order_id === yesId.id);
    console.log(specificItems);
    createModalTable(specificItems, category);

    var modalOrderId = document.getElementById('modalOrderId');
    var modalTotalAmount = document.getElementById('modalTotalAmount');
    var modalPaymentMethod = document.getElementById('modalPaymentMethod');
    var modalProofOfPayment = document.getElementById('modalProofOfPayment');
    var modalReferenceNumber = document.getElementById('modalReferenceNumber');
    var modalDate = document.getElementById('modalDate');
    var modalTime = document.getElementById('modalTime');
    var modalItemCount = document.getElementById('modalItemCount');

    // Fetch the order details
 
    modalOrderId.textContent = yesId.id;
    modalTotalAmount.textContent = `P${parseFloat(yesId.total_amount).toFixed(2)}`;
    modalPaymentMethod.textContent = yesId.payment_method || "N/A"; // Default to "N/A" if null
    modalProofOfPayment.textContent = yesId.proof_of_payment || "No proof uploaded";
    modalReferenceNumber.textContent = yesId.reference_number || "No reference available";
            
    // Format date and time
    const orderDate = new Date(yesId.order_date);
    const formattedDate = `${String(orderDate.getMonth() + 1).padStart(2, '0')}-${String(orderDate.getDate()).padStart(2, '0')}-${orderDate.getFullYear()}`;
    const formattedTime = orderDate.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }).toLowerCase();
    modalDate.textContent = formattedDate;
    modalTime.textContent = formattedTime;
            
    modalItemCount.textContent = yesId.total_items;
       
}
function createModalTable(orderItems, category) {
    // Get the modal table container
    const modalTable = document.querySelector('.modal-item-table');
    
    // Clear any existing content
    modalTable.innerHTML = '';

    // Loop through the order items
    orderItems.forEach(item => {
        // Create a wrapper row for the image holder and table
        const modalRow = document.createElement('tr');
        modalRow.classList.add('modal-rows');

        // Create the image holder
        const imgHolder = document.createElement('div');
        imgHolder.classList.add('img-holder');

        // Add the product image to the image holder
        const img = document.createElement('img');
        
        img.src = item.product.product_image;
        imgHolder.appendChild(img);

        // Create the product details table
        const itemDetailsTable = document.createElement('table');
        itemDetailsTable.classList.add('modal-item-details');

        // Add table headers if needed
        itemDetailsTable.innerHTML = `
            <tr>
                <th>Item</th>
                <th>Category</th>
                <th>Variant/Size</th>
                <th>Quantity</th>
                <th>Price</th>
            </tr>
        `;

        let categ; // Variable to store the category name
        // Find the matching category object
        const matchedCategory = category.find(category => category.id === item.product.category_id);
        console.log(matchedCategory);
        // If found, set categ to the category_name
        if (matchedCategory) {
            categ = matchedCategory.category_name;
        } else {
            categ = 'No category'; // Default value if no match is found
        }
        console.log(categ);

        const itemRow = document.createElement('tr');
        itemRow.innerHTML = `
            <td>${item.product.product_name}</td>
            <td>${categ}</td>
            <td>${item.product_variant.size || "N/A"}</td>
            <td>${item.quantity}</td>
            <td>P${parseFloat(item.price).toFixed(2)}</td>
        `;

        // Append the item row to the item details table
        itemDetailsTable.appendChild(itemRow);

        // Combine the image holder and the table into the modal row
        const modalTd = document.createElement('td');
        modalTd.classList.add('modal-td');
        modalTd.appendChild(imgHolder);
        modalTd.appendChild(itemDetailsTable);
        modalRow.appendChild(modalTd);

        // Append the modal row to the modal table
        modalTable.appendChild(modalRow);
    });
}
function setStatus(status) {
    var modalStatus = document.getElementById("modalStatus");

    // Remove all existing status classes
    modalStatus.classList.remove("denied-payment", "completed-order", "pending", "received-payment", "for-pickup");

    // Add the corresponding class based on the status
    switch (status) {
        case 6:
            modalStatus.classList.add("denied-payment");
            modalStatus.textContent = "Payment Denied";
            modalStatus.style.setProperty('color', '#eb5757', 'important'); // Add !important
            break;
        case 12:
            modalStatus.classList.add("completed-order");
            modalStatus.textContent = "Order Completed";
            modalStatus.style.setProperty('color', '#28a745', 'important'); // Add !important
            break;
        case 7:
            modalStatus.classList.add("pending");
            modalStatus.textContent = "Pending";
            modalStatus.style.setProperty('color', '#ffc107', 'important'); // Add !important
            break;
        case 10:
            modalStatus.classList.add("received-payment");
            modalStatus.textContent = "Payment Received";
            modalStatus.style.setProperty('color', '#ffc107', 'important'); // Add !important
            break;
        case 11:
            modalStatus.classList.add("for-pickup");
            modalStatus.textContent = "Ready for Pickup";
            modalStatus.style.setProperty('color', '#ffc107', 'important'); // Add !important
            break;
        default:
            modalStatus.classList.add("bg-light");
            modalStatus.textContent = "Unknown Status";
    }
}

function closeRate(){
    resetStars();
    const modal = document.getElementById('rateModal');
    const backdrop = document.getElementById('modal-cover');

    // Add the fade-out effect
    modal.classList.remove('custom-show');
    backdrop.classList.remove('custom-show');

    // Wait for the CSS transition to complete before hiding the modal
    setTimeout(() => {
        modal.style.display = 'none'; // Completely hide modal
        backdrop.style.display = 'none'; // Hide backdrop
    }, 400); // Match the CSS transition duration (300ms)
}
function showRate() {
    const modal = document.getElementById('rateModal');
    const backdrop = document.getElementById('modal-cover');

    // Ensure modal is visible before applying fade-in effect
    modal.style.display = 'block';
    backdrop.style.display = 'block';

    // Add fade-in effect
    setTimeout(() => {
        modal.classList.add('custom-show');
        backdrop.classList.add('custom-show');
    }, 400); // Trigger transition immediately
}
function submitRate(userId, ){

    resetStars();
    const modal = document.getElementById('msg-modal');
    const backdrop = document.getElementById('rateModal');

    // Ensure modal is visible before applying fade-in effect
    modal.style.display = 'block';
    backdrop.classList.remove('custom-show');

    // Wait for the CSS transition to complete before hiding the modal
    setTimeout(() => {
        backdrop.style.display = 'none'; // Hide backdrop
    }, 400); // Match the CSS transition duration (300ms)

    // Add fade-in effect
    setTimeout(() => {
        modal.classList.add('custom-show');
        backdrop.classList.add('custom-show');
    }, 400); // Trigger transition immediately
}
function closeMsg(){
    const modal = document.getElementById('msg-modal');
    const backdrop = document.getElementById('modal-cover');

    // Add the fade-out effect
    modal.classList.remove('custom-show');
    backdrop.classList.remove('custom-show');

    // Wait for the CSS transition to complete before hiding the modal
    setTimeout(() => {
        modal.style.display = 'none'; // Completely hide modal
        backdrop.style.display = 'none'; // Hide backdrop
    }, 400); // Match the CSS transition duration (300ms)
}
// Event listener for the Rate Order button
var star1 = document.getElementById('star-button1');
    var star2 = document.getElementById('star-button2');
    var star3 = document.getElementById('star-button3');
    var star4 = document.getElementById('star-button4');
    var star5 = document.getElementById('star-button5');
    var clearButton = document.getElementById('clear-stars');
    
    const stars = [
        star1,
        star2,
        star3,
        star4,
        star5
    ];
    
    let selectedIndex = -1; // Keep track of the selected star
    
    // Function to handle mouse enter
    function handleMouseEnter(index) {
        for (let i = 0; i < stars.length; i++) {
            stars[i].style.backgroundColor = i <= index ? '#E2B93B' : 'rgb(231, 231, 231)';
        }
    }
    
    // Function to handle mouse leave
    function handleMouseLeave() {
        for (let i = 0; i < stars.length; i++) {
            stars[i].style.backgroundColor = i <= selectedIndex ? '#E2B93B' : 'rgb(231, 231, 231)';
        }
    }
    
    // Function to handle click
    function handleClick(index) {
        selectedIndex = index; // Update selected index
        clearButton.style.display = 'block';
        handleMouseLeave(); // Update stars display based on selection
    }
    
    // Add event listeners for each star
    stars.forEach((star, index) => {
        star.addEventListener('mouseenter', () => handleMouseEnter(index));
        star.addEventListener('mouseleave', handleMouseLeave);
        star.addEventListener('click', () => handleClick(index));
    });
    
    function resetStars() {
        // Reset all stars to default color
        stars.forEach(star => {
            star.style.backgroundColor = 'rgb(231, 231, 231)';
        });
        clearButton.style.display = 'none';
        selectedIndex = -1; // Reset selected index
    }
 function resetStars() {
        // Reset all stars to default color
        document.getElementById('revMsg').value = '';
        stars.forEach(star => {
            star.style.backgroundColor = 'rgb(231, 231, 231)';
        });
        clearButton.style.display = 'none';
        selectedIndex = -1; // Reset selected index
    }
</script>