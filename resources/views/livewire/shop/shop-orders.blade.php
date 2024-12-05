<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Shop Orders</title>

</head>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
@extends('layouts.shop')

@section('content')

<div class="w-100">
    @include('components.profilenav')
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{ asset('images/' . $shop->shop_logo) }}" alt="" height="40px" width="40px">
        </div>
       <h2 class="fw-bold m-0 text-primary" id="shopName">{{$shop->shop_name}}</h2>
       
     </div>
    
    <div class="scrollable-content container-fluid">
        <div class="identifiers">
            <div class="d-flex gap-5 align-items-center">
                <div class="btn-group">
                <select class="dropdown" id="entriesPerPage">
                        <option value="10">10</option>
                        <option value="20">20</option>
                        <option value="30">30</option>
                    </select>
                    <span class="align-middle" style="margin-left: 5px;">entries per page</span>
                </div>
    
                <div id="search" >
                    <input type="text" id="search-box" class="search-box" placeholder="Search">
                </div>
    
                <div class="btn-group">
                    <span class="d-flex align-items-center" style="margin-right: 10px;">Status</span>
                    <select class="filter-dropdown" id="status-filter">
                        <option value="all">All</option>
                        <option value="pending">Pending</option>
                        <option value="received-payment">Payment Received</option>
                        <option value="denied-payment">Denied Payment</option>
                        <option value="for-pickup">For Pickup</option>
                        <option value="completed-order">Completed Order</option>
                    </select>
                </div>
            </div>

            <div class="icon">
                <button type="button" data-bs-toggle="modal" data-bs-target="#PrintConfirmModal">
                    <img  style="height: 23px; width:23px;" src="{{ asset('images/print.svg') }}" alt="">
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ExportConfirmModal">
                    <img  style="height: 23px; width:23px" src="{{ asset('images/export.svg') }}" alt="">
                </button>
            </div>
        </div>

<!-- TABLE START -->
<div class="order_table">
    <table class="table table-hover table-borderless" id="order-table">
        <thead>
            <tr>
                <th scope="col">Order ID</th>
                <th scope="col">Customer Name</th>
                <th scope="col">Total Items</th>
                <th scope="col">Total Cost</th>
                <th scope="col">Reference Number</th>
                <th scope="col">Status</th>
                <th scope="col">Date</th>
            </tr>
        </thead>
        <tbody>
            @php
                $statusLabels = [
                    6 => 'Denied',
                    7 => 'Pending',
                    10 => 'Payment Received',
                    11 => 'Ready for Pickup',
                    12 => 'Completed',
                ];
                
                function getStatusClass($statusId) {
                    switch ($statusId) {
                        case 6:
                            return 'denied-payment';
                        case 7:
                            return 'pending';
                        case 10:
                            return 'received-payment';
                        case 11:
                            return 'for-pickup';
                        case 12:
                            return 'completed-order';
                        default:
                            return 'unknown-status';
                    }
                }
            @endphp
            
            @foreach ($orders as $order)
                @php
                    $currentCustomer = $customer->firstWhere('id', $order->user_id);
                @endphp
                <tr class="status-label {{ getStatusClass($order->order_status_id) }}" onclick="openOrderModal({{ $order }})">
                    <td class="id">{{ $order->id }}</td>
                    <td>{{ $currentCustomer->first_name }} {{ $currentCustomer->last_name }}</td>
                    <td >{{ $order->total_items }}</td>
                    <td>₱ {{ number_format($order->total_amount, 2) }}</td>
                    <td class="reference-number">{{ $order->reference_number }}</td>
                    <td class="status-label {{ getStatusClass($order->order_status_id) }}">
                        {{ $statusLabels[$order->order_status_id] ?? 'Unknown Status' }}
                    </td>
                    <td>{{ $order->order_date }}</td>
                </tr>
            @endforeach
            <div id="no-results" style="display: none; position: absolute; left: 55%; transform: translateX(-50%); text-align: center; margin-top: 48px;">
                No matching results found.
            </div>
        </tbody>
    </table>
</div>

<!-- TABLE END -->

<div class="footer-btn">
    <p>Showing 1 to 10 of 100 entries</p>
    <div class="d-flex" >
        <a class="page-link rounded-start border border-start border-primary" href="#" aria-label="Previous" style="margin-left: 530px;">
            <span aria-hidden="true">&laquo;</span></a>
        <a class="page-link" href="#" aria-label="Previous">
        <span aria-hidden="true">&lsaquo;</span></a>
        <a  class="page-link" href="#">1</a>
        <a  class="page-link" href="#">2</a>
        <a  class="page-link" href="#">3</a>
        <a  class="page-link" href="#">4</a>
        <a  class="page-link" href="#">5</a>
        <a class="page-link" href="#" aria-label="Next">
            <span aria-hidden="true">&raquo;</span></a>
        <a class="page-link rounded-end" href="#" aria-label="Next">
                    <span aria-hidden="true">&rsaquo;</span></a>
    </div>
</div>

