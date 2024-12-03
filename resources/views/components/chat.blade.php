
  <div class="main-content d-flex flex-column">
            <header class="p-3 border-bottom d-flex align-items-center mt-3">
                <img src="{{asset('images/chat.svg')}}" alt="" class="me-2 chat-icon" style="height: 23px; width: 23px;" onclick="toggleChat()">
                <h1 class="mt-0 text-primary fw-bold chat-title" style="font-size: 24px">Chat</h1>
            </header>


            <div class="content-chatbox-chat" style="max-height: 100%; overflow-y: auto;">
                <!-- Tabs (buttons) -->
                <div class="container-chatbox" id="contacts_list">
                <div class="container d-flex justify-content-center mt-3">
                    <input type="text" id="search-user" placeholder="Search..." class="form-control" style="width: 100%;">
                </div>
                    <div id="user-results" class="container d-flex flex-column align-items-center justify-content-center px-0" style="overflow-y: auto;">
                    <!-- Dynamic buttons for users -->
                        @if(isset($contacts) && count($contacts) > 0)                            
                         @foreach($contacts as $contact)
                            <div class="container-btn border d-flex align-items-center justify-content-between"
                                onclick="showChat('{{ $contact->contact_id }}', '{{ $contact->name }}')"
                                style="cursor: pointer; border-radius: 8px; padding: 10px;">
                                <div class="d-flex align-items-center">
                                <img 
                                    src="{{ $contact->profile_picture ? asset('storage/' . $contact->profile_picture) : asset('images/profile.svg') }}"
                                    alt="Profile Picture" 
                                    style="
                                        margin-left: 10px; 
                                        width: 20px; 
                                        height: 20px; 
                                        border-radius: 50%; 
                                        object-fit: cover;">
                                    <div class="ms-2">
                                        <span class="text-primary d-block d-md-inline" style="font-size: 5px; font-size: calc(4px + 0.5vw);">
                                            {{ $contact->name }}
                                        </span>
                                        @if(isset($contact->last_message) && !empty($contact->last_message))
                                            <p class="mb-0 text-muted small text-truncate" style="max-width: 10ch; overflow: hidden; white-space: nowrap; font-size: 5px; font-size: calc(1px + 0.5vw);">{{ $contact->last_message }}</p>
                                        @else
                                            <p class="mb-0 text-muted small">No messages yet</p>  
                                        @endif
                                    </div>
                                </div>
                                <div class="text-end">
                                    <span class="text-muted smaller" style="padding-bottom: 1.1rem; font-size: 2px; font-size: calc(1px + 0.5vw);">{{ \Carbon\Carbon::parse($contact->last_message_time)->format('m-d-y') }}</span>
                                    @if($contact->unread_count > 0) 
                                        <div class="mt-1" style="width: 8px; height: 8px; border-radius: 80%; background-color: orange; margin-left: auto;"></div>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                        @else
                            <p class="small text-muted">No contacts available.</p>
                        @endif
                    </div>
                </div>
            <div class="container-chat" id="chat-area" style="display: none; position: relative;">
                <div class="d-flex gap-2 p-4 w-100 border-bottom border-bottom-2">
                <img 
                    src="{{ $contact->profile_picture ? asset('storage/' . $contact->profile_picture) : asset('images/profile.svg') }}"
                    alt="Profile Picture" 
                    style="
                        margin-left: 10px; 
                        width: 20px; 
                        height: 20px; 
                        border-radius: 50%; 
                        object-fit: cover;">
                    <p class="m-0 fs-3 fw-medium" id="contact-name"></p>
                </div>
                <div class="messages p-4" id="messages-container">
                    <!-- Render messages dynamically -->
                </div>               
                    <!-- Chat Input -->
                    <div class="chat-input d-flex p-3 border-top" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: white;">
                    <textarea id="message" wire:model="newMessage" class="form-control me-2" rows="1" placeholder="Type a message..." style="resize: none; height: calc(2.25rem + 2px);"></textarea>
                    <button id="send-message" wire:click="sendMessage" type="button" class="d-flex align-items-center justify-content-center border-0 bg-transparent" style="outline: none;">
                        <img id="send-icon" src="{{ asset('images/send.svg') }}" alt="Send" style="width: 20px; height: 20px;">
                        <!-- Loading Spinner (Initially hidden) -->
                        <div id="loading-spinner" class="spinner-border text-primary" role="status" style="display: none; width: 20px; height: 20px;">
                            <span class="visually-hidden">Loading...</span>
                        </div>
                    </button>

                    </div>

                </div>
            </div>
    </div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://js.pusher.com/7.0/pusher.min.js"></script>
