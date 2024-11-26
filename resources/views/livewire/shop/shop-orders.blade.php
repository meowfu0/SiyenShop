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
        <h2 class="fw-bold m-0 text-primary">{{$shop->shop_name}}</h2>  
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
                <th scope="col">Product</th>
                <th scope="col">Quantity</th>
                <th scope="col">Unit Price</th>
                <th scope="col">Amount</th>
                <th scope="col">Ref no.</th>
                <th scope="col">Proof of Payment</th>
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
                <tr class="status-label {{ getStatusClass($order->order_status_id) }}" onclick="openOrderModal({{ json_encode($order) }})">
                    <td>{{ $order->id }}</td>
                    <td class="product-name">{{ $order->product_name ?? 'N/A' }}</td>
                    <td>{{ $order->total_items }}</td>
                    <td>{{ number_format($order->supplier_price_total_amount, 1) }}</td>
                    <td>{{ number_format($order->total_amount, 1) }}</td>
                    <td class="reference-number">{{ $order->reference_number }}</td>
                    <td>{{ $order->proof_of_payment }}</td>
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
                        <!-- Items will be populated dynamically by JavaScript -->
                    </table>
                </div>
                <hr/>
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

    // Initialize table on DOM load
    document.addEventListener('DOMContentLoaded', function () {
        updateTable();
    });
</script>