</div>
 <!-- TABLE END -->
    <!-- MODAL START DITESS -->

    <div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 25px; height: 25px;">
                <h5 class="modal-title" id="orderDetailsLabel">Order Details</h5>
                <div class="p-10 mb-2 bg-light text-dark" id="modalStatus"></div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body"> 
                <!-- Product Info -->
                <div class="modal-items">
                    <table class="modal-item-table" id="modalItemsTable">
                        
                    </table>
                </div>
                <hr/>
                <div class="transact-col1">
                    <p>Order ID:</p>
                    <p>Total Amount:</p>
                    <p>Payment Method:</p>
                    <p>Reference No.:</p>
                    <p>Proof of Payment: </p>
                </div>
                <div class="transact-col2">
                    <p id="modalOrderId"></p>
                    <p id="modalTotalAmount"></p>
                    <p id="modalPaymentMethod"></p>
                    <p id="modalReferenceNumber"></p>
                    <p id="modalProof" data-bs-toggle="modal" data-bs-target="#viewProof" style="cursor: pointer;"
                    onmouseover="this.style.color='darkblue';" 
                    onmouseout="this.style.color='black';"
                    onclick="viewProof(document.getElementById('modalOrderId').innerText)"><u>Click to View</u></p>
                </div>
                <div class="transact-col3">
                    <p>Customer: </p>
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                </div>
                <div class="transact-col4">
                    <p id="customerName"></p>
                    <p id="modalDate"></p>
                    <p id="modalTime"></p>
                    <p id="modalItemCount"></p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="closeModal">Cancel</button>
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="confirmStatus('Denied', document.getElementById('modalOrderId').innerText)" id="denyButton">Deny Payment</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="confirmStatus(document.getElementById('modalStatus').innerText, document.getElementById('modalOrderId').innerText)" style="width: 150px !important;" id="updateButton">Update Status</button>
            </div>
        </div>
    </div>
</div>
        <!-- Confirmation Modal -->
        <div class="modal fade" id="approveConfirmModal" tabindex="-1" aria-labelledby="approveConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to approve this payment?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateStatus(10)">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="msgModal" tabindex="-1" aria-labelledby="msgModal" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <img src="{{ asset('images/check.svg') }}">
                        <h3>Status has been updated!</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="denial-options" tabindex="-1" aria-labelledby="approveConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Deny Options</h3>
                        <div class="btn-group">
                            <button type="button" class="btn btn-light dropdown-toggle" id="denyChoiceButton" data-bs-toggle="dropdown" aria-expanded="false" style="border: 1px solid #092C4C important;">
                                <span>Select Reason</span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a class="dropdown-item" onclick="setDenyStatus('Invalid Image')">Invalid Image</a></li>
                                <li><a class="dropdown-item" onclick="setDenyStatus('Blurred Image')">Blurred Image</a></li>
                                <li><a class="dropdown-item" onclick="setDenyStatus('Insufficient Payment')">Insufficient Payment</a></li>
                                <li><a class="dropdown-item" onclick="setDenyStatus('Others')">Other Reason</a></li>
                            </ul>
                        </div>
                        <h5 id="denyComment">Comment</h5>
                        <textarea name="comment" rows="4" cols="50" id="revMsg"></textarea>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="closeDenial()">Cancel</button>
                        <button type="button" class="btn btn-primary" id="gotoDen"data-bs-dismiss="modal" onclick="denyConfirm(document.getElementById('revMsg').value.toString())" disabled>Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!--modal to view proof-->
        <div class="modal fade" id="viewProof" tabindex="-1" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3 style="margin-left: 110px !important; font-weight: 600;">Proof Image</h3>
                        <img id="proofImg" src="" style="height: 400px; width: auto; margin-left: 30px; border-radius: 10px;">
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-target="orderDetailsModal" style="margin-right: 100px !important; margin-bottom: 20px !important;" onclick="closeDenial()">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Deny Modal -->
        <div class="modal fade" id="denyConfirmModal" tabindex="-1" aria-labelledby="denyConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to deny this payment?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal" onclick="closeDenial()">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateStatus(6)">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Received - Pickup Modal -->
        <div class="modal fade" id="PickUpConfirmModal" tabindex="-1" aria-labelledby="PickUpConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to change "Received Payment" to "Ready for Pick-up" status?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateStatus(11)">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="loadingModal" tabindex="-1" aria-labelledby="loadingModal" aria-hidden="true" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body" style="height: 150px !important;">
                        <h3 style="position: absolute; left: 80px !important; top: 30px !important;">Updating Status...</h3>
                    </div>
                    <div class="modal-footer border-0">
                    </div>
                </div>
            </div>
        </div>
        <!-- Denied - Received Modal -->
        <div class="modal fade" id="ReceivedConfirmModal" tabindex="-1" aria-labelledby="denyConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to change "Denied Payment" to "Received Payment" status?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateStatus(10)">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- Pickup  - Completed Modal -->
        <div class="modal fade" id="CompletedConfirmModal" tabindex="-1" aria-labelledby="CompletedConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to change "For Pick-up" to "Completed" status?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="updateStatus(12)">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
    
        <!-- Export Modal -->
        <div class="modal fade" id="ExportConfirmModal" tabindex="-1" aria-labelledby="ExportConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h4 style="color:#092C4C; font-weight:800;">Select Date Range</h4>
                    </div>
                        <div class="modal-body">
                            <div id="from">
                                <p>From</p>
                                <input type="date" id="export-from" class="form-control" placeholder="Select a date">
                            </div>
                            <br>
                            <div id="to">
                                <p>To</p>
                                <input type="date" id="export-to" class="form-control" placeholder="Select a date">
                            </div>
                        </div>
                        <div class="modal-footer d-flex justify-content-center">
                            <button type="button" class="export-btn" data-bs-dismiss="modal" onclick="downloadCSV()" style="width: 76px; height: 28px;">CSV</button>
                            <button type="button" class="export-btn" data-bs-dismiss="modal" onclick="downloadXLSX()" style="width: 76px; height: 28px;">XLSX</button>
                            <button type="button" class="export-btn" data-bs-dismiss="modal" onclick="downloadPDF(1)" style="width: 76px; height: 28px;">PDF</button>
                        </div>

                </div>
            </div>
        </div>

         <!-- Print Modal -->
         <div class="modal fade" id="PrintConfirmModal" tabindex="-1" aria-labelledby="PrintConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-header border-0">
                        <h4 id="modalgear"style="color:#092C4C; font-weight:800;">Select Date Range</h4>
                    </div>
                    <div class="modal-body">
                        <div id="from">
                            <p>From</p>
                            <input type="date" id="print-from" class="form-control" placeholder="Select a date">
                        </div>
                        <br>
                        <div id="to">
                            <p>To</p>
                            <input type="date" id="print-to" class="form-control" placeholder="Select a date">
                        </div>
                    </div>
                    <div class="modal-footer d-flex justify-content-center">
                        <button type="button" class="export-btn" data-bs-dismiss="modal" onclick="downloadPDF(2)" style="width: 76px; height: 28px;">Print</button>
                    </div>
                </div>
            </div>
    </div>
