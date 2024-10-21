<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Business Manager</title>
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/bussOrder.css') }}" rel="stylesheet">

    <script src="{{ asset('js/statusdd.js') }}"></script>
</head>
<body>
    <div>
        @include('layouts.buss')
    </div>

    <div class="content-orders">
        <div class="content-title-orders">
            <img src="{{ asset('images/Circuits.svg') }}" class="logo-img"  style="height: 28px; width: 28px; margin-right: 5px;" align="left">
            <h4 style="display:inline-block">Circle of Unified Information Technology Students (CIRSCUITS)</h4>
        </div>
    </div>
    <div class="scrollable-content">
        <div class="identifiers">
            <div class="btn-group">
                <select class="dropdown">
                    <option>10</option>
                    <option>20</option>
                    <option>30</option>
                </select>
            <span style="margin-left: 5px;">entries per page</span>
            </div>

            <div id="search" >
                <input type="text" id="search-box" class="search-box" placeholder="Search">
            </div>

            <div class="btn-group">
            <span style="margin-right: 10px;">Status</span>
                <select class="dropdown"  id="status-filter">
                    <option value="all"><a href="#">All</a></option>
                    <option value="pending"><a href="#">Pending</a></option>
                    <option value="received-payment"><a href="#">Payment Received</a></option>
                    <option  value="denied-payment"><a href="#">Denied Payment</a></option>
                    <option value="for-pickup"><a href="#">For Pickup</a></option>
                    <option value="completed-order"><a href="#">Completed Order</a></option>
                </select>
            </div>

            <div class="icons">
                    <button type="button" data-bs-toggle="modal" data-bs-target="#PrintConfirmModal"><img  style="height: 23px; width:23px;"src="{{ asset('images/print.svg') }}" alt=""> </button>
                    <button type="button" data-bs-toggle="modal" data-bs-target="#ExportConfirmModal"><img  style="height: 23px; width:23px;"src="{{ asset('images/export.svg') }}" alt=""> </button>
            </div>

            </div>
            <div class="order_table">
             <!-- Product Table -->
            <!-- Product Table -->
                <table class="table table-hover table-borderless">
                    <thead>
                        <tr>
                            </th>
                            <th scope="col">Order ID</th>
                            <th scope="col">Product</th>
                            <th scope="col">Quantity</th>
                            <th scope="col">Unit Price</th>
                            <th scope="col">Amount</th>
                            <th scope="col">Ref no.</th>
                            <th scope="col">Prof of payment</th>
                            <th scope="col">Status</th>
                            <th scope="col">Date</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr class="order-row" data-status="pending">
                            <td>0123123</td>
                            <td>Vintage Shoes</td>
                            <td>1</td>
                            <td>200.00</td>
                            <td>200.00</td>
                            <td>901234871</td>
                            <td>screenshot101.jpeg</td>
                            <!--<td><button class="status-box-y">Pending</button></td>-->
                            <td><button type="button" class="status-box-y" fdprocessedid="kyrfo" 
                            data-bs-toggle="modal" data-bs-target="#orderDetailsModal-pen">Pending</button></td>
                            <td>08-10-24</td>
                        </tr>
                        <tr class="order-row" data-status="received-payment">
                            <td>0123124</td>
                            <td>Napkin</td>
                            <td>1</td>
                            <td>10.00</td>
                            <td>10.00</td>
                            <td>901234872</td>
                            <td>screenshot103.jpeg</td>
                            <td><button type="button" class="status-box-y" fdprocessedid="kyrfo" 
                            data-bs-toggle="modal" data-bs-target="#orderDetailsModal-prec">Received Payment</button></td>
                            <td>08-11-24</td>
                        </tr>
                        <tr class="order-row" data-status="for-pickup">
                            <td>0123125</td>
                            <td>CShirt</td>
                            <td>1</td>
                            <td>250.00</td>
                            <td>250.00</td>
                            <td>901234873</td>
                            <td>screenshot.jpeg</td>
                            <td><button type="button" class="status-box-y" fdprocessedid="kyrfo" 
                            data-bs-toggle="modal" data-bs-target="#orderDetailsModal-fpick">For Pickup</button></td>
                            <td>08-12-24</td>
                        </tr>
                        <tr class="order-row" data-status="completed-order">
                            <td>0123126</td>
                            <td>Siomai</td>
                            <td>2</td>
                            <td>50.00</td>
                            <td>50.00</td>
                            <td>901234874</td>
                            <td>screenshot.jpeg</td>
                            <td><button type="button" class="status-box-g" fdprocessedid="kyrfo" 
                            data-bs-toggle="modal" data-bs-target="#orderDetailsModal-ocomp">Completed</button></td>
                            
                            <td>08-13-24</td>
                        </tr>
                        <tr class="order-row" data-status="denied-payment">
                            <td>0123127</td>
                            <td>sting</td>
                            <td>1</td>
                            <td>25.00</td>
                            <td>25.00</td>
                            <td>901234875</td>
                            <td>screenshot.jpeg</td>
                            <td><button type="button" class="status-box-r" fdprocessedid="kyrfo" 
                            data-bs-toggle="modal" data-bs-target="#orderDetailsModal-den">Denied Payment</button></td>
                            <td>08-14-24</td>
                        </tr>
                        <tr  class="order-row" data-status="pending">
                            <td>0123128</td>
                            <td>borgir</td>
                            <td>1</td>
                            <td>25.00</td>
                            <td>25.00</td>
                            <td>901234876</td>
                            <td>screenshot.jpeg</td>
                            <td><button class="status-box-y">Pending</button></td>
                            <td>08-14-24</td>
                        </tr>
                        <tr  class="order-row" data-status="pending">
                            <td>0123129</td>
                            <td>palabok</td>
                            <td>1</td>
                            <td>35.00</td>
                            <td>35.00</td>
                            <td>901234877</td>
                            <td>screenshot.jpeg</td>
                            <td><button class="status-box-y">Pending</button></td>
                            <td>08-15-24</td>
                        </tr>
                        <tr  class="order-row" data-status="pending">
                            <td>0123130</td>
                            <td>mighty green</td>
                            <td>1</td>
                            <td>10.00</td>
                            <td>10.00</td>
                            <td>901234878</td>
                            <td>screenshot.jpeg</td>
                            <td><button class="status-box-y">Pending</button></td>
                            <td>08-16-24</td>
                        </tr>
                        <tr  class="order-row" data-status="pending">
                            <td>0123131</td>
                            <td>CS ID lace</td>
                            <td>1</td>
                            <td>250.00</td>
                            <td>250.00</td>
                            <td>901234879</td>
                            <td>screenshot.jpeg</td>
                            <td><button class="status-box-y">Pending</button></td>
                            <td>08-16-24</td>
                        </tr>
                        <tr  class="order-row" data-status="pending">
                            <td>0123132</td>
                            <td>turon</td>
                            <td>1</td>
                            <td>10.00</td>
                            <td>10.00</td>
                            <td>901234880</td>
                            <td>screenshot.jpeg</td>
                            <td><button class="status-box-y">Pending</button></td>
                            <td>08-16-24</td>
                        </tr>
            </tbody>
        </table>
        </div>
        <div class="footer-btn">
            <p>Showing 1 to 10 of 100 entries</p>
            <a class="page-link" href="#" aria-label="Previous" style="margin-left: 530px;">
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
            <a class="page-link" href="#" aria-label="Next">
                        <span aria-hidden="true">&rsaquo;</span></a>
        </div>
    </div>
