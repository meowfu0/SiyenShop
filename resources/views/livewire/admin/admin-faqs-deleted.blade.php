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
                        <img src="{{ asset('images/retrieve.svg') }}" alt="Retrieve" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                        Retrieve
                    </button>
                    <button class="btn btn-danger p-1 me-2 d-flex align-items-center justify-content-center" style="width: 130px; border-radius: 6px;">
                        <img src="{{ asset('images/delete1.svg') }}" alt="Delete" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                        Delete
                    </button>
                </div>
            </div>

            <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
            @foreach ($faqs->where('status_id', 4) as $index => $faq)
                <div class="mt-4">
                    <div class="accordion border" id="accordionExample">
                        <div class="d-flex align-items-center">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="d-flex align-items-center justify-content-center">
                                    <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2"> 
                                        <input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">  
                                    </div>
                                    <img src="{{ asset('images/line.svg') }}" alt="Hide" class="me-2">
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
@endsection
