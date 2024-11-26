@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')

    <!-- Welcome Message Below Navbar -->
    <div class="container">
        <div class="row align-items-center justify-content-center my-4 ms-4 me-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="me-auto">Deleted Section</h1>
                </div>

                <div class="d-flex">
                    <button class="btn new p-1 me-4 d-flex align-items-center justify-content-center border">
                        <img src="{{asset('images/retrieve.svg')}}" alt="Add" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                        Retrieve
                    </button>
                    <button class="btn btn-danger p-1 me-2 d-flex align-items-center justify-content-center" style="width: 130px; border-radius: 6px;">
                        <img src="{{asset('images/delete1.svg')}}" alt="Add" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                        Delete
                    </button>
                </div>
            </div>

        
            <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
            <div class="mt-4">
                <div class="accordion border" id="accordionExample">
                    <div class="d-flex align-items-center border: none;">
                        <!-- Icons Section -->
                        <div class="icon-container d-flex align-items-center me-3">
                            <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                <h1 class="fs-5 fw-bold text-align-center" style="margin: 0">Q1</h1>
                            </div>               
                        </div>


                        <!-- Accordion Section -->
                        <div class="accordion-item w-100 border">
                            <h2 class="accordion-header" id="headingOne">
                                <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                    <strong>How can I get a refund?</strong>
                                </button>
                            </h2>
                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                <div class="accordion-body">
                                    Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion my-4">
                    <div class="accordion border" id="accordionExample1">
                        <div class="d-flex align-items-center border: none;">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    <h1 class="fs-5 fw-bold" style="text-align: center; margin: 0;">Q2</h1>
                                </div>               
                            </div>


                            <!-- Accordion Section -->
                            <div class="accordion-item w-100 border">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
                                        <strong>How can I get a refund?</strong>
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample1">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion my-4">
                    <div class="accordion border" id="accordionExample2">
                        <div class="d-flex align-items-center border: none;">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    <h1 class="fs-5 fw-bold" style="text-align: center; margin: 0;">Q3</h1>
                                </div>                  
                            </div>


                            <!-- Accordion Section -->
                            <div class="accordion-item w-100 border">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="true" aria-controls="collapseThree">
                                        <strong>How can I get a refund?</strong>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample2">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="accordion my-4">
                    <div class="accordion border" id="accordionExample3">
                        <div class="d-flex align-items-center border: none;">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    <h1 class="fs-5 fw-bold" style="text-align: center; margin: 0;">Q4</h1>
                                </div>                  
                            </div>


                            <!-- Accordion Section -->
                            <div class="accordion-item w-100 border">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="true" aria-controls="collapseFour">
                                        <strong>How can I get a refund?</strong>
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample3">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="accordion my-4">
                    <div class="accordion border" id="accordionExample4">
                        <div class="d-flex align-items-center border: none;">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    <h1 class="fs-5 fw-bold" style="text-align: center; margin: 0;">Q5</h1>
                                </div>                
                            </div>


                            <!-- Accordion Section -->
                            <div class="accordion-item w-100 border">
                                <h2 class="accordion-header" id="headingFive">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="true" aria-controls="collapseFive">
                                        <strong>How can I get a refund?</strong>
                                    </button>
                                </h2>
                                <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample4">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                
                <div class="accordion my-4">
                    <div class="accordion border" id="accordionExample5">
                        <div class="d-flex align-items-center border: none;">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2" > 
                                    <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                </div>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    <h1 class="fs-5 fw-bold" style="text-align: center; margin: 0;">Q6</h1>
                                </div>                
                            </div>


                            <!-- Accordion Section -->
                            <div class="accordion-item w-100 border">
                                <h2 class="accordion-header" id="headingSix">
                                    <button class="accordion-button" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="true" aria-controls="collapseSix">
                                        <strong>How can I get a refund?</strong>
                                    </button>
                                </h2>
                                <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample5">
                                    <div class="accordion-body">
                                        Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>
@endsection
