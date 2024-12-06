@extends('layouts.admin')

@section('content')
<div class="flex-grow-1" style="width: 100%!important;">
    <!-- Top Navbar -->
    @include('components.profilenav')



    <!-- Welcome Message Below Navbar -->
    <div class="container">
        <div class="row align-items-center justify-content-center my-4 ms-4 me-4" id="faqs">
            <div class="d-flex justify-content-between align-items-center sticky-top bg-white" style="z-index: 1050; top: 80px; height: 100px;">
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
                </div>
            </div>


            <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
            @foreach ($faqs->where('status_id', 1) as $index => $faq)
            <div class="mt-4">
                <div class="accordion border" id="accordionExample">
                    <div class="d-flex align-items-center border: none;">
                        <!-- Icons Section -->
                        <div class="icon-container d-flex align-items-center me-3">
                            <div class="d-flex align-items-center justify-content-center" style="border: none;">
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#hideModalCenter" data-faq-id="{{ $faq->id }}">
                                    <img src="{{ asset('images/hide.svg') }}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
                                <button class="btn p-0" data-bs-toggle="modal" 
                                        data-bs-target="#editModalCenter" 
                                        data-question="{{ $faq->questions }}" 
                                        data-answer="{{ $faq->answers }}" 
                                        aria-expanded="false" 
                                        data-id="{{ $faq->id }}">
                                    <img src="{{ asset('images/edit.svg') }}" alt="Edit" class="me-2 justify-content-center d-flex">
                                </button>
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter" data-faq-id="{{ $faq->id }}">
                                    <img src="{{ asset('images/delete.svg') }}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 justify-content-center d-flex">
                                <h1 class="fs-5 fw-bold text-align-center" style="margin: 0">Q{{ $loop->iteration }}</h1>
                            </div>
                        </div>

                        <!-- Accordion Section -->
                        <div class="accordion-item w-100 border z-negative">
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
                                    {!! $faq->answers !!}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                </div>
            <div>
            @endforeach

            <div style="height: 2rem;">
            </div>
            <!-- Container of the hidden FAQs containing questions and answers using bootstrap accordion -->
            @foreach ($faqs->where('status_id', 3) as $index => $faq)
                <div class="mt-4">
                    <div class="accordion border border-danger" id="accordionExample">
                        <div class="d-flex align-items-center">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#showModalCenter" data-faq-id="{{ $faq->id }}">
                                        <img src="{{ asset('images/Invisible.svg') }}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#editModalCenter" 
                                        data-question="{{ $faq->questions }}" 
                                        data-answer="{{ $faq->answers }}" 
                                        data-id="{{ $faq->id }}">
                                    <img src="{{ asset('images/edit.svg') }}" alt="Edit" class="me-2 d-flex">
                                </button>
                                <button class="btn p-0" data-bs-toggle="modal" data-bs-target="#deleteModalCenter" data-faq-id="{{ $faq->id }}">
                                    <img src="{{ asset('images/delete.svg') }}" alt="Hide" class="me-2 justify-content-center d-flex">
                                </button>
                                <img src="{{asset('images/line.svg')}}" alt="Hide" class="me-2 d-flex">
                                <h1 class="fs-5 fw-bold text-center">Q{{ $loop->iteration }}</h1>
                            </div>

                            <!-- Accordion Section -->
                            <div class="accordion-item w-100">
                                <h2 class="accordion-header" id="heading{{ $faq->id }}">
                                    <button class="accordion-button collapsed border-0" 
                                        type="button" 
                                        data-bs-toggle="collapse" 
                                        data-bs-target="#collapse{{ $faq->id }}" 
                                        aria-expanded="true" 
                                        aria-controls="collapse{{ $faq->id }}">
                                        <strong>{{ $faq->questions }}</strong>
                                    </button>
                                </h2>
                                <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" 
                                    aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        {!! $faq->answers !!}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <div>
            @endforeach

                <!-- Modal for adding new FAQ -->
                <div class="modal fade" id="newModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 650px;">
                        <di class="modal-content " style="height: 35rem;">
                            <div class="modal-header d-flex justify-content-center" style="border: none;">
                                <h5 class="modal-title d-flex text-align-center" id="exampleModalLongTitle" style="font-size: 1.2rem; font-weight: bold; margin-top: 1rem">New FAQ</h5>

                            </div>
                            <div class="modal-body flex-column mx-4">
                                <div style="text-align: left; width: 99%;">
                                    <label for="question" class="pt-3 pb-3" style="padding-left: 0;">Question</label>
                                </div>
                                <input type="text" name="question" class="form-control p-4" placeholder="" required>

                                <div style="text-align: left; width: 99%;">
                                    <label for="answer" class="pt-3 pb-3" style="padding-left: 0;">Answer</label>
                                </div>
                                <textarea name="answer" id="answer" rows="4" required></textarea>
                            </div>
                            <div class="modal-footer mx-4" style="border: none;">
                                <button type="button" id="closeButton" class="btn border" data-dismiss="modal" style="width: 111px;" onclick="hideModal('newModalCenter')">Close</button>
                                <button type="button" id="saveButton" class="btn btn-primary" style="width: 111px;">Save</button>
                            </div>
                    </div>
                </div>
            </div>

            <!-- Modal for editing FAQ -->
            <div class="modal fade" id="editModalCenter" tabindex="-1" role="dialog" aria-labelledby="editModalCenterTitle" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document" style="max-width: 650px;">
                    <div class="modal-content" style="height: 35rem;">
                        <div class="modal-header d-flex justify-content-center" style="border: none;">
                            <h5 class="modal-title" id="editModalCenterTitle" style="font-size: 1.2rem; font-weight: bold; margin-top: 1rem">Edit FAQ</h5>
                        </div>
                        <div class="modal-body flex-column mx-4">
                            <div style="text-align: left; width: 99%;">
                                <label for="editQuestion" class="pt-3 pb-3" style="padding-left: 0;">Question</label>
                            </div>
                            <input type="text" name="question" id="editQuestion" class="form-control p-4" placeholder="" required>

                            <div style="text-align: left; width: 99%;">
                                <label for="editAnswer" class="pt-3 pb-3" style="padding-left: 0;">Answer</label>
                            </div>
                            <textarea name="answer" id="editAnswer"  rows="4" required></textarea>
                        </div>

                        <div class="modal-footer mx-4" style="border: none;">
                            <button type="button" id="closeEdit" class="btn border" data-dismiss="modal" style="width: 111px;" onclick="hideModal('editModalCenter')">Close</button>
                            <button type="button" id="saveEdit" class="btn btn-primary" style="width: 111px;">Save</button>
                        </div>
                    </div>
                </div>
            </div>

        </div>

        <!-- Modal to hide FAQ-->
        <div class="modal fade" id="hideModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="height: 22rem;">
                    <div class="modal-header d-flex justify-content-center" style="border: none;">
                        <h5 class="modal-title" id="" style="font-size: 1.2rem; font-weight: bold; padding: 2rem;">Hide FAQ</h5>
                    </div>
                    <div class="modal-body mx-2 d-flex justify-content-center align-items-center">
                        <h4 class="text-center" style="width: 25rem; font-weight: 400;">Are You Sure You Want To Hide This? This Action Will Hide The FAQs To Users.</h4>
                    </div>
                    <div class="modal-footer mx-2 d-flex justify-content-center" style="border: none; padding: 3rem;">
                        <button type="button" class="btn border" data-bs-dismiss="modal" style="width: 111px;">Close</button>
                        <button type="button" class="btn btn-primary" style="width: 111px;" id="saveHideBtn">Save</button>
                    </div>
                </div>
            </div>
        </div>

       <!-- Modal to show FAQ-->
        <div class="modal fade" id="showModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content" style="height: 22rem;">
                    <div class="modal-header d-flex justify-content-center" style="border: none;">
                        <h5 class="modal-title" id="" style="font-size: 1.2rem; font-weight: bold; padding: 2rem;">Show FAQ</h5>
                    </div>
                    <div class="modal-body mx-2 d-flex justify-content-center align-items-center">
                        <h4 class="text-center" style="width: 25rem; font-weight: 400;">Are You Sure You Want To Show This? This Action Will Show The FAQs To Users.</h4>
                    </div>
                    <div class="modal-footer mx-2 d-flex justify-content-center" style="border: none; padding: 3rem;">
                        <button type="button" class="btn border" data-bs-dismiss="modal" style="width: 111px;">Close</button>
                        <button type="button" class="btn btn-primary" style="width: 111px;" id="saveShowBtn">Save</button>
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
                            <button type="button" class="btn border" data-bs-dismiss="modal" style="width: 111px;">Close</button>
                            <button type="button" class="btn btn-primary" style="width: 111px;" id="saveDelBtn">Save </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

</div>
@endsection

<script src="https://cdn.ckeditor.com/ckeditor5/38.1.0/classic/ckeditor.js"></script>
