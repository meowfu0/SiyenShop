
    <div class="main-content d-flex flex-column">
            <header class="p-3 border-bottom d-flex align-items-center mt-3">
                <img src="{{asset('images/chat.svg')}}" alt="" class="me-2 chat-icon" style="height: 23px; width: 23px;">
                <h1 class="mt-0 text-primary fw-bold chat-title" style="font-size: 24px">Chat</h1>
            </header>


            <div class="content-chatbox-chat" style="max-height: 100%; overflow-y: auto;">
                <!-- Tabs (buttons) -->
                <div class="container-chatbox">
                    <input type="text" placeholder="Search..." class="form-control mt-3">

                <!-- Dynamic buttons for users -->
                @if(isset($contacts) && count($contacts) > 0)
                    @foreach($contacts as $contact)
                        <div class="container-btn border d-flex align-items-center justify-content-between"
                            onclick="showChat('{{ $contact->contact_id }}', '{{ $contact->name }}')"
                            style="cursor: pointer; border-radius: 8px; padding: 10px;">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/user.svg') }}" alt="" style="margin-left: 10px;">
                                <div class="ms-2">
                                    <span class="text-primary">{{ $contact->name }}</span>
                                    @if(isset($contact->last_message) && !empty($contact->last_message))
                                        <p class="mb-0 text-muted small">{{ $contact->last_message }}</p>  <!-- Display the last message -->
                                    @else
                                        <p class="mb-0 text-muted small">No messages yet</p>  <!-- Fallback message -->
                                    @endif
                                </div>
                            </div>
                            <span class="text-muted smaller" style="padding-bottom: 1.1rem;">{{ \Carbon\Carbon::parse($contact->last_message_time)->format('m-d-y') }}</span> <!-- Format to mm-dd-yy -->
                        </div>
                    @endforeach
                @else
                    <p class="small text-muted">No contacts available.</p>
                @endif

            </div>
            <div class="container-chat" id="chat-area" style="display: none; position: relative;">
                <div class="d-flex gap-2 p-4 w-100 border-bottom border-bottom-2">
                    <img src="{{ asset('images/user.svg') }}" alt="">
                    <p class="m-0 fs-3 fw-medium" id="contact-name">{{ $contact->name }}</p>
                </div>
                <div class="messages p-4" id="messages-container" style="overflow-y: hidden; height: 63vh;">
                    <!-- Render messages dynamically -->
                </div>               
                    <!-- Chat Input -->
                    <div class="chat-input d-flex p-3 border-top" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: white;">
                    <textarea id="message" wire:model="newMessage" class="form-control me-2" rows="1" placeholder="Type a message..." style="resize: none; height: calc(2.25rem + 2px);"></textarea>
                        <button id="send-message" wire:click="sendMessage" type="button" class="d-flex align-items-center justify-content-center border-0 bg-transparent" style="outline: none;">
                            <img src="{{ asset('images/send.svg') }}" alt="Send" style="width: 20px; height: 20px;">
                        </button>
                    </div>

                </div>
            </div>
    </div>

    <script src="https://js.pusher.com/7.0/pusher.min.js"></script>
    <script>

        Pusher.logToConsole = true;

        var pusher = new Pusher('4f6a33c759843c81e465', {
            cluster: 'ap1',
            encrypted: true
        });

        var channel = pusher.subscribe('chat-channel');
        let selectedUserId = null;

        const authenticatedUserId = "{{ Auth::user()->id }}";

        function showChat(contactId, contactName) {
            document.getElementById('chat-area').style.display = 'block';
            document.getElementById('contact-name').innerText = contactName; // Update this to fetch actual contact name if necessary
            loadChatHistory(contactId); // Load chat history for the selected user
        }

        // Handle sending messages
        document.addEventListener("DOMContentLoaded", function() {
        document.getElementById('send-message').addEventListener('click', async function() {
            const messageInput = document.getElementById('message');
            const message = messageInput.value;

            if (message.trim() === "") {
                alert('Message cannot be empty');
                return;
            }

            try {
                const response = await fetch("{{ route('send.message') }}", {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify({
                        message: message,
                        recipient_id: selectedUserId
                    })
                });

                const data = await response.json();

                if (!response.ok) {
                    throw new Error(data.error || 'Error sending message');
                }

                appendMessage({ id: authenticatedUserId, message: message, sender_id: authenticatedUserId });
                messageInput.value = '';
            } catch (error) {
                console.error('Error sending message:', error.message);
            }
        });
    });

        channel.bind('chat-event', function(data) {
            if (data.user.id !== authenticatedUserId && selectedUserId !== data.user.id) {
                return;
            }
            appendMessage(data);
        });

    function appendMessage(data) {
        const chatBox = document.getElementById('messages-container');
        const messageDiv = document.createElement('div');

        if (data.sender_id == authenticatedUserId) {
            messageDiv.className = 'd-flex gap-3 justify-content-end mb-2';
            messageDiv.innerHTML = `
                <div style="max-width: 50%;">
                    <p class="m-0 p-2 text-white text-wrap bg-primary rounded">${data.message}</p>
                </div>
                <div style="width: 40px; height: 40px; border-radius: 8.333px; background: #CCE5FF;"></div>
            `;
        } else {
            messageDiv.className = 'd-flex gap-3 mb-2';
            messageDiv.innerHTML = `
                <div style="width: 40px; height: 40px; border-radius: 8.333px; background: #FEF0CA;"></div>
                <div style="max-width: 50%;">
                    <p class="m-0 p-2 text-dark text-wrap bg-light rounded">${data.message}</p>
                </div> 
            `;
        }

        chatBox.appendChild(messageDiv);
        chatBox.scrollTop = chatBox.scrollHeight; 
    }

        function loadChatHistory(userId) {
            selectedUserId = userId;

            document.getElementById('messages-container').innerHTML = '';

            fetch(`/fetch-messages/${selectedUserId}`)
                .then(response => {
                    if (!response.ok) {
                        throw new Error('Error fetching chat history');
                    }
                    return response.json();
                })
                .then(messages => {
                    messages.forEach(msg => {
                        appendMessage(msg);
                    });

                    const chatBox = document.getElementById('messages-container');
                    chatBox.scrollTop = chatBox.scrollHeight; 
                })
                .catch(error => console.error('Error fetching chat history:', error));
        }
    </script>