</div>
 <!-- added Pending Modal-->
 <div class="modal fade" id="orderDetailsModal-pen" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                    Mr. Sapote
                </h5>
                <div class="p-3 mb-2 bg-light text-dark">Pending</div>
                
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Product Info -->
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
                                        <td>Vintage Shoes</td>
                                        <td>Shoes</td>
                                        <td>Large</td>
                                        <td>1</td>
                                        <td>P200.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                                        <td>Peter's Shoes</td>
                                        <td>Vintage Shoes</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>P200.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                                        <td>Manok ni Leonard</td>
                                        <td>Mahal ko siya</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>P1200.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                    <p>0123123</p>
                    <p>P1600.00</p>
                    <p>GCASH</p>
                    <p>screenshot101.jpeg</p>
                    <p>901234871</p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                </div>
                <div class="transact-col4">
                    <p>08-10-24</p>
                    <p>12:51am</p>
                    <p>3</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-light" data-bs-toggle="modal" data-bs-target="#denyConfirmModal">Deny Payment</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#approveConfirmModal" style="width: 150px !important;">Approve Payment</button>
            </div>
            </div>
        </div>
    </div>

    <!-- added Received Payment modal-->
    <div class="modal fade" id="orderDetailsModal-prec" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                    BU Symbiosis
                </h5>
                <div class="p-3 mb-2 bg-light text-dark">Received Payment</div>
                
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Product Info -->
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
                                        <td>Napkin</td>
                                        <td>Cleansing</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>10.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                    <p>0123124</p>
                    <p>10.00</p>
                    <p>GCASH</p>
                    <p>screenshot101.jpeg</p>
                    <p>901234872</p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                </div>
                <div class="transact-col4">
                    <p>08-11-24</p>
                    <p>12:51am</p>
                    <p>1</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#PickUpConfirmModal" style="width: 150px !important;">Ready for Pick-up</button>
            </div>
            </div>
        </div>
    </div>

     <!-- added For Pickup modal-->
    <div class="modal fade" id="orderDetailsModal-fpick" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                    BU Symbiosis
                </h5>
                <div class="p-3 mb-2 bg-light text-dark">For Pickup</div>
                
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Product Info -->
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
                                        <td>CShirt</td>
                                        <td>t-shirt</td>
                                        <td>Large</td>
                                        <td>1</td>
                                        <td>250.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                    <p>0123125</p>
                    <p>250.00</p>
                    <p>GCASH</p>
                    <p>screenshot101.jpeg</p>
                    <p>901234873</p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                </div>
                <div class="transact-col4">
                    <p>08-12-24</p>
                    <p>12:51am</p>
                    <p>1</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#CompletedConfirmModal">Order completed</button>
            </div>
            </div>
        </div>
    </div>

    <!-- added Completed Modal -->
    <div class="modal fade" id="orderDetailsModal-ocomp" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                    Circle of Unified Information Technology Students (CIRCUITS)
                </h5>
                <div class="p-3 mb-2 bg-light text-dark">Completed</div>
                
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Product Info -->
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
                                        <td>Siomai</td>
                                        <td>foods</td>
                                        <td>Small</td>
                                        <td>2</td>
                                        <td>50.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                    <p>0123126</p>
                    <p>50.00</p>
                    <p>GCASH</p>
                    <p>screenshot101.jpeg</p>
                    <p>901234874</p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                </div>
                <div class="transact-col4">
                    <p>08-13-24</p>
                    <p>12:51am</p>
                    <p>1</p>
                </div>
            </div>
            </div>
        </div>
    </div>

    <!-- added Denied Modal -->
    <div class="modal fade" id="orderDetailsModal-den" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                    Circle of Unified Information Technology Students (CIRCUITS)
                </h5>
                <div class="p-3 mb-2 bg-light text-dark">Denied</div>
                
            </div>
            <!-- Modal Body -->
            <div class="modal-body">
                <!-- Product Info -->
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
                                        <td>Sting</td>
                                        <td>Drinks</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>25.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
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
                    <p>0123127</p>
                    <p>25.00</p>
                    <p>GCASH</p>
                    <p>screenshot101.jpeg</p>
                    <p>901234875</p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                    <p>Reason: </p>
                </div>
                <div class="transact-col4">
                    <p>08-14-24</p>
                    <p>12:51am</p>
                    <p>1</p>
                    <p>Sabi ni madam stap na kaan</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ReceivedConfirmModal" style="width: 150px !important;">Received Payment</button>
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
                    <button type="button" class="btn btn-primary">Confirm</button>
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
                    <button type="button" class="btn btn-primary">Confirm</button>
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
    <div class="modal fade" id="ExportConfirmModal" tabindex="-1" aria-labelledby="ExportConfirmLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0" >
                    <h4>Select Date Range</h4>
                </div>
                <div class="modal-body">
                    <div id="from" >
                        <p>From</p>
                        <input type="date" class="form-control" placeholder="Select a date">
                    </div>
                    <br>
                    <div id="to" >
                        <p>To</p>
                        <input type="date" class="form-control" placeholder="Select a date">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button-exp" class="export-btn" data-bs-dismiss="modal" style="width: 76px; height: 28px;">pdf</button>
                    <button type="button-exp" class="export-btn" data-bs-dismiss="modal" style="width: 76px; height: 28px;">csv</button>
                    <button type="button-exp" class="export-btn" data-bs-dismiss="modal" style="width: 76px; height: 28px;">xlxs</button>
                </div>
            </div>
        </div>
    </div>
     <!-- Print Modal -->
     <div class="modal fade" id="PrintConfirmModal" tabindex="-1" aria-labelledby="PrintConfirmLabel" aria-hidden="true" >
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content border-0">
                <div class="modal-header border-0" >
                    <h4>Select Date Range</h4>
                </div>
                <div class="modal-body">
                    <div id="from" >
                        <p>From</p>
                        <input type="date" class="form-control" placeholder="Select a date">
                    </div>
                    <br>
                    <div id="to" >
                        <p>To</p>
                        <input type="date" class="form-control" placeholder="Select a date">
                    </div>
                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button type="button-exp" class="export-btn" data-bs-dismiss="modal" style="width: 76px; height: 28px;">print</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>