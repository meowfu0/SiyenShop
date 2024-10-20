@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    <div class="border-bottom d-flex align-items-center justify-content-end" style="height: 80px;">
        <div class="d-flex gap-2 pe-5">
            <img src="{{asset('images/user.svg')}}" alt="">
            @auth
            <div class="text-primary fw-medium d-none d-md-block">
                {{ Auth::user()->first_name }}
            </div>
            @endauth
        </div>
    </div>

    <!-- Welcome Message Below Navbar -->
    <div class="container">
        <div class="row align-items-center justify-content-center my-4 ms-4 me-4">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <h1 class="me-auto">FAQs Section</h1>
                </div>

                <div class="d-flex">
                    <button class="btn new p-1 me-4 d-flex align-items-center justify-content-center border" data-bs-toggle="modal" data-bs-target="#newModalCenter">
                        <img src="{{asset('images/add.svg')}}" alt="Add" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                        New
                    </button>

                    <a class="btn delete btn-primary ps-4 d-flex gap-2 align-items-center justify-content-center {{ Route::currentRouteName() == 'admin.faqs-deleted' ? 'active' : '' }}"
                        href="{{ route('admin.faqs-deleted') }}" wire:navigate>
                        <img src="{{ asset('images/delete1.svg') }}" alt="">
                        Deleted
                    </a>
                    <!--<button class="btn btn-primary p-1 me-2 d-flex align-items-center justify-content-center"
                        onclick="showDeleted()"
                        style="width: 130px; border-radius: 6px;">
                    <img src="{{ asset('images/delete1.svg') }}" alt="Deleted" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                    Delete -->
                </div>
            </div>


            <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
            <div class="mt-4">
                <div class="accordion border" id="accordionExample">
                    <div class="d-flex align-items-center border: none;">
                        <!-- Icons Section -->
                        <div class="icon-container d-flex align-items-center me-3">
                            <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter">
                                    <img src="{{asset('images/hide.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter">
                                    <img src="{{asset('images/edit.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                                    <img src="{{asset('images/delete.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
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
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter">
                                        <img src="{{asset('images/hide.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter">
                                        <img src="{{asset('images/edit.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                                        <img src="{{asset('images/delete.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
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
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter">
                                        <img src="{{asset('images/hide.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter">
                                        <img src="{{asset('images/edit.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                                        <img src="{{asset('images/delete.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
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
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter">
                                        <img src="{{asset('images/hide.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter">
                                        <img src="{{asset('images/edit.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                                        <img src="{{asset('images/delete.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
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
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter">
                                        <img src="{{asset('images/hide.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter">
                                        <img src="{{asset('images/edit.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                                        <img src="{{asset('images/delete.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
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
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter">
                                        <img src="{{asset('images/hide.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter">
                                        <img src="{{asset('images/edit.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
                                    <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter">
                                        <img src="{{asset('images/delete.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                    </button>
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
            <div>
                <!-- Modal for adding new FAQ -->
                <div class="modal fade" id="newModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 650px;">
                        <di class="modal-content " style="height: 35rem;">
                            <div class="modal-header d-flex justify-content-center" style="border: none;">
                                <h5 class="modal-title d-flex text-align-center" id="exampleModalLongTitle">New FAQ</h5>

                            </div>
                            <div class="modal-body mx-4">
                                <label for="">Question</label>
                                <input type="text" class="form-control p-4" placeholder="">

                                <label for="">Answer</label>
                                <input type="text" class="form-control d-flex h-50" placeholder="">
                            </div>
                            <div class="modal-footer mx-4" style="border: none;">
                                <button type="button" class="btn border" data-dismiss="modal" style="width: 111px;">Close</button>
                                <button type="button" class="btn btn-primary" style="width: 111px;">Save </button>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Modal for editing FAQ -->
            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 650px;">
                    <di class="modal-content " style="height: 35rem;">
                        <div class="modal-header d-flex justify-content-center" style="border: none;">
                            <h5 class="modal-title d-flex text-align-center" id="exampleModalLongTitle">Edit FAQ</h5>

                        </div>
                        <div class="modal-body mx-4">
                            <label for="">Question</label>
                            <input type="text" class="form-control p-4" placeholder="">

                            <label for="">Answer</label>
                            <input type="text" class="form-control d-flex h-50" placeholder="">
                        </div>
                        <div class="modal-footer mx-4" style="border: none;">
                            <button type="button" class="btn border" data-dismiss="modal" style="width: 111px;">Close</button>
                            <button type="button" class="btn btn-primary" style="width: 111px;">Save </button>
                        </div>
                </div>
            </div>
        </div>

        <!-- Modal to hide FAQ-->
        <div class="modal fade" id="hideModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="height: 15rem;">
                    <div class="modal-header" style="border: none;">

                   
                    </div>
                    <div class="modal-body mx-2 d-flex justify-content-center align-items-center" style="height: 100%;">
                        <h4 class="text-center">Are You Sure You Want To Hide This? This Action Will Hide The FAQs To Users.</h4>
                    </div>

                    <div class="modal-footer mx-2" style="border: none;">
                        <button type="button" class="btn border" data-dismiss="modal" style="width: 111px;">Close</button>
                        <button type="button" class="btn btn-primary" style="width: 111px;">Save </button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Modal to delete FAQ-->
        <div class="modal fade" id="deleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="height: 15rem;">
                    <div class="modal-header" style="border: none;">

                   
                    </div>
                    <div class="modal-body mx-2 d-flex justify-content-center align-items-center" style="height: 100%;">
                        <h4 class="text-center">Are You Sure You Want To Delete This?</h4>
                    </div>

                    <div class="modal-footer mx-2" style="border: none;">
                        <button type="button" class="btn border" data-dismiss="modal" style="width: 111px;">Close</button>
                        <button type="button" class="btn btn-primary" style="width: 111px;">Save </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

</div>
@endsection