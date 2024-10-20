@extends('layouts.user')

@section('content')
<div class="main-content d-flex flex-column">
    <header class="p-3 border-bottom d-flex align-items-center mt-3">
        <img src="{{asset('images/chat.svg')}}" alt="" class="me-2 chat-icon" style="height: 23px; width: 23px;">
        <h1 class="mt-0 text-primary fw-bold chat-title" style="font-size: 24px">Chat</h1>
        <h1 class="mt-0 text-primary fw-bold chat-name" style="font-size: 24px; display: none;">Dave</h1>
    </header>

    <div class="content-chatbox-chat">
        <!-- Tabs (buttons) -->
        <div class="container-chatbox">
            <input type="text" placeholder="Search..." class="form-control mt-3">

            <!-- Existing buttons for users -->
            <div class="container-btn border d-flex align-items-center" onclick="showChat('customer-support')" style="cursor: pointer; border-radius: 8px;">
                <img src="{{asset('images/user.svg')}}" alt="" style="margin-left: 10px;">
                <span class="text-primary text-center ms-2">Customer Support</span>
            </div>
        </div>

        <div class="container-chat" id="customer-support" style="display: none; position: relative;">
            <h1>Chat with customer support!</h1>

            <div class="chat-input d-flex p-3 border-top" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: white;">
                <input type="text" class="form-control me-2" placeholder="Type a message...">
                <button type="button" class="d-flex align-center justify-center border-non bg-w" style="display: flex; align-items: center; justify-content: center; outline: none; border: none; background-color: #ffff">
                    <img src="{{asset('images/send.svg')}}" alt="Send" style="width: 20px; height: 20px;">
                </button>
            </div>
        </div>
    </div>
</div>
<script>
    
</script>


@endsection
