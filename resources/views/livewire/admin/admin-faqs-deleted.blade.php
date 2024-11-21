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
                    <button class="btn btn-danger p-1 me-2 d-flex align-items-center justify-content-center" 
                        style="width: 130px; border-radius: 6px;" 
                        id="deleteBtn">
                        <img src="{{ asset('images/delete1.svg') }}" alt="Delete" class="me-2" style="margin: 0; height: 13px; width: 13px;">
                        Delete
                    </button>
                </div>
            </div>

            <!-- FAQs Accordion -->
            @foreach ($faqs->where('status_id', 4) as $index => $faq)
                <div class="mt-4 faq-item" id="faqItem{{ $faq->id }}">
                    <div class="accordion border" id="accordionExample">
                        <div class="d-flex align-items-center">
                            <!-- Icons Section -->
                            <div class="icon-container d-flex align-items-center me-3">
                                <div class="form-check d-flex justify-content-center align-items-center fs-5 me-2"> 
                                    <input class="form-check-input faq-checkbox" type="checkbox" value="{{ $faq->id }}" id="flexCheckDefault{{ $faq->id }}">  
                                </div>
                                <img src="{{ asset('images/line.svg') }}" alt="Hide" class="me-2">
                                <h1 class="fs-5 fw-bold" style="margin: 0">Q{{ $loop->iteration }}</h1>
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

<!-- Modal for no checkbox selected warning -->
<div class="modal fade" id="noCheckboxModal" tabindex="-1" role="dialog" aria-labelledby="noCheckboxModalTitle" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header d-flex justify-content-center">
                <h5 class="modal-title" id="noCheckboxModalTitle" style="font-size: 1.2rem; font-weight: bold;">Warning</h5>
            </div>
            <div class="modal-body mx-2 d-flex justify-content-center align-items-center">
                <h4 class="text-center" style="width: 25rem; font-weight: 400;">You should pick at least one FAQ to delete.</h4>
            </div>
            <div class="modal-footer mx-2 d-flex justify-content-center">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<script>
    // Show the correct modal based on checkbox selection
    document.getElementById('deleteBtn').addEventListener('click', function () {
        const checkboxes = document.querySelectorAll('.faq-checkbox');
        const isChecked = Array.from(checkboxes).some(checkbox => checkbox.checked);

        if (isChecked) {
            var deleteModal = new bootstrap.Modal(document.getElementById('PdeleteModalCenter'));
            deleteModal.show();
        } else {
            var warningModal = new bootstrap.Modal(document.getElementById('noCheckboxModal'));
            warningModal.show();
        }
    });

    document.getElementById('savePDelBtn').addEventListener('click', function () {
    const checkboxes = document.querySelectorAll('.faq-checkbox:checked');
    const selectedIds = Array.from(checkboxes).map(checkbox => checkbox.value);

    if (selectedIds.length > 0) {
        fetch('{{ route("faq.delete") }}', {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({ ids: selectedIds })
        })
        .then(response => response.json())
        .then(data => { 
            if (data.success) {
                // Remove each deleted FAQ from the DOM
                selectedIds.forEach(id => {
                    const faqItem = document.getElementById(`faqItem${id}`);
                    if (faqItem) faqItem.remove();
                });

                // Close the modal
                const deleteModal = bootstrap.Modal.getInstance(document.getElementById('PdeleteModalCenter'));
                deleteModal.hide();
            } else {
                alert(data.message || 'Failed to delete FAQs.');
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert('An error occurred while deleting FAQs.');
        });
    } else {
        alert('No FAQs selected for deletion.');
    }
});
 
</script>
@endsection
