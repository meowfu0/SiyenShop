
<script src="{{ asset('js/custom.js') }}" defer></script>
<!-- Add Font and CSS links -->
<link href="https://fonts.cdnfonts.com/css/satoshi" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<!-- Custom CSS -->
<style>
   
    .fixed-sidebar {
        position: fixed;
        top: 0;
        left: 0;
        height: 100%;
        z-index: 9999;        
    }
    .navbar-container {
        position: absolute;
        top: 0;
        left: 250px; 
        width: calc(100% - 250px); 
        z-index: 1; 
    }
    .navbar {
        width: 100%; 
        background-color: white;
    }

    .navbar-nav {
        display: flex;
        align-items: center;
    }

    .justify-content-start {
        justify-content: flex-start;
    }

    .justify-content-center {
        justify-content: center;
    }
    .navbar-nav .nav-item {
        margin-right: 30px;
    }
    /* Styles for the chat content */
        .main-content { 
            margin-top: 60px; 
            height: calc(100vh - 85px);
        }
    
        .content-chatbox-chat {
            flex-grow: 1;
            display: flex;
            
        }
        .content header h1 {
            font-size: 24px;
            font-weight: bold;
        }
        .container-chatbox {
            width: 23%;     
            display: flex;          
            align-items: center;  
            border-right: 1px solid #ccc;
            flex-direction: column;
        }
        .container-chatbox input {
            width: 90%;    
            margin-bottom: 20px;          
        }
        .container-btn{
            display: flex;
            width: 90%;  
            height: 48px; 
            margin-bottom: 0.5rem;   
            font-weight: bold;
            font-size: 12px;
        }
        .container-chat {
            width: 77%;
        }
        

</style>

<!-- Main Content -->
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
            <div class="container-btn border d-flex align-items-center" onclick="showChat('jay')" style="cursor: pointer; border-radius: 8px;">
                <img src="{{asset('images/user.svg')}}" alt="" style="margin-left: 10px;">
                <span class="text-primary text-center ms-2">Jay Bombales</span>
            </div>

            <div class="container-btn border d-flex align-items-center" onclick="showChat('john')" style="cursor: pointer; border-radius: 8px;">
                <img src="{{asset('images/user.svg')}}" alt="" style="margin-left: 10px;">
                <span class="text-primary text-center ms-2">John Dave Bañas</span>
            </div>

        </div>

        <div class="container-chat" id="jay" style="display: none; position: relative;">
            <h1>Hi Jay</h1>
            
            <div class="chat-input d-flex p-3 border-top" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: white;">            
                <input type="text" class="form-control me-2" placeholder="Type a message...">
                <button type="button" class="d-flex align-center justify-center border-non bg-w" style="display: flex; align-items: center; justify-content: center; outline: none; border: none; background-color: #ffff">
                    <img src="{{asset('images/send.svg')}}" alt="Send" style="width: 20px; height: 20px;">
                </button>

            </div>
        </div>

        <div class="container-chat" id="john" style="display: none; position: relative;">
        <h1>Hi Dave</h1>
            
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
    const chatButtons = document.querySelectorAll('.container-btn');
    const chatContainers = document.querySelectorAll('.container-chat');
    const chatboxContainer = document.querySelector('.container-chatbox');

    // Add event listener to each chat button
    chatButtons.forEach((button, index) => {
        button.addEventListener('click', function() {
            // Remove 'active' class from all buttons and chats
            chatButtons.forEach(btn => btn.classList.remove('active'));
            chatContainers.forEach(chat => chat.classList.remove('active'));

            // Add 'active' class to the clicked button
            this.classList.add('active');

            // Hide the chatbox container and show the appropriate chat container
            chatboxContainer.classList.add('hidden'); // Hide chatbox container
            chatContainers[index].classList.add('active'); // Show the clicked chat container
        });
    });
</script>







