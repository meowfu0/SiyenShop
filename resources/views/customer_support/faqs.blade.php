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
                <h2 class="display-5 text-left custom-width-h2 text-primary fw-bold">Most <span class="text-secondary display-5 fw-bold">Frequently Asked Questions</span> </h2>
            </div>
            <div class="faq-section mt-3 d-inline-flex border justify-content-center" style="gap: 20px; border-radius: 4px;">
                <!-- FAQ Button -->
                <a href="#" id="support-chat" class="d-flex justify-content-center align-items-center my-3">
                    <img src="{{ asset('images/support.svg') }}" alt="Support" style="width: 32px; height: 32px;">
                </a>


                <p class="d-flex justify-content-center align-items-center custom-width-p">Couldn't find your concern? Chat with us!</p>

            </div>  
        </div>
        <!-- Container of the FAQs containing questions and answers using bootstrap accordion -->
        <div class="col-md-7">
        @isset($faqs)
            @foreach ($faqs->where('status_id', 1) as $faq)
                <div class="accordion my-4">
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="heading{{ $faq->id }}">
                            <button class="accordion-button collapsed" type="button" 
                                    data-bs-toggle="collapse" 
                                    data-bs-target="#collapse{{ $faq->id }}" 
                                    aria-expanded="false" 
                                    aria-controls="collapse{{ $faq->id }}">
                                <strong>{{ $faq->questions }}</strong>
                            </button>
                        </h2>
                        <div id="collapse{{ $faq->id }}" class="accordion-collapse collapse" aria-labelledby="heading{{ $faq->id }}" data-bs-parent="#accordionExample">
                            <div class="accordion-body">
                                {!! $faq->answers !!}
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <p>No FAQs available at the moment.</p>
        @endisset
    </div>
</div>
@endsection


<script>
document.addEventListener("DOMContentLoaded", function() {
    const supportChatButton = document.getElementById('support-chat');
    const isLoggedIn = !!document.querySelector('meta[name="user-authenticated"]');
    if (supportChatButton) {
        supportChatButton.addEventListener('click', function(e) {
            e.preventDefault(); 

            fetch("{{ route('start.chat') }}", {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}', 
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify({ 
                    message: 'Hello!! how can I help you?', 
                    is_admin: true 
                })
            })
            .then(response => {
                if (!response.ok) {
                    throw new Error('Network response was not ok');
                }
                return response.json();
            })
            .then(data => {
                if (data.success) {
                    window.location.href = "{{ route('start.chat') }}";
                } else {
                    alert('Error sending message: ' + data.message);
                }
            })
            .catch(error => {
                window.location.href = "/login";
            });
        });
    } else {
        console.error("Button with ID 'support-chat' not found.");
    }
});

</script>
