<div class="flex-grow-1" style="width: 100%!important;">
    @include('components.profilenav')
    <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3" >
            <img src="{{ asset('images/' . $shopInfo->shop_logo) }}" alt="" style="height: 30px; width:30px" >
        </div>
        <h2 class="fw-bold m-0 text-primary"> {{$shopInfo->shop_name }} </h2>
    </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Sales Analytics</h2>
        <div class="d-flex align-items-center gap-2">
            <p class="fs-3 fw-medium m-0 text-primary text-nowrap">Filter Date</p>
            <div id="reportrange" class="border border-primary rounded-2" style="background: #fff; cursor: pointer; padding: 5px 10px; width: 100%">
                <i class="fa fa-calendar"></i>&nbsp;
                <span> {{$startDate." - ". $endDate}} </span> <i class="fa fa-caret-down"></i>
            </div>
            
        </div>
    </div>

    <div class="d-flex gap-4 px-5">
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Gross Sales</h4>
            <h3 class="text-primary fw-bolder">P {{ $Totals['total_amount'] }}</h3>

        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Profits</h4>
            <h3 class="text-primary fw-bolder">P {{ $Totals['profits'] }}</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Orders</h4>
            <h3 class="text-primary fw-bolder"> {{ $orderCount}} </h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Total Orders</h4>
            <h3 class="text-primary fw-bolder"> {{$allOrdersCount}} </h3>
        </div>
    </div>


    <div class="d-flex px-5 py-4 gap-4 flex-grow-1 " style="max-height: 60%">
        <div class=" border border-primary rounded-4 p-4 " style="flex:4;">
            <div class="d-flex justify-content-between">
                <h4 class="text-secondary fw-bold">Recent Orders</h4>
                <a href="{{ route('shop.orders') }}" class="text-secondary">See all</a>
            </div>
            <div>
                <table class="table table-hover  table-borderless">
                    <thead>
                        <tr>
                            <th scope="col">Order Number</th>
                            <th scope="col">Name</th>
                            <th scope="col">Course</th>
                            <th scope="col">Item(s)</th>
                            <th scope="col">Total</th>

                        </tr>
                    </thead>
                    <tbody>
                        @foreach ( $recentOrders as $order )
                        <tr>
                            <td> {{$order->id}} </td>
                            <td>{{$order->user_fname . " " . $order->user_lname}}</td>
                            <td>{{$order->course}}</td>
                            <td>{{$order->total_items}}</td>
                            <td>{{$order->total_amount}}</td>
                        </tr>
                        @endforeach
                      
                        

                    </tbody>
                </table>
            </div>
        </div>

        <div class="d-flex flex-column gap-4 " style="flex:3; ">
            <div class="border border-primary rounded-4 p-4 flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h4 class="text-secondary fw-bold">Unverified Payments</h4>
                    <a href="{{ route('shop.orders') }}" class="text-secondary">See all</a>
                </div>
                <div>
                    <table class="table table-hover  table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Order No.</th>
                                <th scope="col">Name</th>
                                <th scope="col">Referene No.</th>

                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>09102024001</td>
                                <td>John Robert Rodejo</td>
                                <td>536754683287432</td>
                            </tr>
                            <tr>
                                <td>09102024001</td>
                                <td>Ian AGbriel Villame</td>
                                <td>536754683287432</td>
                            </tr>
                            <tr>
                                <td>09102024001</td>
                                <td>Vicente Bercasio</td>
                                <td>536754683287432</td>
                            </tr>
                            <tr>
                                <td>09102024001</td>
                                <td>Archie Onoya</td>
                                <td>536754683287432</td>
                            </tr>
                        </tbody>
                    </table>
                </div>

            </div>

            <div class="border border-primary rounded-4 p-4 flex-grow-1">
                <div class="d-flex justify-content-between">
                    <h4 class="text-secondary fw-bold">Stock Alert</h4>
                    <a href="{{ route('shop.products') }}" class="text-secondary">See all</a>
                </div>
                <div style="max-height: 300px; overflow-y: auto;">
                @if($lowStockProducts->isEmpty())
                <table class="table table-borderless">
                        <th>There are no low stock products at the moment.</th>
                </table>
                @else
                    <table class="table table-hover  table-borderless">
                        <thead>
                            <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Stock</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($lowStockProducts as $product)
                                <tr>
                                    <td>{{ $product->product_name }}</td>
                                    <td>{{ $product->stocks }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endif
                </div>

            </div>

        </div>
    </div>
</div>