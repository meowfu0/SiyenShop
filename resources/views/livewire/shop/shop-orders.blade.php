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
            <img src="{{asset('images/Circuits.svg')}}" alt="">
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
                <button type="button" data-bs-toggle="modal" data-bs-target="#PrintConfirmModal" onclick="printTable()" disabled style="opacity: 0.5">
                    <img  style="height: 23px; width:23px;" src="{{ asset('images/print.svg') }}" alt="">
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ExportConfirmModal" disabled style="opacity: 0.5">
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
                <tr class="status-label {{ getStatusClass($order->order_status_id) }}" onclick="openOrderModal({{ $order }}, {{ $orderItems }}, {{ $categories }})">
                    <td class="id">{{ $order->id }}</td>
                    <td >{{ $order->total_items }}</td>
                    <td>{{ number_format($order->total_amount, 1) }}</td>
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
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                </div>
                <div class="transact-col4">
                    <p id="modalDate"></p>
                    <p id="modalTime"></p>
                    <p id="modalItemCount"></p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal" id="closeModal">Cancel</button>
                <button type="button" class="btn btn-light" data-bs-toggle="modal" onclick="confirmStatus('Denied', document.getElementById('modalOrderId').innerText)" id="denyButton">Deny Payment</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="confirmStatus(document.getElementById('modalStatus').innerText, document.getElementById('modalOrderId').innerText)" style="width: 150px !important;" id="updateButton">Update Status</button>
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
        <div class="modal fade" id="denial-options" tabindex="-1" aria-labelledby="approveConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Deny Options</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" onclick="denyConfirm()">Confirm</button>
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
                        <button type="button" class="btn btn-primary" data-bs-dismiss="modal" data-bs-target="orderDetailsModal" style="margin-right: 100px !important; margin-bottom: 20px !important;">Confirm</button>
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
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
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
                            <button type="button" class="export-btn" data-bs-dismiss="modal" onclick="downloadPDF()" style="width: 76px; height: 28px;">PDF</button>
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
                        <button type="button" class="export-btn" data-bs-dismiss="modal" onclick="printTable()" style="width: 76px; height: 28px;">Print</button>
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
function openOrderModal(order, orderItem, category) {
    const currentItems = orderItem.filter(item => item.order_id === order.id);
    createModalTable(currentItems, category);
    document.getElementById("modalOrderId").textContent = order.id;
    document.getElementById("modalTotalAmount").textContent = `P${order.total_amount}`;
    document.getElementById("modalPaymentMethod").textContent = order.payment_method ?? 'N/A';
    document.getElementById("modalReferenceNumber").textContent = order.reference_number;
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

   
    //Hide Deny Button if status is not pending
    // Set the status label and class
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


// EXPORT AND PRINT
function printTable() {
    // Get the selected dates from the print modal
    var startDate = document.getElementById('print-from').value;
    var endDate = document.getElementById('print-to').value;

    // Check if the user has selected both dates
    if (startDate && endDate) {
        var rows = document.querySelectorAll('.status-label.completed-order'); // Get only completed orders
        if (rows.length > 0) {
            var printContent = "<table>" + Array.from(rows).map(row => row.outerHTML).join('') + "</table>";
            var printWindow = window.open('', '', 'height=800,width=800');
            printWindow.document.write('<html><head><title>Print Completed Orders</title></head><body>');
            printWindow.document.write('<h3>Completed Orders from ' + startDate + ' to ' + endDate + '</h3>');
            printWindow.document.write(printContent);
            printWindow.document.write('</body></html>');
            printWindow.document.close();
            printWindow.print();
        } else {
            alert("No completed orders to print.");
        }
    } else {
        alert("Please select both start and end dates.");
    }
}

function downloadCSV() {
    // Get the selected dates from the export modal
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    // Fetch the shop name dynamically
    var shopName = document.getElementById('shopName')?.innerText || 'Shop Name'; // Default if shop name is not found

    if (startDate && endDate) {
        // Select rows with the specified class
        var rows = document.querySelectorAll('.status-label.completed-order');
        console.log("Fetching rows with class '.status-label.completed-order'");
        console.log("Rows:", rows);
        console.log("Row count:", rows.length);

        if (rows && rows.length > 0) {
            var csv = [];
            var totalSales = 0; // Variable to calculate total sales

            // Add the main header with shop name and report range
            csv.push(['Shop Name', shopName]); // Shop name
            csv.push(['Date Range', startDate, endDate]); // Date range
            csv.push(['Total Sales', totalSales.toFixed(2)]); // Total sales placeholder
            csv.push([]); // Empty line for spacing

            // Add column headers (without the "Product" column)
            csv.push(['Order ID', 'Quantity', 'Unit Price', 'Amount', 'Ref no.', 'Status', 'Date'].join(','));

            // Loop through the rows to process the order data
            rows.forEach(row => {
                var cols = row.cells || [];
                var rowData = [];

                // Gather cell data while skipping the 2nd and 7th columns
                for (var j = 0; j < cols.length; j++) {
                    if (j === 1 || j === 6) continue; // Skip the 2nd (index 1) and 7th (index 6) columns
                    if (cols[j]) {
                        rowData.push(cols[j].innerText.trim());
                    }
                }

                // Add the row to the CSV array if it has valid data
                if (rowData.some(cell => cell !== '')) {
                    // Calculate total sales from the 4th column (Amount, now index 3 after removing Product)
                    var amount = parseFloat(rowData[3]?.replace(/[^0-9.-]+/g, '')) || 0; // Parse amount
                    totalSales += amount;

                    csv.push(rowData.join(',')); // Add the row to CSV
                }
            });

            // Update the total sales value in the header
            csv[2] = ['Total Sales', totalSales.toFixed(2)]; // Update total sales row

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
    } else {
        alert("Please select both start and end dates.");
    }
}


function downloadXLSX() {
    // Get the selected dates from the export modal
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    // Fetch the shop name dynamically
    var shopName = document.getElementById('shopName')?.innerText || 'Shop Name'; // Default if shop name is not found

    if (startDate && endDate) {
        // Select rows with the specified class
        var rows = document.querySelectorAll('.status-label.completed-order');
        console.log("Fetching rows with class '.status-label.completed-order'");
        console.log("Rows:", rows);
        console.log("Row count:", rows.length);

        if (rows && rows.length > 0) {
            var totalSales = 0; // Variable to calculate total sales
            var data = []; // Array to hold all the rows for the Excel file

            // Add headers for shop name, date range, and total sales
            data.push(['Shop Name', shopName]); // Shop name
            data.push(['Date Range', startDate, endDate]); // Date range
            data.push(['Total Sales', totalSales.toFixed(2)]); // Total sales placeholder
            data.push([]); // Empty row for spacing

            // Add column headers
            data.push(['Order ID', 'Quantity', 'Unit Price', 'Amount', 'Ref no.', 'Status', 'Date']); // Skip 'Product' in headers

            // Loop through the rows to process the order data
            rows.forEach(row => {
                var cols = row.cells || [];
                var rowData = [];

                // Gather cell data while skipping the 2nd and 7th columns
                for (var j = 0; j < cols.length; j++) {
                    if (j === 1 || j === 6) continue; // Skip the 2nd (index 1) and 7th (index 6) columns
                    if (cols[j]) {
                        rowData.push(cols[j].innerText.trim());
                    }
                }

                // Add the row to the data array if it has valid data
                if (rowData.some(cell => cell !== '')) {
                    // Calculate total sales from the 4th column (Amount, now index 3 after removing Product)
                    var amount = parseFloat(rowData[3]?.replace(/[^0-9.-]+/g, '')) || 0; // Parse amount
                    totalSales += amount;

                    data.push(rowData);
                }
            });

            // Update the total sales value in the header
            data[2][1] = totalSales.toFixed(2); // Set total sales value

            // Create a new workbook and worksheet using SheetJS
            var workbook = XLSX.utils.book_new();
            var worksheet = XLSX.utils.aoa_to_sheet(data);

            // Append the worksheet to the workbook
            XLSX.utils.book_append_sheet(workbook, worksheet, "Completed Orders");

            // Export the workbook as an Excel file
            XLSX.writeFile(workbook, `completed_orders_${shopName.replace(/\s+/g, '_')}.xlsx`);
        } else {
            alert("No completed orders to export.");
        }
    } else {
        alert("Please select both start and end dates.");
    }
}


function downloadPDF() {
    const { jsPDF } = window.jspdf;
    const doc = new jsPDF();

    // Get the start and end dates from the modal inputs
    const startDate = document.getElementById('export-from').value;
    const endDate = document.getElementById('export-to').value;

    // Get the shop name dynamically
    const shopName = document.getElementById('shopName')?.innerText || "Shop Name";

    // Extract table data
    const table = document.getElementById("order-table");
    const headers = [...table.rows[0].cells]
        .filter((_, index) => index !== 1 && index !== 6) // Remove 2nd and 7th columns
        .map(cell => cell.innerText);

    const rows = [];
    let totalSales = 0; // Track total sales from the 4th column

    for (let i = 1; i < table.rows.length; i++) {
        const row = table.rows[i];

        // Only process rows with "Completed" status
        if (row.querySelector('.status-label.completed-order')) {
            const rowData = [];
            for (let j = 0; j < row.cells.length; j++) {
                if (j !== 1 && j !== 6) { // Skip 2nd and 7th columns
                    const cellValue = row.cells[j].innerText;
                    rowData.push(cellValue);

                    // Accumulate total sales from the 5th column (4th after deletion)
                    if (j === 4) {
                        const amount = parseFloat(cellValue.replace(/[^0-9.-]+/g, '')) || 0;
                        totalSales += amount;
                    }
                }
            }
            rows.push(rowData);
        }
    }

    // Add a header with shop name and report range
    doc.setFontSize(11);
    doc.text(`Shop Name: ${shopName}`, 10, 20);
    if (startDate && endDate) {
        doc.text(`From: ${startDate}`, 10, 30);
        doc.text(`To: ${endDate}`, 10, 40);
    }
    doc.text(`Total Sales: ${totalSales.toFixed(2)}`, 10, 50);

    // Generate the PDF table with filtered rows
    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 60,
        theme: "grid",
        headStyles: {
            fillColor: [240, 240, 240],
            textColor: [0, 0, 0],
            halign: "center",
        },
        bodyStyles: {
            textColor: [0, 0, 0],
        },
    });

    // Add the shop logo at the bottom center
    const imgPath = "{{ asset('images/logo.png') }}";
    const imgWidth = 35;
    const imgHeight = 10;
    const pageHeight = doc.internal.pageSize.height;
    const pageWidth = doc.internal.pageSize.width;
    const xPos = (pageWidth - imgWidth) / 2;
    const yPos = pageHeight - imgHeight - 10;

    const image = new Image();
    image.src = imgPath;
    image.onload = function () {
        doc.addImage(image, "PNG", xPos, yPos, imgWidth, imgHeight);
        doc.save(`orders_${shopName.replace(/\s+/g, '_')}.pdf`);
    };
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
            buttons.forEach(button => {
                button.disabled = true;  // Disable each button
            });
        } else {
            // Show only rows with the matching status class
            if (row.classList.contains(selectedStatus)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
            
            // Disable buttons for all statuses except 'Completed Order'
            if (selectedStatus !== 'completed-order') {
                buttons.forEach(button => {
                    button.disabled = true;  // Disable each button
                    button.style.opacity = 0.5;
                });
            } else {
                // Enable buttons when 'Completed Order' is selected
                buttons.forEach(button => {
                    button.disabled = false;  // Enable each button
                    button.style.opacity = '';  // Reset opacity to original value
                });
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
    function updateStatus(status, orderId){
        console.log(status);
        console.log(orderId);
        const modal = new bootstrap.Modal(document.getElementById('approveConfirmModal'));
        modal.show();
    }


    var currentStat, currentId;
    // Function to fetch data and refresh the table
function fetchAndUpdateTable() {
    const order = @json($orders);

    refreshTable(order);
}

// Function to update the table with new data
function refreshTable(orders) {
    const tableBody = document.querySelector('#order-table tbody');
    tableBody.innerHTML = ''; // Clear the current table data
    
    console.log(orders);
    orders.forEach(order => {
            const row = document.createElement('tr');
            row.classList.add('status-label', getStatusClass(order.order_status_id));
            row.innerHTML = `
                <td>${order.id}</td>
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

    // Call fetchAndUpdateTable to initially load the table or refresh it
    function confirmStatus(status, orderId){
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

        const targetId = parseInt(currentId, 10);
       
        const data = {
            order_id: targetId,
            status_id: newStatus
        };
        fetch('/shop/orders/update-status', {
            method: 'POST',  // Using POST method
            headers: {
                'Content-Type': 'application/json',  // Sending JSON data
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')  // CSRF token for security
            },
            body: JSON.stringify(data)  // Convert the data object to JSON
        })
        .then(response => response.json())  // Parse JSON response from the server
        .then(data => {
            console.log('Success:', data);
            fetchAndUpdateTable()
        })
        .catch((error) => {
            console.error('Error:', error);
            // Optionally, handle error (e.g., display an error message)
        });

    }
    function viewProof(itemId){
        const orderYes = @json($orders);
        let targetId = parseInt(itemId);
        let matchedOrder = orderYes.find(order => order.id === targetId);

        console.log(matchedOrder.proof_of_payment);

        document.getElementById('proofImg').src = matchedOrder.proof_of_payment;
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
        
        img.src = item.product.product_image;
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
            <td>${item.product_variant.size || "N/A"}</td>
            <td>${item.quantity}</td>
            <td>P${parseFloat(item.price).toFixed(2)}</td>
            <td>P${parseFloat(item.price*item.quantity).toFixed(2)}</td>
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
function denyConfirm(){
    var myModal = new bootstrap.Modal(document.getElementById('denyConfirmModal'));
    myModal.show();
}
</script>


@endsection