</div>


<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.5.1/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.20/jspdf.plugin.autotable.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/xlsx/0.18.5/xlsx.full.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf-autotable/3.5.23/jspdf.plugin.autotable.min.js"></script>

<script>
    
    var denial_reason;
    var denial_comment;
    let currentPage = 1;
    let entriesPerPage = 10; // Default entries per page

    // Handle dropdown for entries per page
    document.querySelector('#entriesPerPage').addEventListener('change', function () {
        entriesPerPage = parseInt(this.value, 10); // Get the selected value
        currentPage = 1; // Reset to first page
        updateTable(); // Refresh table
    });

    // Update the table to show entries based on pagination
    function updateTable() {
        const rows = document.querySelectorAll('#order-table tbody tr'); // Select rows
        const totalRows = rows.length;

        // If entriesPerPage is undefined, show all rows
        if (!entriesPerPage) {
            rows.forEach(row => (row.style.display = ''));
            updateFooter(totalRows);
            updatePagination(totalRows);
            return;
        }

        // Hide all rows initially
        rows.forEach(row => (row.style.display = 'none'));

        // Calculate start and end indices for the current page
        const start = (currentPage - 1) * entriesPerPage;
        const end = Math.min(start + entriesPerPage, totalRows);

        // Display rows for the current page
        for (let i = start; i < end; i++) {
            rows[i].style.display = '';
        }

        // Update footer and pagination
        updateFooter(totalRows);
        updatePagination(totalRows);
    }

    // Update footer
    function updateFooter(totalRows) {
        const footerText = document.querySelector('.footer-btn p');
        const startEntry = totalRows === 0 ? 0 : (currentPage - 1) * entriesPerPage + 1;
        const endEntry = Math.min(currentPage * entriesPerPage, totalRows);

        footerText.textContent = `Showing ${startEntry} to ${endEntry} of ${totalRows} entries`;
    }

    // Update pagination
    function updatePagination(totalRows) {
        const pagination = document.querySelector('.footer-btn .d-flex');
        pagination.innerHTML = ''; // Clear existing pagination

        const totalPages = Math.ceil(totalRows / entriesPerPage);

        // Add "Previous" button
        if (currentPage > 1) {
            const prev = document.createElement('a');
            prev.textContent = '«';
            prev.classList.add('page-link');
            prev.addEventListener('click', () => {
                currentPage--;
                updateTable();
            });
            pagination.appendChild(prev);
        }

        // Add page number buttons
        for (let i = 1; i <= totalPages; i++) {
            const pageLink = document.createElement('a');
            pageLink.textContent = i;
            pageLink.classList.add('page-link');
            if (i === currentPage) {
                pageLink.classList.add('active');
            }
            pageLink.addEventListener('click', () => {
                currentPage = i;
                updateTable();
            });
            pagination.appendChild(pageLink);
        }

        // Add "Next" button
        if (currentPage < totalPages) {
            const next = document.createElement('a');
            next.textContent = '»';
            next.classList.add('page-link');
            next.addEventListener('click', () => {
                currentPage++;
                updateTable();
            });
            pagination.appendChild(next);
        }
    }
