<!-- Extension of the main app where the structured html resides -->
@extends('layouts.app')

@section('content')

<div class="container my-5">
    <div class="row justify-content-start">
        <!-- Container of the two contents on the left side which are the headers and the button -->
        <div class="col-md-5 customer-container">
            <div class="faq-header">
                <!-- Main Heading -->
                <h2 class="display-5 text-left fw-bolder text-primary">CSians'</h2>
                <!-- Sub Heading -->
                <h2 class="display-5 text-left custom-width-h2 text-primary fw-bold">Most <span class="text-secondary fw-bold">Frequently Asked Questions</span> </h2>
            </div>
            <div class="faq-section mt-3 d-inline-flex border justify-content-center" style="gap: 20px; border-radius: 4px;">
                <!-- FAQ Button -->
                <a href="{{ route('chat') }}" class="d-flex justify-content-center align-items-center my-3">
                    <img src="{{ asset('images/support.svg') }}" alt="Support" style="width: 32px; height: 32px;">
                </a>
                <p class="d-flex justify-content-center align-items-center custom-width-p">Couldn't find your concern? Chat with us!</p>

            </div>  
        </div>
        <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
        <div class="col-md-7">
            <div class="accordion" id="accordionExample">
                <!-- FAQ 1 -->
                <div class="accordion-item" id="accordionExample">
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

            <div class="accordion my-4">
                <!-- FAQ 2 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingTwo">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                            <strong>FAQ 2</strong>
                        </button>
                    </h2>
                    <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion my-4">
                <!-- FAQ 3 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingThree">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                            <strong>FAQ 3</strong>
                        </button>
                    </h2>
                    <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion my-4">
                <!-- FAQ 4 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFour">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                            <strong>FAQ 4</strong>
                        </button>
                    </h2>
                    <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                        </div>
                    </div>
                </div>
            </div>
            <div class="accordion my-4">
                <!-- FAQ 5 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingFive">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFive" aria-expanded="false" aria-controls="collapseFive">
                            <strong>FAQ 5</strong>
                        </button>
                    </h2>
                    <div id="collapseFive" class="accordion-collapse collapse" aria-labelledby="headingFive" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                        </div>
                    </div>
                </div>
            </div>

            <div class="accordion my-4">
                <!-- FAQ 6 -->
                <div class="accordion-item">
                    <h2 class="accordion-header" id="headingSix">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSix" aria-expanded="false" aria-controls="collapseSix">
                            <strong>FAQ 6</strong>
                        </button>
                    </h2>
                    <div id="collapseSix" class="accordion-collapse collapse" aria-labelledby="headingSix" data-bs-parent="#accordionExample">
                        <div class="accordion-body">
                            Lorem ipsum dolor sit amet consectetur. Fusce ullamcorper vitae purus at. Congue auctor gravida sagittis quis odio. Mauris feugiat viverra eros a eget.
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection