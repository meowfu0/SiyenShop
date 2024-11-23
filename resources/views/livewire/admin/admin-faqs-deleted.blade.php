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
                    <!-- Retrieve Form -->
                    <form id="retrieveForm">
                        @csrf
                        <input type="hidden" name="faq_ids" id="retrieveFaqIds">
                        <button type="button" class="btn new p-1 me-4 d-flex align-items-center justify-content-center border" id="retrieveBtn">
                            <img src="{{ asset('images/retrieve.svg') }}" alt="Retrieve" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                            Retrieve 
                        </button>
                    </form>

                    <!-- Delete Form -->
                    <form id="deleteForm">
                        @csrf
                        <input type="hidden" name="faq_ids" id="deleteFaqIds">
                        <button type="button" class="btn btn-danger p-1 me-2 d-flex align-items-center justify-content-center" id="deleteBtn" style="width: 130px; border-radius: 6px;">
                            <img src="{{ asset('images/delete1.svg') }}" alt="Delete" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                            Delete
                        </button>
                    </form>
                </div>
            </div>

            <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
            @foreach ($faqs as $index => $faq)
                <div class="mt-4">
                    <div class="accordion border" id="accordionExample">
                        <div class="d-flex align-items-center">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2"> 
                                        <input class="form-check-input faq-checkbox" type="checkbox" value="{{ $faq->id }}" id="flexCheckDefault{{ $faq->id }}" onchange="updateSelectedIds()"> 
                                    </div>
                                    <img src="{{ asset('images/line.svg') }}" alt=" Hide" class="me-2">
                                    <h1 class="fs-5 fw-bold" style="margin: 0">Q{{ $loop->iteration }}</h1>
                                </div>               
                            </div>

                            <!-- Accordion Section -->
                            <div class="accordion-item w-100 border">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button border-0 collapsed" 
                                            type="button" 
                                            data-bs-toggle="collapse" 
                                            data-bs-target="#collapse{{ $faq->id }}" 
                                            aria-expanded="false" 
                                            aria-controls="collapse{{ $faq->id }}">
                                        <strong>{{ $faq->questions }}</strong>
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" 
                                     aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {{ $faq->answers }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>

<!-- Modal for no checkbox selected warning -->
<div class="modal fade" id="noCheckboxModal" tabindex="-1" role="dialog" aria-labelledby="noCheckboxModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="noCheckboxModalTitle" style="font-size: 1.2rem; font-weight: bold;">Warning</h5>
            </div>
            <div class="modal-body mx-2 d-flex justify-content-center align-items-center">
                <h4 class="text-center" style="width: 25rem; font-weight: 400;">You should select a FAQ</h4>
            </div>
            <div class="modal-footer mx-2 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for delete confirmation -->
<div class="modal fade" id="PdeleteModalCenter" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="height: 22rem;">
            <div class="modal-header d-flex justify-content-center" style="border: none;">
                <h5 class="modal-title" style="font-size: 1.2rem; font-weight: bold; padding: 2rem;">DELETE FAQ</h5>
            </div>
            <div class="modal-body mx-2 d-flex justify-content-center align-items-center">
                <h4 class="text-center" style="width: 25rem; font-weight: 400;">Are You Sure You Want To Permanently Delete This? This Action Can't Be Undone.</h4>
            </div>
            <div class="modal-footer mx-2 d-flex justify-content-center" style="border: none; padding: 3rem;">
                <button type="button" class="btn border" data-bs-dismiss="modal" style="width: 111px;">Close</button>
                <button type="button" class="btn btn-primary" style="width: 111px;" id="savePDelBtn">Delete</button>
            </div>
        </div>
    </div>
</div>

<!-- Modal for retrieve confirmation -->
<div class="modal fade" id="retrieveModal" tabindex="-1" role="dialog" aria-labelledby="retrieveModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content" style="height: 18rem;">
            <div class="modal-header d-flex justify-content-center" style="border: none;">
                <h5 class="modal-title" id="retrieveModalLabel" style="font-size: 1.2rem; font-weight: bold;">Retrieve FAQ</h5>
            </div>
            <div class="modal-body mx-2 d-flex justify-content-center align-items-center">
                <h4 class="text-center" style="width: 25rem; font-weight: 400;">Are you sure you want to retrieve this FAQ? This action will restore the selected FAQs for users to see.</h4>
            </div>
            <div class="modal-footer mx-2 d-flex justify-content-center" style="border: none;">
                <button type="button" class="btn border" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="confirmRetrieveBtn">Retrieve</button>
            </div>
        </div>
    </div>
</div>
@endsection
