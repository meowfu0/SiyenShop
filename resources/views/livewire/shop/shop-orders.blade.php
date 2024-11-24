@extends('layouts.shop')

@section('content')
    <div class="flex-grow-1" style="width: 100%!important;">
        @include('components.profilenav')
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{asset('images/Circuits.svg')}}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students </h2>
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
                <button type="button" data-bs-toggle="modal" data-bs-target="#PrintConfirmModal" onclick="printTable()">
                    <img  style="height: 23px; width:23px;" src="{{ asset('images/print.svg') }}" alt="">
                </button>
                <button type="button" data-bs-toggle="modal" data-bs-target="#ExportConfirmModal" >
                    <img  style="height: 23px; width:23px;" src="{{ asset('images/export.svg') }}" alt="">
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
        <tr class="status-label {{ getStatusClass($order->order_status_id) }}"
            data-status="{{ $order->order_status_id }}"
            onclick="openOrderModal({{ json_encode($order) }})">
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
        <div>
            <br><br><br>
        </div>

</div>
 <!-- TABLE END -->

<!-- FOR PENDING ORDERS-->
<div class="modal fade" id="orderDetailsModal" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg">
        <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 25px; height: 25px;">
                <h5 class="modal-title" id="orderDetailsLabel">Order Details</h5>
                <div class="p-10 mb-2 bg-light text-dark" id="modalStatus" style="padding-top:18px;"></div>
            </div>
            <!-- Modal Body -->
            <div class="modal-body"> 
                <!-- Product Info -->
                <div class="modal-items">
                    <table class="modal-item-table" id="modalItemsTable">
                        <!-- Items will be populated dynamically by JavaScript -->
                        <div class="modalinside">
                            <ul class="modal-list-inline">
                                <li>Item</li>
                                <li>Quantity</li>
                                <li>Variant/Size</li>
                            </ul>
                            <!-- Dynamically updated image -->
                            <img src="" alt="" id="productImg" style="display: none;">
                            
                        </div>
                        <div class="modalinside2">
                            <p id="modalCategoryName"></p>
                            <p id="modalQuantity"></p>
                            <p id="modalVariant"></p>
                        </div>
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
                    <p id="modalCategoryName"></p>
                    <p id="modalOrderId"></p>
                    <p id="modalTotalAmount"></p>
                    <p id="modalPaymentMethod"></p>
                    <p id="modalProofOfPayment"></p>
                    <p id="modalReferenceNumber"></p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                </div>
                <div class="transact-col4">
                    <p id="modalDate"></p>
                    <p id="modalTime"></p>
                    <p id="modalItemCount"></p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" onclick="changeStatus()" style="width: 230px;">Change Status</button>

            </div>
        </div>
    </div>
</div>









        <!-- FOR PENDING -->
        <div class="modal fade" id="approveConfirmModal" tabindex="-1" aria-labelledby="approveConfirmLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content border-0">
            <div class="modal-body">
                <h3>Are you sure you want to approve this payment? </h3>
            </div>
            <div class="modal-footer border-0">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" id="confirmApproveBtn">Approve Payment</button>
            </div>
        </div>
    </div>
</div>

</div>
        
        <!-- FOR RECEIVED-PAYMENT -->
        <div class="modal fade" id="ReceiveConfirmModal" tabindex="-1" aria-labelledby="PickUpConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to change "Received Payment" to "Ready for Pick-up" status?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
                    </div>
                </div>
            </div>
        </div>
        <!-- FOR PICKUP -->
        <div class="modal fade" id="PickConfirmModal" tabindex="-1" aria-labelledby="CompletedConfirmLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered">
                <div class="modal-content border-0">
                    <div class="modal-body">
                        <h3>Are you sure you want to change "For Pick-up" to "Completed" status?</h3>
                    </div>
                    <div class="modal-footer border-0">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                        <button type="button" class="btn btn-primary">Confirm</button>
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
                        <button type="button" class="btn btn-primary">Confirm</button>
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
                        <button type="button" class="btn btn-primary">Confirm</button>
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
        var printContent = document.getElementById('order-table').outerHTML;
        var printWindow = window.open('', '', 'height=800,width=800');
        printWindow.document.write('<html><head><title>Print Order Table</title></head><body>');
        printWindow.document.write('<h3>Orders from ' + startDate + ' to ' + endDate + '</h3>');
        printWindow.document.write(printContent);
        printWindow.document.write('</body></html>');
        printWindow.document.close();
        printWindow.print();
    } else {
        alert("Please select both start and end dates.");
    }
}
function downloadCSV() {
    // Get the selected dates from the export modal
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    if (startDate && endDate) {
        var table = document.getElementById('order-table');
        var rows = table.rows;
        var csv = [];

        // Add a header row with the date range
        csv.push(['Orders from ' + startDate + ' to ' + endDate].join(','));

        // Loop through the rows and add them to the CSV
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var cols = row.cells;
            var rowData = [];
            for (var j = 0; j < cols.length; j++) {
                rowData.push(cols[j].innerText);
            }
            csv.push(rowData.join(','));
        }

        var csvFile = new Blob([csv.join('\n')], { type: 'text/csv' });
        var link = document.createElement('a');
        link.href = URL.createObjectURL(csvFile);
        link.download = 'orders.csv';
        link.click();
    } else {
        alert("Please select both start and end dates.");
    }
}