// STATUS
    function setStatus(status) {
    var modalStatus = document.getElementById("modalStatus");

    // Remove all existing status classes
    modalStatus.classList.remove("denied-payment", "completed-order", "pending", "received-payment", "for-pickup");

    // Add the corresponding class based on the status
    switch (status) {
        case 'denied-payment':
            modalStatus.classList.add("denied-payment");
            modalStatus.textContent = "Payment Denied";
            modalStatus.style.color = "#eb5757"; 
            break;
        case 'completed-order':
            modalStatus.classList.add("completed-order");
            modalStatus.textContent = "Order Completed";
            break;
        case 'pending':
            modalStatus.classList.add("pending");
            modalStatus.textContent = "Pending";
            break;
        case 'received-payment':
            modalStatus.classList.add("received-payment");
            modalStatus.textContent = "Payment Received";
            break;
        case 'for-pickup':
            modalStatus.classList.add("for-pickup");
            modalStatus.textContent = "Ready for Pickup";
            modalStatus.style.color = "#17a2b8";
            break;
        default:
            modalStatus.classList.add("bg-light");
            modalStatus.textContent = "Unknown Status";
    }
}
// MODAL
function openOrderModal(order) {
    const orderItem = @json($orderItems);
    const category = @json($categories);
    const currentItems = orderItem.filter(item => item.order_id === order.id);
    const customer = @json($customer).find(cus => cus.id === order.user_id);

    createModalTable(currentItems, category);
    document.getElementById("modalOrderId").textContent = order.id;
    document.getElementById("modalTotalAmount").textContent = `₱ ${order.total_amount}`;
    document.getElementById("modalPaymentMethod").textContent = order.payment_method ?? 'N/A';
    document.getElementById("modalReferenceNumber").textContent = order.reference_number;
    document.getElementById('customerName').textContent = customer.first_name +" "+ customer.last_name;
    document.getElementById('customerName').style.fontWeight = '600';
    const orderDate = new Date(order.order_date);

    // Format the date as MM-DD-YYYY
    const formattedDate = `${String(orderDate.getMonth() + 1).padStart(2, '0')}-${String(orderDate.getDate()).padStart(2, '0')}-${orderDate.getFullYear()}`;

    // Format the time as HH:MM AM/PM
    const formattedTime = orderDate.toLocaleTimeString('en-US', { hour: '2-digit', minute: '2-digit', hour12: true }).toLowerCase();

    // Update the modal content
    document.getElementById("modalDate").textContent = formattedDate;
    document.getElementById("modalTime").textContent = formattedTime || 'N/A'; // Assuming order_time is available
    document.getElementById('modalItemCount').textContent = order.total_items;

    // Set the order items (if available)

    // Update the modal status based on the order status
    const modalStatusElement = document.getElementById("modalStatus");
    const statusLabels = {
        6: 'Payment Denied',
        7: 'Pending',
        10: 'Payment Received',
        11: 'Ready for Pickup',
        12: 'Order Complete',
    };
    const statusClasses = {
        6: 'denied-payment',
        7: 'pending',
        10: 'received-payment',
        11: 'for-pickup',
        12: 'completed-order',
    };

   

    const statusLabel = statusLabels[order.order_status_id] ?? 'Unknown Status';
    const statusClass = statusClasses[order.order_status_id] ?? 'unknown-status';

    modalStatusElement.textContent = statusLabel;
    modalStatusElement.className = `p-3 mb-2 ${statusClass} text-dark`; // Add the correct class to style the status
    
    if (order.order_status_id === 6) {
    modalStatusElement.setAttribute('style', 'color: #eb5757 !important; border-color:  #eb5757 !important');
    } else if (order.order_status_id === 12) {
        modalStatusElement.setAttribute('style', 'color: green !important;  border-color:  #green !important');
    } else {
        modalStatusElement.setAttribute('style', 'color: #ffc107 !important;  border-color:  #ffc107 !important');
    }

     //Deny Button For Pending Only
     if(order.order_status_id === 7){
        document.getElementById('denyButton').style.display = 'block';
        document.getElementById('updateButton').style.display = 'block';
        document.getElementById('closeModal').textContent = 'Cancel';
        
    }else if(order.order_status_id === 12){
        document.getElementById('denyButton').style.display = 'none';
        document.getElementById('updateButton').style.display = 'none';
        document.getElementById('closeModal').textContent = 'Close';
    }else{
        document.getElementById('denyButton').style.display = 'none';
        document.getElementById('updateButton').style.display = 'block';
        document.getElementById('closeModal').textContent = 'Cancel';
    }
    // Show the modal
    const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
    modal.show();
}


