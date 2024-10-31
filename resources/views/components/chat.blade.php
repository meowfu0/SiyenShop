<div class="main-content d-flex flex-column">
        <header class="p-3 border-bottom d-flex align-items-center mt-3">
            <img src="{{asset('images/chat.svg')}}" alt="" class="me-2 chat-icon" style="height: 23px; width: 23px;">
            <h1 class="mt-0 text-primary fw-bold chat-title" style="font-size: 24px">Chat</h1>
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
            </div>
            <div class="container-chat" id="jay" style="display: none; position: relative;">

                <div class="d-flex gap-2 p-4 w-100  border-bottom border-bottom-2">
                    <img src="{{asset('images/user.svg')}}" alt="">
                    <p class="m-0 fs-5 fw-medium">Jay Bombales</p>
                </div>

                <div class="p-4 ">
                        <!-- Receiver UI -->
                    <div class="d-flex gap-3 mb-2">
                        <div style="width: 40px; height: 40px; border-radius: 8.333px; background: #FEF0CA;"></div>
                        <div class="" style="max-width: 50%;">
                            <p class="m-0 p-2 text-dark text-wrap bg-light rounded">When can I get my orderontrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old. Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia, looked up one of the more obscure Latin words, consectetur, from a Lorem Ipsum passage, and going through the cites of the word in classical literature, discovered the undoubtable source. Lorem Ipsum comes from sections 1.10.32 and 1.10.33 of "de Finibus Bonorum et Malorum" (The Extremes of Good and Evil) by Cicero, written in 45 BC. This book is a treatise on the theory of ethics, very popular during the Renaissance. The first line of Lorem Ipsum, "Lorem ipsum dolor sit amet..", comes from a line in section 1.10.32.

                                The standard chunk of Lorem Ipsum used since the 150</p>
                        </div>
                    </div>
                
                    <!-- Sender UI -->
                    <div class="d-flex gap-3  justify-content-end mb-2">
                        <div class="" style="max-width: 50%;">
                            <p class="m-0 p-2 text-white text-wrap bg-primary rounded text-end">Your order will be ready soon!</p>
                        </div>
                        <div style="width: 40px; height: 40px; border-radius: 8.333px; background: #CCE5FF;"></div>
                    </div>
                </div>
               
            
                <!-- Chat Input -->
                <div class="chat-input d-flex p-3 border-top" style="position: absolute; bottom: 0; left: 0; right: 0; background-color: white;">
                    <input type="text" class="form-control me-2" placeholder="Type a message...">
                    <button type="button" class="d-flex align-items-center justify-content-center border-0 bg-transparent" style="outline: none;">
                        <img src="{{asset('images/send.svg')}}" alt="Send" style="width: 20px; height: 20px;">
                    </button>
                </div>
            </div>
        </div>
</div>