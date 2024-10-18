@extends('layouts.shop')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
     <div class="border-bottom d-flex align-items-center justify-content-end " style="height: 80px; ">
        <div class="d-flex gap-2 pe-5">
            <img src="{{asset('images/user.svg')}}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
               
            </div>
            @endauth
        </div>
     </div>
     <div class="d-flex border-bottom gap-3 ps-5 align-items-center" style="height:70px">
        <div class="ps-3">
            <img src="{{asset('images/Circuits.svg')}}" alt="">
        </div>
        <h2 class="fw-bold m-0 text-primary">Circle of Unified Information Technology Students </h2>
     </div>

    <div class="d-flex justify-content-between px-5 py-3">
        <h2 class="fw-bold m-0 text-primary">Sales Analytics</h2>
        <div class="d-flex align-items-center gap-2">
            <p class="fs-3 fw-medium m-0 text-primary">Filter Date</p>
            <input type="date" class="border border-primary rounded-2 p-2 text-primary">
        </div>
    </div>
    
    <div class="d-flex gap-4 px-5">
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Gross Sales</h4>
            <h3 class="text-primary fw-bolder">P 99,999.00</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Net Income</h4>
            <h3 class="text-primary fw-bolder">P 99,999.00</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Orders</h4>
            <h3 class="text-primary fw-bolder">P 99,999.00</h3>
        </div>
        <div class="border border-primary rounded-4 p-4 flex-grow-1">
            <h4 class="text-secondary fw-bold">Total Orders</h4>
            <h3 class="text-primary fw-bolder">P 99,999.00</h3>
        </div>
    </div>
  
  
    <div class="d-flex px-5 py-4 gap-4 flex-grow-1 " style="max-height: 60%">
        <div class=" border border-primary rounded-4 p-4 " style="flex:4;">
             <div class="d-flex justify-content-between">
                <h4 class="text-secondary fw-bold">Recent  Orders</h4>
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
                      <tr>
                        <td>09102024001</td>
                        <td>Ian Gabriel Villame</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Vicente Bercasio</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Archie Onoya</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>John Robert Rodejo</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>John Dave Banas</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Jay Bombales</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Jucel Christopher</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Adornado Cabalbag</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Danielle Rubis</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Shakira Regalado</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Ron Peter Mortega</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>
                      <tr>
                        <td>09102024001</td>
                        <td>Mark James Barreda</td>
                        <td>BSIT</td>
                        <td>3</td>
                        <td>P 750.00</td>
                      </tr>

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
    
                <div class="border border-primary rounded-4 p-4 flex-grow-1" >
                    <div class="d-flex justify-content-between">
                        <h4 class="text-secondary fw-bold">Stock Alert</h4>
                        <a href="{{ route('shop.products') }}" class="text-secondary">See all</a>
                    </div>
                    <div>
                        <table class="table table-hover  table-borderless">
                            <thead>
                              <tr>
                                <th scope="col">Product Name</th>
                                <th scope="col">Stock</th>
                              </tr>
                            </thead>
                            <tbody>
                              <tr>
                                <td>Circuits Tshirt (Black)</td>
                                <td>10</td>
                              </tr>
                              <tr>
                                <td>Circuits Tshirt (Black)</td>
                                <td>10</td>
                              </tr>
                              <tr>
                                <td>Circuits Tshirt (Black)</td>
                                <td>10</td>
                              </tr>
                            </tbody>
                          </table>
                    </div>
                    
                </div>
                
            </div>
        </div>
</div>

@endsection
