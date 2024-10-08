<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/purchase.css') }}" rel="stylesheet">

    <script src="{{ asset('js/switchStat.js') }}"></script>


</head>
<body>
    <div>
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
                            
                            <td>Peter Sweat</td>
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
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
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
                            
                            <td>Biology Student</td>
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
                            
                            <td>Peter Sweat</td>
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
                            <td>Guinobatan Biokid</td>
                            <td>Student</td>
                            <td>Chinita</td>
                            <td>1</td>
                            <td>Secret</td>
                        </tr>
                    </table>
                    <div class="other-content-low">
                        <h5>TOTAL: </h5>
                        <p class="costPrice">Secret</p>
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
                            <td>Peter Sweat</td>
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
                            <td>Peter Sweat</td>
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
                            <td>Peter Sweat</td>
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
                            <td>Peter Sweat</td>
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
                            <td>Peter Sweat</td>
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
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
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
                            <td>Peter Sweat</td>
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
                            <td>Peter Sweat</td>
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
                        <button class="btn btn-light" fdprocessedid="wsfgm">Contact Seller</button>
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
                    </div>
                </td>
            </tr>
        </table>

        <table id="denTab">
            <tr>
                <td>
                <div class="other-content-high">
                            <button class="shopName">CIRCUITS</button>
                            <button class="status-box">Denied : Hakot</button>
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
                            <td>Frank Ocean Unreleased Album</td>
                            <td>Music</td>
                            <td>Vynil Record</td>
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
                        <button class="btn btn-primary" fdprocessedid="kyrfo">View Details</button>
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
                            <td>Pritong Burog</td>
                            <td>Food</td>
                            <td>Ewan</td>
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
</body>
</html>