document.getElementById('status-filter').addEventListener('change', function() {
    let selectedStatus = this.value;
    let rows = document.querySelectorAll('.order_table tbody tr');
    
    rows.forEach(row => {
        // Show all rows if "all" is selected
        if (selectedStatus === 'all') {
            row.style.display = '';
        } else {
            // Show only rows with the matching status class
            row.style.display = row.classList.contains(selectedStatus) ? '' : 'none';
        }
    });
});
function validateDate(validateKey) {
    var startDate;
    var endDate;

    if(validateKey === 1){
        startDate = document.getElementById('export-from').value;
        endDate = document.getElementById('export-to').value;
    }else{
        startDate = document.getElementById('print-from').value;
        endDate = document.getElementById('print-to').value;
    }
    console.log("Starts with: "+ startDate +"Vakla"+endDate);
    // Check if either startDate or endDate is null or empty
    if (!startDate || !endDate) {
        return false; // Return false if either date is missing
    }

    return true; // Return true if both dates are provided
}

function extractDataTable(printKey) {
    const table = document.getElementById("order-table");
    const selectedStatus = document.getElementById('status-filter').value;
    let status;

    // Map filter value to status description
    switch (selectedStatus) {
        case 'pending-payment':
            status = "Pending Orders";
            break;
        case 'received-payment':
            status = "Received Payments - Approved Orders";
            break;
        case 'denied-payment':
            status = "Denied Orders";
            break;
        case 'for-pickup':
            status = "Orders Ready for Pickup";
            break;
        case 'completed-order':
            status = "Completed Orders";
            break;
        case 'all':
            status = "All Orders";
            break;
        default:
            status = "Unknown Status";
            break;
    }

    console.log("Selected Status:", status);

    
    const shopName = document.getElementById('shopName')?.innerText || "Shop Name";
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    if(printKey === 1){
        startDate = document.getElementById('export-from').value;
        endDate = document.getElementById('export-to').value;
    }else{
        startDate = document.getElementById('print-from').value;
        endDate = document.getElementById('print-to').value;
    }

    // Extract headers from the first row
    const headers = [...table.rows[0].cells].map(cell => cell.innerText);

    const rows = [];
    let totalSales = 0;

    for (let i = 1; i < table.rows.length; i++) {
        const row = table.rows[i];

        // Check if the row matches the selected status or "all"
        if (selectedStatus === 'all' || row.querySelector(`.status-label.${selectedStatus}`)) {
            const rowData = {};
            headers.forEach((header, index) => {
                var cellValue = row.cells[index]?.innerText || "";

                // Extract the date part if the header contains "date"
                if (header.toLowerCase().includes("date")) {
                    cellValue = cellValue.split(' ')[0]; // Keep only the date part
                }

                rowData[header] = cellValue;

                // Add to total sales if the header includes "amount" or "price"
                if (header.toLowerCase().includes("amount") || header.toLowerCase().includes("price")) {
                    const amount = parseFloat(cellValue.replace(/[^0-9.-]+/g, '')) || 0;
                    totalSales += amount;
                }
            });

            // Convert date strings to Date objects for comparison
            const rowDate = new Date(rowData['Date']);
            const start = new Date(startDate);
            const end = new Date(endDate);

            // Push rowData if the date is within the range
            if (rowDate >= start && rowDate <= end) {
                rows.push(rowData);
            }
        }
    }
    const reportData = {
        shopName,
        startDate,
        endDate,
        status,
        headers,
        rows
    };

    return reportData;
    
}

function downloadCSV() {
    if(validateDate(1)){
        var shopName = document.getElementById('shopName')?.innerText || 'Shop Name'; // Default if shop name is not found

        // Use the getDataTable() function to fetch the table data
        const dataTable = extractDataTable(1); // Assuming getDataTable() is a predefined function that returns the necessary table data
        const status = dataTable['status'];
        const startDate = dataTable['startDate'];
        const endDate = dataTable['endDate'];
        console.log("Fetched Data Table:", dataTable);

        // Check if the rows are available in the dataTable
        if (dataTable && dataTable.rows && dataTable.rows.length > 0) {
            var csv = [];
            var totalSales = 0; // Variable to calculate total sales

            // Add the main header with shop name
            csv.push(['Shop Name', shopName]);
            csv.push(['Status', status]);
            csv.push(['From', startDate]);
            csv.push(['To', endDate]); // Shop name
            csv.push([]); // Empty line for spacing

            // Add column headers (from the dataTable headers)
            csv.push(dataTable.headers.join(',')); // Using dynamic headers from dataTable

            // Loop through the rows in the dataTable
            dataTable.rows.forEach(row => {
                var rowData = [];

                // Loop through the row data to extract the values corresponding to the headers
                dataTable.headers.forEach(header => {
                    // Access the row data for each header and push to rowData
                    rowData.push(row[header] || ''); // Use empty string if data is missing
                });

                // Add the row to the CSV array if it has valid data
                if (rowData.some(cell => cell !== '')) {
                    // Calculate total sales from the 4th column (Amount)
                    var amount = parseFloat(rowData[3]?.replace(/[^0-9.-]+/g, '')) || 0; // Parse amount

                    csv.push(rowData.join(',')); // Add the row to CSV
                }
            });

            // Update the total sales value in the CSV
            csv.push([]); // Empty line for spacing

            // Check if there is any valid data to export (after cleansing)
            if (csv.length > 5) { // At least the headers + one data row
                // Create and download the CSV file
                var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
                var link = document.createElement('a');
                link.href = URL.createObjectURL(csvFile);
                link.download = `completed_orders_${shopName.replace(/\s+/g, '_')}.csv`;
                link.click();
            } else {
                alert("No valid data to export after cleansing.");
            }
        } else {
            alert("No completed orders to export.");
        }
    }else{
        alert("Please fill in the dates.")
    }
}


