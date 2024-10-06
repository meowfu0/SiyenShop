// Sample tabs for the 2 users
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