function downloadXLSX() {
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    if (startDate && endDate) {
        var table = document.getElementById('order-table');
        var rows = table.rows;

        var workbook = XLSX.utils.book_new();
        var sheetData = [];

        // Add a header row with the date range
        sheetData.push(['Orders from ' + startDate + ' to ' + endDate]);

        // Loop through the rows and add them to the sheet data
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var cols = row.cells;
            var rowData = [];
            for (var j = 0; j < cols.length; j++) {
                rowData.push(cols[j].innerText);
            }
            sheetData.push(rowData);
        }

        var sheet = XLSX.utils.aoa_to_sheet(sheetData);
        XLSX.utils.book_append_sheet(workbook, sheet, 'Orders');
        XLSX.writeFile(workbook, 'orders.xlsx');
    } else {
        alert("Please select both start and end dates.");
    }
}

function downloadPDF() {
    var startDate = document.getElementById('export-from').value;
    var endDate = document.getElementById('export-to').value;

    if (startDate && endDate) {
        var table = document.getElementById('order-table');
        var rows = table.rows;

        var doc = new jsPDF();
        var rowData = [];

        // Add a header row with the date range
        doc.text('Orders from ' + startDate + ' to ' + endDate, 10, 10);
        rowData.push(['Orders from ' + startDate + ' to ' + endDate]);

        // Loop through the rows and add them to the PDF
        for (var i = 0; i < rows.length; i++) {
            var row = rows[i];
            var cols = row.cells;
            var pdfRow = [];
            for (var j = 0; j < cols.length; j++) {
                pdfRow.push(cols[j].innerText);
            }
            rowData.push(pdfRow);
        }

        doc.autoTable({
            head: [Array.from(rows[0].cells).map(cell => cell.innerText)],
            body: rowData.slice(1),
        });

        doc.save('orders.pdf');
    } else {
        alert("Please select both start and end dates.");
    }
}



function downloadExcel() {
    // Similar to CSV download, but this is where you'd generate an XLSX file
    alert("Please Wait.");
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
        rows.push([...table.rows[i].cells].map(cell => cell.innerText));
    }

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

// Initialize table on DOM load
document.addEventListener('DOMContentLoaded', function () {
    updateTable();
});

</script>






<script>
    // CHANGE STATUS 
    
</script>

<script>
function openOrderModal(order) {
    // Category and image mappings
    const categoryMap = {
        1: 'Lanyards',
        2: 'Pins',
        3: 'Stickers',
        4: 'T-Shirt',
        5: 'Tote-Bag',
        6: 'Keyholder',
        7: 'Lanyards',
        8: 'Pins',
        9: 'Stickers',
        10: 'T-Shirt',
        11: 'Tote-Bag',
        12: 'Keyholder'
    };

    const categoryImageMap = {
        1: 'lanyard.jpg',
        2: 'pin.jpg',
        3: 'sticker.jpg',
        4: 'tshirt.jpg',
        5: 'totebag.jpg',
        6: 'keyholder.jpg',
        7: 'lanyard.jpg',
        8: 'pin.jpg',
        9: 'sticker.jpg',
        10: 'tshirt.jpg',
        11: 'totebag.jpg',
        12: 'keyholder.jpg'
    };

    // Update modal content
    document.getElementById("modalOrderId").textContent = order.id ?? 'N/A';
    document.getElementById("modalTotalAmount").textContent = `P${order.total_amount ?? 0}`;
    document.getElementById("modalPaymentMethod").textContent = order.payment_method ?? 'N/A';
    document.getElementById("modalProofOfPayment").textContent = order.proof_of_payment ?? 'N/A';
    document.getElementById("modalReferenceNumber").textContent = order.reference_number ?? 'N/A';
    document.getElementById("modalDate").textContent = order.order_date ?? 'N/A';
    document.getElementById("modalTime").textContent = order.order_time ?? 'N/A';
    document.getElementById("modalCategoryName").textContent = categoryMap[order.category_id] ?? 'Unknown Category';
    document.getElementById("modalQuantity").textContent = order.total_items ?? 'N/A';
    document.getElementById("modalVariant").textContent = order.variant ?? 'N/A';

    // Set product image
    const productImgElement = document.getElementById("productImg");
    const productImagePath = categoryImageMap[order.category_id] ? `../images/orders/${categoryImageMap[order.category_id]}` : '';
    if (productImagePath) {
        productImgElement.src = productImagePath;
        productImgElement.style.display = 'block';
    } else {
        productImgElement.style.display = 'none';
    }

    // Populate items table
    const itemsHtml = (order.items || []).map(item => `
        <tr>
            <td>${item.name ?? 'Item'}</td>
            <td>${item.quantity ?? 0}</td>
            <td>${item.variant ?? 'N/A'}</td>
        </tr>
    `).join('');
    document.getElementById("modalItemsTable").innerHTML = itemsHtml;

    // Update modal status
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

    const modalStatusElement = document.getElementById("modalStatus");
    modalStatusElement.textContent = statusLabel;
    modalStatusElement.className = `badge ${statusClass}`;

    const modal = new bootstrap.Modal(document.getElementById('orderDetailsModal'));
    modal.show();
}

function approveConfirmModal(order) {
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

    const modalStatusElement = document.getElementById("approveConfirmStatus");
    modalStatusElement.textContent = statusLabel;
    modalStatusElement.className = `badge ${statusClass}`;
}
</script>

<script>
     function changeStatus() {
        const orderId = document.getElementById('modalOrderId').textContent; 
        if (!confirm("Are you sure you want to change the order status to 'Payment Received'?")) {
            return;
        }
        fetch(`/orders/${orderId}/change-status`, {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            },
            body: JSON.stringify({
                status: 10 
            }),
        })
        .then(response => {
            if (!response.ok) {
                throw new Error('Failed to update order status');
            }
            return response.json();
        })
        .then(data => {
            alert(data.message);
            document.getElementById('modalStatus').textContent = "Payment Received";
            document.getElementById('modalOrderId').setAttribute('data-status', 10);
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while updating the status.');
        });
    }
</script>

@endsection