<script>
    Pusher.logToConsole = true;

    var pusher = new Pusher("4f6a33c759843c81e465", {
        cluster: "ap1",
        encrypted: true,
    });

    var channel = pusher.subscribe("chat-channel");
    let selectedUserId = null;

    const authenticatedUserId = "{{ Auth::user()->id }}";

    function showChat(contactId, contactName) {
        document.getElementById("chat-area").style.display = "block";
        document.getElementById("contact-name").innerText = contactName;
        loadChatHistory(contactId);
    }

    //halding send message
    document.addEventListener("DOMContentLoaded", function () {
        document
            .getElementById("send-message")
            .addEventListener("click", async function () {
                const messageInput = document.getElementById("message");
                const message = messageInput.value;

                if (message.trim() === "") {
                    alert("Message cannot be empty");
                    return;
                }

                if (!navigator.onLine) {
                    document.getElementById("send-icon").style.display = "none";
                    document.getElementById("loading-spinner").style.display =
                        "inline-block";
                    alert("No internet connection. Please check your connection.");
                    return;
                }

                document.getElementById("send-icon").style.display = "none";
                document.getElementById("loading-spinner").style.display =
                    "inline-block";

                try {
                    const response = await fetch("{{ route('send.message') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        body: JSON.stringify({
                            message: message,
                            recipient_id: selectedUserId,
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || "Error sending message");
                    }

                    // Update the contacts list
                    updateContactList(data.contacts);
                    reloadContactsList();

                    messageInput.value = "";
                } catch (error) {
                    console.error("Error sending message:", error.message);
                    alert("Failed to send message. Please try again.");
                } finally {
                    document.getElementById("send-icon").style.display =
                        "inline-block";
                    document.getElementById("loading-spinner").style.display =
                        "none";
                }
            });

        window.addEventListener("online", async function () {
            const messageInput = document.getElementById("message");
            const message = messageInput.value;

            if (message.trim() === "") return;
            const sendMessage = async () => {
                try {
                    const response = await fetch("{{ route('send.message') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": "{{ csrf_token() }}",
                        },
                        body: JSON.stringify({
                            message: message,
                            recipient_id: selectedUserId,
                        }),
                    });

                    const data = await response.json();

                    if (!response.ok) {
                        throw new Error(data.error || "Error sending message");
                    }

                    appendMessage({
                        id: authenticatedUserId,
                        message: message,
                        sender_id: authenticatedUserId,
                    });

                    messageInput.value = "";
                } catch (error) {
                    console.error("Error sending message:", error.message);
                }
            };
            sendMessage();
        });
    });

    channel.bind("chat-event", function (data) {
        console.log("Received message:", data);
        appendMessage(data);
        reloadContactsList();

        if (
            data.message.recipient_id === authenticatedUserId ||
            data.message.sender_id === authenticatedUserId
        ) {
            console.log(
                `New message from ${data.message.sender_id}: ${data.message.message}`
            );
            appendMessage(data.message);
        }
    });

    function appendMessage(data) {
        console.log("Appending message:", data);
        const chatBox = document.getElementById("messages-container");
        if (!chatBox) {
            console.log("Chat box not found");
            return;
        }

        const messageDiv = document.createElement("div");
        if (data.sender_id == authenticatedUserId) {
            messageDiv.className = "d-flex gap-3 justify-content-end mb-2";
            messageDiv.innerHTML = `
        <div style="max-width: 50%;">
            <p class="m-0 p-2 text-white text-wrap bg-primary rounded">${data.message}</p>
        </div>
        <div style="width: 40px; height: 40px; border-radius: 8.333px; background: #CCE5FF;"></div>
    `;
        } else {
            messageDiv.className = "d-flex gap-3 mb-2";
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

        document.getElementById("messages-container").innerHTML = "";

        fetch(`/fetch-messages/${selectedUserId}`)
            .then((response) => {
                if (!response.ok) {
                    throw new Error("Error fetching chat history");
                }
                return response.json();
            })
            .then((messages) => {
                messages.forEach((msg) => {
                    appendMessage(msg);
                });

                const chatBox = document.getElementById("messages-container");
                chatBox.scrollTop = chatBox.scrollHeight;
            })
            .catch((error) => console.error("Error fetching chat history:", error));
    }

    //user search
    document.getElementById("search-user").addEventListener("input", function () {
    const query = this.value.trim();

    if (query === "") {
        displayContactsList();
        return;
    }
    clearTimeout(window.searchTimeout);
    window.searchTimeout = setTimeout(() => {
        fetch(`/search-users?query=${encodeURIComponent(query)}`)
            .then((response) => {
                return response.json();
            })
            .then((data) => {
                const userResults = document.getElementById("user-results");
                userResults.innerHTML = "";

                if (data.length === 0) {
                    userResults.innerHTML = `<p class="small text-muted">No contacts found.</p>`;
                } else {
                    data.forEach((contact) => {
                        const contactDiv = document.createElement("div");
                        contactDiv.className =
                            "container-btn border d-flex align-items-center justify-content-between";
                        contactDiv.style.cursor = "pointer";
                        contactDiv.style.borderRadius = "8px";
                        contactDiv.style.padding = "10px";
                        contactDiv.onclick = function () {
                            showChat(contact.id, contact.first_name);
                        };

                        contactDiv.innerHTML = `
                            <div class="d-flex align-items-center">
                            <img 
                                src="{{ $contact->profile_picture ? asset('storage/' . $contact->profile_picture) : asset('images/profile.svg') }}"
                                alt="Profile Picture" 
                                style="
                                    margin-left: 10px; 
                                    width: 20px; 
                                    height: 20px; 
                                    border-radius: 50%; 
                                    object-fit: cover;">
                                <div class="ms-2">
                                    <span class="text-primary d-block d-md-inline" style="font-size: 12px;">${contact.first_name} ${contact.last_name}</span>
                                </div>
                            </div>
                        `;
                        userResults.appendChild(contactDiv);
                    });
                }
            })
            .catch((error) => {
                console.error("Error fetching users:", error);
                document.getElementById("user-results").innerHTML =
                    '<p class="small text-muted">Error loading users</p>';
            });
    }, 500);
});
    function updateContactList(contacts) {
        const userResults = document.getElementById("user-results");
        userResults.innerHTML = "";

        if (contacts.length === 0) {
            userResults.innerHTML = `<p class="small text-muted">No contacts available.</p>`;
        } else {
            contacts.forEach((contact) => {
                const contactDiv = document.createElement("div");
                contactDiv.className =
                    "container-btn border d-flex align-items-center justify-content-between";
                contactDiv.style.cursor = "pointer";
                contactDiv.style.borderRadius = "8px";
                contactDiv.style.padding = "10px";
                contactDiv.onclick = function () {
                    showChat(contact.contact_id, contact.name);
                };

                const date = new Date(contact.last_message_time);
                const month = String(date.getMonth() + 1).padStart(2, "0");
                const day = String(date.getDate()).padStart(2, "0");
                const year = String(date.getFullYear()).slice(-2);
                const formattedDate = `${month}-${day}-${year}`;

                contactDiv.innerHTML = `
            <div class="d-flex align-items-center">
                <img src="{{ asset('images/user.svg') }}" alt="" style="margin-left: 10px;">
                <div class="ms-2">
                    <span class="text-primary d-block d-md-inline" style="font-size: calc(4px + 0.5vw);">${
                        contact.name
                    }</span>
                    <p class="mb-0 text-muted small text-truncate" style="max-width: 10ch; overflow: hidden; white-space: nowrap; font-size: 5px; font-size: calc(2px + 0.5vw);">${
                        contact.last_message || "No messages yet"
                    }</p>
                </div>
            </div>
            <span class="text-muted smaller" style="padding-bottom: 1.1rem; font-size: 2px; font-size: calc(1px + 0.5vw);">${formattedDate}</span>
        `;
                userResults.appendChild(contactDiv);
            });
        }
    }

function reloadContactsList() {
        $("#contacts_list").load(location.href + " #contacts_list > *");
    }

    function showChat(contactId, contactName) {
    document.getElementById('chat-area').style.display = 'block';

    if (window.innerWidth <= 768) {
        document.getElementById('contacts_list').style.display = 'none'; 
    }

    document.getElementById('contact-name').textContent = contactName;
    console.log('Opening chat with ID:', contactId);
    loadChatHistory(contactId);
}

function toggleChat() {
    // Check if the device is mobile
    if (window.innerWidth <= 768) {
        // Get the chat area and contacts list elements
        const chatArea = document.getElementById('chat-area');
        const contactsList = document.getElementById('contacts_list');

        // Toggle visibility
        if (chatArea.style.display === 'block') {
            chatArea.style.display = 'none'; // Hide chat area
            contactsList.style.display = 'block'; // Show contacts list
        } else {
            chatArea.style.display = 'block'; // Show chat area
            contactsList.style.display = 'none'; // Hide contacts list
        }
    } else {
        console.log('This feature is only available on mobile devices.');
    }
}

function adjustContactStyles() {
    const isMobile = window.innerWidth <= 768; // Define mobile breakpoint
    const contactNames = document.querySelectorAll('.container-btn .text-primary');
    const lastMessages = document.querySelectorAll('.container-btn .text-muted');
    const lastMessageTimes = document.querySelectorAll('.container-btn .smaller');

    contactNames.forEach(name => {
        name.style.fontSize = isMobile ? '12px' : 'calc(4px + 0.5vw)'; // Adjust font size for contact names
    });

    lastMessages.forEach(message => {
        message.style.fontSize = isMobile ? '10px' : 'calc(1px + 0.5vw)'; 
    });

    lastMessageTimes.forEach(time => {
        time.style.fontSize = isMobile ? '8px' : 'calc(1px + 0.5vw)';
    });
}

document.addEventListener('DOMContentLoaded', adjustContactStyles);

window.addEventListener('resize', adjustContactStyles);

</script>

