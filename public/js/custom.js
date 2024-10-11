// Sample tabs for the 2 users
// This is just for testing purposes
function showChat(user) {
    document.getElementById("jay").style.display = "none";
    document.getElementById("john").style.display = "none";

    var buttons = document.getElementsByClassName("tab-btn");
    for (var i = 0; i < buttons.length; i++) {
        buttons[i].classList.remove("active");
    }

    document.getElementById(user).style.display = "block";
    event.target.classList.add("active");
}

function showAdminChat() {
    const chatComponent = document.getElementById("chatComponent");

    // Toggle chat component visibility
    // This is just for testing purposes
    if (chatComponent.style.display === "none") {
        chatComponent.style.display = "block";
        document.getElementById("jay").style.display = "none";
        document.getElementById("john").style.display = "none";

        var buttons = document.getElementsByClassName("tab-btn");
        for (var i = 0; i < buttons.length; i++) {
            buttons[i].classList.remove("active");
        }

        document.getElementById(user).style.display = "block";
        event.target.classList.add("active");
    } else {
        chatComponent.style.display = "none";
    }
}