function downloadXLSX() {
    if(validateDate(1)){
        var shopName = document.getElementById('shopName')?.innerText || 'Shop Name'; // Default if shop name is not found

        // Use the extractDataTable() function to fetch the table data
        const dataTable = extractDataTable(1); // Assuming extractDataTable() is a predefined function that returns the necessary table data
        const status = dataTable['status'];
        const startDate = dataTable['startDate'];
        const endDate = dataTable['endDate'];
        console.log("Fetched Data Table:", dataTable);

        // Check if the rows are available in the dataTable
        if (dataTable && dataTable.rows && dataTable.rows.length > 0) {
            var excelData = [];

            // Add the main header with shop name
            excelData.push(['Shop Name', shopName]);
            excelData.push(['Status', status]);
            excelData.push(['From', startDate]);
            excelData.push(['To', endDate]);
            excelData.push([]); // Empty line for spacing

            // Add column headers (from the dataTable headers)
            excelData.push(dataTable.headers);

            // Loop through the rows in the dataTable
            dataTable.rows.forEach(row => {
                var rowData = [];

                // Loop through the row data to extract the values corresponding to the headers
                dataTable.headers.forEach(header => {
                    // Access the row data for each header and push to rowData
                    rowData.push(row[header] || ''); // Use empty string if data is missing
                });

                // Add the row to the Excel data array if it has valid data
                if (rowData.some(cell => cell !== '')) {
                    excelData.push(rowData);
                }
            });

            // Create a worksheet from the data
            var ws = XLSX.utils.aoa_to_sheet(excelData);

            // Create a new workbook
            var wb = XLSX.utils.book_new();

            // Append the worksheet to the workbook
            XLSX.utils.book_append_sheet(wb, ws, 'Completed Orders');

            // Generate and download the Excel file
            XLSX.writeFile(wb, `completed_orders_${shopName.replace(/\s+/g, '_')}.xlsx`);
        } else {
            alert("No completed orders to export.");
        }
    }else{
        alert("Please fill in the Dates.")
    }
}
function downloadPDF(printKey) {
    if(validateDate(printKey)){
        const dataTable = extractDataTable(printKey); // Assuming this function extracts and formats your table data
        console.log(dataTable);

        // Pass to the OrderController using an AJAX request
        fetch('/orders-pdf-print', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'), // Laravel CSRF Token
            },
            body: JSON.stringify(dataTable),
        })
        .then(response => response.json())
        .then(data => {
                const printWindow = window.open('', '_blank');
                printWindow.document.write(data.htmlContent);
                printWindow.document.close();
                printWindow.onload = function() {
                    if(printKey === 1){
                        printWindow.print();
                    }else{
                        printWindow.focus();
                        printWindow.print();
                    }
                };
        })
        .catch(error => {
            console.error('Error passing data to OrderController:', error);
        });
    }else{
        alert("Please fill in the Dates.")
    }
}

//SORTING 
document.getElementById('search-box').addEventListener('input', function () {
    let searchTerm = this.value.toLowerCase();
    let rows = document.querySelectorAll('.order_table tbody tr');
    let hasVisibleRows = false;

    rows.forEach(row => {
        let productName = row.querySelector('.id').textContent.toLowerCase();
        let referenceNumber = row.querySelector('.reference-number').textContent.toLowerCase();

        // Show rows that match the search term in product name or reference number
        if (productName.includes(searchTerm) || referenceNumber.includes(searchTerm)) {
            row.style.display = '';
            hasVisibleRows = true;
        } else {
            row.style.display = 'none';
        }
    });

    // Show "No matching results" message if no rows are visible
    document.getElementById('no-results').style.display = hasVisibleRows ? 'none' : 'block';

    // Hide pagination if no rows are visible
    const pagination = document.querySelector('.footer-btn');
    if (pagination) {
        pagination.style.display = hasVisibleRows ? 'flex' : 'none';
    }
});