<script>
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
    // Populate the modal fields
    document.getElementById("modalOrderId").textContent = order.id;
    document.getElementById("modalTotalAmount").textContent = `P${order.total_amount}`;
    document.getElementById("modalPaymentMethod").textContent = order.payment_method ?? 'N/A';
    document.getElementById("modalProofOfPayment").textContent = order.proof_of_payment ?? 'N/A';
    document.getElementById("modalReferenceNumber").textContent = order.reference_number;
    document.getElementById("modalDate").textContent = order.order_date;
    document.getElementById("modalTime").textContent = order.order_time ?? 'N/A'; // Assuming order_time is available

    // Set the order items (if available)
    let itemsHtml = '';
    if (order.items) {
        order.items.forEach(item => {
            itemsHtml += `
                <tr>
                    <td>${item.name}</td>
                    <td>${item.category}</td>
                    <td>${item.variant ?? 'N/A'}</td>
                    <td>${item.quantity}</td>
                    <td>P${item.price}</td>
                </tr>
            `;
        });
    }
    document.getElementById("modalItemsTable").innerHTML = itemsHtml;

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
document.getElementById('search-box').addEventListener('input', function () {
    let searchTerm = this.value.toLowerCase();
    let rows = document.querySelectorAll('.order_table tbody tr');
    let hasVisibleRows = false;

    rows.forEach(row => {
        let productName = row.querySelector('.product-name').textContent.toLowerCase();
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

    if (startDate && endDate) {
        var rows = document.querySelectorAll('.status-label.completed-order'); // Get only completed orders
        if (rows.length > 0) {
            var csv = [];

            // Add a header row with the date range
            csv.push(['Orders from ' + startDate + ' to ' + endDate].join(','));

            // Loop through the rows and add them to the CSV
            rows.forEach(row => {
                var cols = row.cells;
                var rowData = [];
                for (var j = 0; j < cols.length; j++) {
                    rowData.push(cols[j].innerText);
                }
                csv.push(rowData.join(','));
            });

            var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
            var link = document.createElement('a');
            link.href = URL.createObjectURL(csvFile);
            link.download = 'completed_orders.csv';
            link.click();
        } else {
            alert("No completed orders to export.");
        }
    } else {
        alert("Please select both start and end dates.");
    }
}

function downloadXLSX() {
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    if (startDate && endDate) {
        var rows = document.querySelectorAll('.status-label.completed-order'); // Get only completed orders
        if (rows.length > 0) {
            var workbook = XLSX.utils.book_new();
            var sheetData = [];

            // Add a header row with the date range
            sheetData.push(['Orders from ' + startDate + ' to ' + endDate]);

            // Loop through the rows and add them to the sheet data
            rows.forEach(row => {
                var cols = row.cells;
                var rowData = [];
                for (var j = 0; j < cols.length; j++) {
                    rowData.push(cols[j].innerText);
                }
                sheetData.push(rowData);
            });

            var sheet = XLSX.utils.aoa_to_sheet(sheetData);
            XLSX.utils.book_append_sheet(workbook, sheet, 'Completed Orders');
            XLSX.writeFile(workbook, 'completed_orders.xlsx');
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

    // Get the start and end date from the modal inputs
    const startDate = document.getElementById('export-from').value;
    const endDate = document.getElementById('export-to').value;

    // Check if dates are provided
    if (startDate && endDate) {
        // Add the start and end date to the left of the PDF
        doc.setFontSize(11);
        doc.text("From: " + startDate, 10, 20); // From date on the left
        doc.text("To: " + endDate, 10, 30);   // To date on the left
    }

    // Extract table data
    const table = document.getElementById("order-table");
    const headers = [...table.rows[0].cells].map(cell => cell.innerText);
    const rows = [];

    for (let i = 1; i < table.rows.length; i++) {
        const row = table.rows[i];

        // Only process rows with "Completed" status
        if (row.querySelector('.status-label.completed-order')) {
            const rowData = [];
            for (let j = 0; j < row.cells.length; j++) {
                rowData.push(row.cells[j].innerText);
            }
            rows.push(rowData);
        }
    }

    // Generate the PDF table with the filtered rows
    doc.autoTable({
        head: [headers],
        body: rows,
        startY: 40,
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
        doc.save("orders.pdf"); 
    };
}


//SORTING 
document.getElementById('search-box').addEventListener('input', function () {
    let searchTerm = this.value.toLowerCase();
    let rows = document.querySelectorAll('.order_table tbody tr');
    let hasVisibleRows = false;

    rows.forEach(row => {
        let productName = row.querySelector('.product-name').textContent.toLowerCase();
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

document.getElementById('search-box').addEventListener('input', function () {
    let searchTerm = this.value.toLowerCase();
    let rows = document.querySelectorAll('.order_table tbody tr');
    let hasVisibleRows = false;

    rows.forEach(row => {
        let productName = row.querySelector('.product-name').textContent.toLowerCase();
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

</script>

<script>
let currentPage = 1;
let entriesPerPage = 10; // Default entries per page

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

    //Update Status
    function updateStatus(status, orderId){
        console.log(status);
        console.log(orderId);
        const modal = new bootstrap.Modal(document.getElementById('approveConfirmModal'));
        modal.show();
    }
    document.addEventListener('DOMContentLoaded', function () {
    updateTable(); 
});

</script>

<script>
    var currentStat, currentId;
    // Function to fetch data and refresh the table
function fetchAndUpdateTable() {
    fetch('shop/orders') // URL to your Laravel route
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

    // Loop through the orders and add rows
    orders.forEach(order => {
            const row = document.createElement('tr');
            row.classList.add('status-label', getStatusClass(order.order_status_id));

            row.innerHTML = `
                <td>${order.id}</td>
                <td class="product-name">${order.product_name ?? 'N/A'}</td>
                <td>${order.total_items}</td>
                <td>${order.supplier_price_total_amount.toFixed(1)}</td>
                <td>${order.total_amount.toFixed(1)}</td>
                <td class="reference-number">${order.reference_number}</td>
                <td>${order.proof_of_payment}</td>
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
    document.addEventListener('DOMContentLoaded', function () {
        fetchAndUpdateTable(); // Initial data fetch and table update
    });

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
            case 'Payment Denied':
                modal = new bootstrap.Modal(document.getElementById('approveConfirmModal'));
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
            case 'Denied':
                modal = new bootstrap.Modal(document.getElementById('denyConfirmModal'));
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



</script>


@endsection
