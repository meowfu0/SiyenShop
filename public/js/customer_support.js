
// This is just for testing purposes
function showChat(user) {
    document.getElementById("jay").style.display = "none";
    
    var buttons = document.getElementsByClassName("");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("active");
        
    }

    document.getElementById(user).style.display = "block";
    event.target.classList.add("active");
}

// script to toggle between chat buttons
const chatButtons = document.querySelectorAll('.container-btn');
const chatContainers = document.querySelectorAll('.container-chat');
const chatboxContainer = document.querySelector('.container-chatbox');

chatButtons.forEach((button, index) => {
    button.addEventListener('click', function() {
         
        chatButtons.forEach(btn => btn.classList.remove('active'));
        chatContainers.forEach(chat => chat.classList.remove('active'));
        this.classList.add('active');

        chatboxContainer.classList.add('hidden'); +
        chatContainers[index].classList.add('active');
    });
});