document.getElementById('status-filter').addEventListener('change', function() {
    let selectedStatus = this.value;
    let rows = document.querySelectorAll('.order_table tbody tr');
    const iconDiv = document.querySelector('.icon');
    const buttons = iconDiv.querySelectorAll('button');  // Select the buttons in the .icon div
    console.log(selectedStatus);
    rows.forEach(row => {
        // Show all rows if "all" is selected
        if (selectedStatus === 'all') {
            row.style.display = '';
            // Disable buttons if "all" is selected
        } else {
            // Show only rows with the matching status class
            if (row.classList.contains(selectedStatus)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });
});

// Handle dropdown for entries per page
document.querySelector('.dropdown').addEventListener('change', function () {
    entriesPerPage = parseInt(this.value, 10); // Get the selected value
    currentPage = 1; // Reset to first page
    updateTable(); // Refresh table
});

// Update the table to show entries based on pagination
function updateTable() {
    const rows = document.querySelectorAll('#order-table tbody tr'); // Select rows
    const totalRows = rows.length;

    // If entriesPerPage is undefined, show all rows
    if (!entriesPerPage) {
        rows.forEach(row => (row.style.display = ''));
        updateFooter(totalRows);
        updatePagination(totalRows);
        return;
    }

    // Hide all rows initially
    rows.forEach(row => (row.style.display = 'none'));

    // Calculate start and end indices for the current page
    const start = (currentPage - 1) * entriesPerPage;
    const end = Math.min(start + entriesPerPage, totalRows);

    // Display rows for the current page
    for (let i = start; i < end; i++) {
        rows[i].style.display = '';
    }

    // Update footer and pagination
    updateFooter(totalRows);
    updatePagination(totalRows);
}

document.addEventListener("DOMContentLoaded", function() {
    const order = @json($orders);
    const orderItemsLength = Object.keys(order).length;
    console.log(orderItemsLength);
    updatePagination(orderItemsLength);
    updateFooter(orderItemsLength);
});

function updateFooter(totalRows) {
    const footerText = document.querySelector('.footer-btn p');
    const startEntry = totalRows === 0 ? 0 : (currentPage - 1) * entriesPerPage + 1;
    const endEntry = Math.min(currentPage * entriesPerPage, totalRows);

    footerText.textContent = `Showing ${startEntry} to ${endEntry} of ${totalRows} entries`;
}

// Update pagination
function updatePagination(totalRows) {
    const pagination = document.querySelector('.footer-btn .d-flex');
    pagination.innerHTML = ''; // Clear existing pagination

    const totalPages = Math.ceil(totalRows / entriesPerPage);

    // Add "Previous" button
    if (currentPage > 1) {
        const prev = document.createElement('a');
        prev.textContent = '«';
        prev.classList.add('page-link');
        prev.addEventListener('click', () => {
            currentPage--;
            updateTable();
        });
        pagination.appendChild(prev);
    }

    // Add page number buttons
    for (let i = 1; i <= totalPages; i++) {
        const pageLink = document.createElement('a');
        pageLink.textContent = i;
        pageLink.classList.add('page-link');
        if (i === currentPage) {
            pageLink.classList.add('active');
        }
        pageLink.addEventListener('click', () => {
            currentPage = i;
            updateTable();
        });
        pagination.appendChild(pageLink);
    }

    // Add "Next" button
    if (currentPage < totalPages) {
        const next = document.createElement('a');
        next.textContent = '»';
        next.classList.add('page-link');
        next.addEventListener('click', () => {
            currentPage++;
            updateTable();
        });
        pagination.appendChild(next);
    }
}

    //Update Status
    var currentStat, currentId;
    // Function to fetch data and refresh the table
    function fetchAndUpdateTable() {
        fetch('shop/orders/take') // URL to your Laravel route
            .then(response => response.json())
            .then(orders => {
                refreshTable(orders); // Call function to update the table with new data
            })
            .catch(error => {
                console.error('Error fetching data:', error);
            });
    }

// Function to update the table with new data
function refreshTable(orders) {
    const tableBody = document.querySelector('#order-table tbody');
    tableBody.innerHTML = ''; // Clear the current table data
    
    console.log(orders);
    orders.forEach(order => {
            const currentCustomer = @json($customer).find(cus => cus.id === order.user_id);

            const row = document.createElement('tr');
            row.classList.add('status-label', getStatusClass(order.order_status_id));
            row.innerHTML = `
                <td>${order.id}</td>
                <td>${currentCustomer.first_name} ${currentCustomer.last_name}</td>
                <td>${order.total_items}</td>
                <td>${order.total_amount.toFixed(1)}</td>
                <td class="reference-number">${order.reference_number}</td>
                <td class="status-label ${getStatusClass(order.order_status_id)}">
                    ${getStatusLabel(order.order_status_id)}
                </td>
                <td>${order.order_date}</td>
            `;
            
            row.setAttribute('onclick', `openOrderModal(${JSON.stringify(order)})`);
            tableBody.appendChild(row);
        });

        // Optionally, update footer and pagination
        updateFooter(orders.length); // Update footer with the number of entries
        updatePagination(orders.length); // Update pagination if needed
    }

    // Function to get the status label
    function getStatusLabel(statusId) {
        const statusLabels = {
            6: 'Denied',
            7: 'Pending',
            10: 'Payment Received',
            11: 'Ready for Pickup',
            12: 'Completed',
        };
        return statusLabels[statusId] ?? 'Unknown Status';
    }

    // Function to get status CSS class
    function getStatusClass(statusId) {
        switch (statusId) {
            case 6:
                return 'denied-payment';
            case 7:
                return 'pending';
            case 10:
                return 'received-payment';
            case 11:
                return 'for-pickup';
            case 12:
                return 'completed-order';
            default:
                return 'unknown-status';
        }
    }
    function confirmStatus(status, orderId){
        console.log(status);
        var myModal;
        switch(status){
            case 'Pending':
                modal = new bootstrap.Modal(document.getElementById('approveConfirmModal'));
                console.log(status);
                console.log(orderId);
                currentStat = status;
                currentId = orderId;
                break;
            case 'Payment Received':
                modal = new bootstrap.Modal(document.getElementById('PickUpConfirmModal'));
                console.log(status);
                console.log(orderId);
                currentStat = status;
                currentId = orderId;
                break;
            case 'Payment Denied':
                modal = new bootstrap.Modal(document.getElementById('approveConfirmModal'));
                console.log(status);
                console.log(orderId);
                currentStat = status;
                currentId = orderId;
                break;
            case 'Denied':
                modal = new bootstrap.Modal(document.getElementById('denial-options'));
                console.log(status);
                console.log(orderId);
                currentStat = status;
                currentId = orderId;
                break;
            case 'Ready for Pickup':
                modal = new bootstrap.Modal(document.getElementById('CompletedConfirmModal'));
                console.log(status);
                console.log(orderId);
                currentStat = status;
                currentId = orderId;
                break;
        }
        modal.show();
    }

    function updateStatus(newStatus) {
        const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');
        const targetId = parseInt(currentId);
        const currentOrder = @json($orders).find(order => order.id === targetId);
        const currentCustomer = currentOrder.user_id;
        var upModal = new bootstrap.Modal(document.getElementById('loadingModal'));
        console.log(currentCustomer);
        upModal.show();
       if(newStatus != 6){
            denial_reason = "N/A";
            denial_comment = "N/A";
       }
        const data = {
            currentCustomer,
            order_id: targetId,
            status_id: newStatus,
            denial_reason,
            denial_comment
        };
        fetch('/shop/orders/update-status', {
            method: 'POST', 
            headers: {
                'Content-Type': 'application/json',  
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: JSON.stringify(data)  
        })
        .then(response => response.json())  
        .then(data => {
            console.log('Success:', data);
            upModal.hide();
            var myModal = new bootstrap.Modal(document.getElementById('msgModal'));
            myModal.show();
            fetchAndUpdateTable()
        })
        .catch((error) => {
            console.error('Error:', error);
        });

    }
    function viewProof(itemId){
        const orderYes = @json($orders);
        let targetId = parseInt(itemId);
        let matchedOrder = orderYes.find(order => order.id === targetId);

        console.log(matchedOrder.proof_of_payment);

        document.getElementById('proofImg').src = "/images/"+matchedOrder.proof_of_payment;
    }

    function createModalTable(orderItems, category) {
    // Get the modal table container
    const modalTable = document.getElementById('modalItemsTable');
    console.log('putanginamo');
    // Clear any existing content
    modalTable.innerHTML = '';

    // Loop through the order items
    orderItems.forEach(item => {
        // Create a wrapper row for the image holder and table
        console.log(item);
        const modalRow = document.createElement('tr');
        modalRow.classList.add('modal-rows');

        // Create the image holder
        const imgHolder = document.createElement('div');
        imgHolder.classList.add('img-holder');

        // Add the product image to the image holder
        const img = document.createElement('img');
        
        img.src = "/images/"+item.product.product_image;
        imgHolder.appendChild(img);

        // Create the product details table
        const itemDetailsTable = document.createElement('table');
        itemDetailsTable.classList.add('modal-item-details');

        // Add table headers if needed
        itemDetailsTable.innerHTML = `
            <tr>
                <th>Item Name</th>
                <th>Category</th>
                <th>Variant/Size</th>
                <th>Quantity</th>
                <th>Retail Price</th>
                <th>Total Price</th>
            </tr>
        `;

        let categ; // Variable to store the category name
        // Find the matching category object
        const matchedCategory = category.find(category => category.id === item.product.category_id);
        // If found, set categ to the category_name
        if (matchedCategory) {
            categ = matchedCategory.category_name;
        } else {
            categ = 'No category'; // Default value if no match is found
        }

        const itemRow = document.createElement('tr');
        itemRow.innerHTML = `
            <td>${item.product.product_name}</td>
            <td>${categ}</td>
            <td>${item.product_variant ? item.product_variant.size || "N/A" : "N/A"}</td>
            <td>${item.quantity}</td>
            <td>₱ ${parseFloat(item.price).toFixed(2)}</td>
            <td>₱ ${parseFloat(item.price*item.quantity).toFixed(2)}</td>
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
function denyConfirm(denial_com){
    var myModal = new bootstrap.Modal(document.getElementById('denyConfirmModal'));
    denial_comment = denial_com;
    console.log(denial_comment);
    myModal.show();
}
function setDenyStatus(stat){
    document.getElementById('gotoDen').disabled = false;
    document.getElementById('denyChoiceButton').textContent = stat;
    denial_reason = stat;
}
function closeDenial(){
    document.getElementById('gotoDen').disabled = true;
    document.getElementById('denyChoiceButton').textContent = 'Choose Options';
    var myModal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
    myModal.show();
}
</script>

@endsection
