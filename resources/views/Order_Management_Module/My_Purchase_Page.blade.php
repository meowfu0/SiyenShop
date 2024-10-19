    <html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Purchases</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/purchase.css') }}" rel="stylesheet">
    <link href="{{ asset('css/purchase-mobile.css') }}" rel="stylesheet">

    <script src="{{ asset('js/switchStat.js') }}"></script>


    <!-- added -->
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap JS (place before closing body tag or at the end of your HTML) -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <!-- added -->
     
</head>
<body>
    <div>
        <div id="sidebar">
             @include('components.sidenavUser') <!-- Sidebar content -->
        </div>
        @include('layouts.app')
    </div>
    <div class="content-purchase">
        <div class="content-title-purchase">
            <img src="{{ asset('images/products.svg') }}" class="logo-img">
            <h1>My Purchases</h1>
        </div>
        <div class="buttons">
            <button id="pend">Pending</button>
            <button id="prec">Received Payment</button>
            <button id="fpick">For Pickup</button>
            <button id="ocomp">Completed Orders</button>
            <button id="den">Denied Payments</button>
            <div id="innerLine">

            </div>
        </div>
        <div class="lineBar">
            <div id="dLine"></div>
        </div>

        <table id="pendTab">
            <tr>
                <td>
                    <div class="other-content-high">
                        <button class="shopName">CIRCUITS</button>
                        <button class="status-box">Pending</button>
                    </div>
                    <div class="item-img"></div>
                    <table class="dets">
                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Variant/Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>Small</td>
                            <td>1</td>
                            <td>P2.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P2.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">3</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <!--<button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>--> 
                        <button type="button" class="btn btn-primary" fdprocessedid="kyrfo" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-pen">View Details</button>
                        <!-- added up^ -->
                    </div>
                    <p class="multiple-indicator">Multiple items available. Click 'View Details' to see more</p>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="other-content-high">
                        <button class="shopName">Symbiosis</button>
                        <button class="status-box">Pending</button>
                    </div>
                    <div class="item-img"></div>
                    <table class="dets">
                        <tr>
                            <th>Item</th>
                            <th>Category</th>
                            <th>Variant/Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>Small</td>
                            <td>1</td>
                            <td>P2.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P2.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                    <div class="other-content-high">
                        <button class="shopName">CIRCUITS</button>
                        <button class="status-box">Pending</button>
                    </div>
                    <div class="item-img"></div>
                    <table class="dets">
                        <tr>
                            
                            <th>Item</th>
                            <th>Category</th>
                            <th>Variant/Size</th>
                            <th>Quantity</th>
                            <th>Price</th>
                        </tr>
                        <tr>
                            
                            <td>Baby Oil</td>
                            <td>Oil</td>
                            <td>100ML</td>
                            <td>1</td>
                            <td>P200.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P200.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
        </table>
        <table id="precTab">
            <tr>
                <td>
                    <div class="other-content-high">
                            <button class="shopName">Symbiosis</button>
                            <button class="status-box">Received Payment</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>Small</td>
                            <td>1</td>
                            <td>P2.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P2.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <!--Prec Button-->
                        <button type="button" class="btn btn-primary" fdprocessedid="kyrfo" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-prec">View Details</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Received Payment</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>Small</td>
                            <td>2</td>
                            <td>P40.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P80.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">2</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Received Payment</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>Dirty - L</td>
                            <td>10</td>
                            <td>P100.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P1000.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Received Payment</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Circuits Lanyard</td>
                            <td>Id Lanyard</td>
                            <td>Blue</td>
                            <td>1</td>
                            <td>P120.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P120.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
        </table>

        <table id="fpickTab">
            <tr>
                <td>
                    <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">For Pickup</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>ID lanyard</td>
                            <td>Lanyard</td>
                            <td>Pink</td>
                            <td>1</td>
                            <td>P100.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P100.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button type="button" class="btn btn-primary" fdprocessedid="kyrfo" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-fpick">View Details</button>
                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">For Pickup</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>XL</td>
                            <td>1</td>
                            <td>P1.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P1.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
        </table>

        <table id="ocompTab">
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Completed</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>T-Shirt</td>
                            <td>Category Name</td>
                            <td>Variant/Size Value</td>
                            <td>Quantity Value</td>
                            <td>Price Value</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P150.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button type="button" class="btn btn-light" fdprocessedid="wsfgm" data-bs-toggle="modal" data-bs-target="#rateModal">Rate Order</button>
                        <button type="button" class="btn btn-primary" fdprocessedid="kyrfo" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-ocomp">View Details</button>

                    </div>
                </td>
            </tr>
        </table>

        <table id="denTab">
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Denied</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>XS</td>
                            <td>1</td>
                            <td>P1,200.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P1200.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button type="button" class="btn btn-primary" fdprocessedid="kyrfo" data-bs-toggle="modal" data-bs-target="#orderDetailsModal-den">View Details</button>

                    </div>
                </td>
            </tr>
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Denied</button>
                        </div>
                        <div class="item-img"></div>
                        <table class="dets">
                            <tr>
                                <th>Item</th>
                                <th>Category</th>
                                <th>Variant/Size</th>
                                <th>Quantity</th>
                                <th>Price</th>
                        </tr>
                        <tr>    
                            <td>Merch</td>
                            <td>T-Shirt</td>
                            <td>M</td>
                            <td>1</td>
                            <td>P100.00</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">P100.00</p>
                        <p class="itemLab">Item(s): </p>
                        <p class="itemCount">1</p>
                        <p class="dateLabel">Date: </p>
                        <p class="date">08-10-2024</p>
                        <p class="time">12:51 am</p>
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
        </table>
    </div>

        <!-- added -->
    <div class="modal fade" id="orderDetailsModal-pen" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                Circle of Unified Information Technology Students (CIRCUITS)
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
                                        <td>Merch</td>
                                        <td>T-Shirt</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>P2.00</td>
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
                                        <td>Merch</td>
                                        <td>T-Shirt</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>P2.00</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr class="modal-rows">
                            <td class="modal-td">
                                <div class="img-holder">
                                    <img src="{{ asset('images/manok.jpg') }}" class="logo-img" style="width: 100%; height: 100%">
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
                    <p>P1402.00</p>
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
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary">Contact Seller</button>
            </div>
            </div>
        </div>
    </div>
    <!-- added -->
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
                                        <td>Merch</td>
                                        <td>T-Shirt</td>
                                        <td>Small</td>
                                        <td>1</td>
                                        <td>P2.00</td>
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
                    <p>P2.00</p>
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
                    <p>1</p>
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

    <div class="modal fade" id="orderDetailsModal-fpick" tabindex="-1" aria-labelledby="orderDetailsLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
            <!-- Modal Header -->
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-header">
                <img src="{{ asset('images/Circuits.svg') }}" alt="Toggle navigation" style="width: 24px; height: 24px;">
                <h5 class="modal-title" id="orderDetailsLabel">
                    Circle of Unified Information Technology Students (CIRCUITS)
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
                                        <td>ID lanyard</td>
                                        <td>Lanyard</td>
                                        <td>Pink</td>
                                        <td>1</td>
                                        <td>P100.00</td>
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
                    <p>P100.00</p>
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
                    <p>1</p>
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
                                        <td>T-Shirt</td>
                                        <td>Catergory Name</td>
                                        <td>Variant/SizeValue</td>
                                        <td>Quantity Value</td>
                                        <td>Price Value</td>
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
                    <p>Price Value</p>
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
                    <p>1</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal" id="rate-order">Rate Order</button>
            </div>
            </div>
        </div>
    </div>

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
                                        <td>Merch</td>
                                        <td>T-Shirt</td>
                                        <td>XS</td>
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
                    <p>P1200.00</p>
                    <p>GCASH</p>
                    <p>screenshot101.jpeg</p>
                    <p>901234871</p>
                </div>
                <div class="transact-col3">
                    <p>Date:</p>
                    <p>Time:</p>
                    <p>Item(s):</p>
                    <p>Reason: </p>
                </div>
                <div class="transact-col4">
                    <p>08-10-24</p>
                    <p>12:51am</p>
                    <p>1</p>
                    <p>Insufficient Payment</p>
                </div>
            </div>
            <!-- Modal Footer -->
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" >Contact Seller</button>
            </div>
            </div>
        </div>
    </div>

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
</body>

</html>