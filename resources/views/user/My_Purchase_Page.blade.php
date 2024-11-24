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
        <tr class="order-row" data-status="{{ $order->order_status_id }}">
            <td class="order-cell">
                <!-- Header Content -->
                <div class="other-content-high">
                    <button class="shopName">{{ $order->shop ? $order->shop->shop_name : 'Unknown Shop' }}</button>
                    <button class="status-box" style="
                        @if($order->order_status_id == 6)
                            border-color: #eb5757; color: #eb5757;
                        @elseif($order->order_status_id == 12)
                            border-color: green; color: green;
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
                    <p class="costPrice">P{{ number_format($order->total_amount, 2) }}</p>
                    <p class="itemLab">Item(s):</p>
                    <p class="itemCount">{{ $order->total_items }}</p>
                    <p class="dateLabel">Date:</p>
                    <p class="date">{{ \Carbon\Carbon::parse($order->order_date)->format('m-d-Y') }}</p>
                    <p class="time">{{ \Carbon\Carbon::parse($order->order_date)->format('h:i a') }}</p>
                    <button class="btn btn-light">Contact Seller</button>
                    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-{{ $order->id }}">View Details</button>

                    <!-- Multiple Indicator -->
                    @if ($order->total_items > 1)
                        <p class="multiple-indicator">Multiple items available. Click 'View Details' to see more</p>
                    @endif
                </div>
            </td>
        </tr>

        <!-- Modal -->
        <div class="modal fade" id="orderDetailsModal-{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsLabel-{{ $order->id }}" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content">
                    <!-- Modal Header -->
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    <div class="modal-header">
                        <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 25px; height: 25px;">
                        <h5 class="modal-title" id="orderDetailsLabel">Order Details</h5>
                        <div class="p-10 mb-2 bg-light text-dark" id="modalStatus" style="padding-top:18px;"></div>
                        <hr/>
                    </div>
                    
                    <!-- Modal Body -->
                    <div class="modal-body">
                        <div>
                        <div class="transact-col1">
                            <ul>
                                <li><strong>Order ID:</strong> {{ $order->id }}</li>
                                <li><strong>Total Amount:</strong> P{{ number_format($order->total_amount, 2) }}</li>
                                <li><strong>Payment Method:</strong> {{ $order->payment_method ?? 'N/A' }}</li>
                                <li><strong>Proof of Payment:</strong> {{ $order->proof_of_payment ?? 'N/A' }}</li>
                                <li><strong>Reference No.:</strong> {{ $order->reference_number }}</li>
                            </ul>
                        </div>

                        <hr />
                        <div class="transact-col2">
                            <p><strong>Date:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('m-d-Y') }}</p>
                            <p><strong>Time:</strong> {{ \Carbon\Carbon::parse($order->order_date)->format('h:i a') }}</p>
                            <p><strong>Item(s):</strong> {{ $order->total_items }}</p>
                        </div>
                        </div>
                    </div>
                    <!-- Modal Footer -->
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Contact Seller</button>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
</table>



    <div class="modal fade" id="rateModal" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <div class="modal-header">   
                    <h3>Rate Order</h3>
                </div>
                <div class="modal-body">
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
                        <textarea name="comment" rows="4" cols="50"></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary" id="submit-ratings" data-bs-dismiss="modal">Submit</button>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="msg-modal" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-body">
                <img src="{{ asset('images/check.svg') }}" class="logo-img">
                    <h3>Thanks for your review.</h3>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Proceed</button>
                </div>
            </div>
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
</script>