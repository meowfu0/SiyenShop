

//adding faqs modal
$(document).ready(function () {
    console.log("CSRF Token:", $('meta[name="csrf-token"]').attr("content"));

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    function toTitleCase(text) {
        return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
    }

    $("#saveButton").click(function () {
        var question = $('input[name="question"]').val();
        var answer = $('textarea[name="answer"]').val();

        question = toTitleCase(question);
        answer = toTitleCase(answer);

        if (!question.endsWith("?")) {
            question += "?";
        }

        var faqItem = {
            questions: question,
            answers: answer,
        };

        $.ajax({
            url: "/admin/faqs",
            type: "POST",
            contentType: "application/json",
            data: JSON.stringify(faqItem),

            success: function (response) {
                console.log("Response:", response);
                // Clear inputs
                $('input[name="question"]').val("");
                $('textarea[name="answer"]').val("");
                $("#newModalCenter").modal("hide");

                location.reload();
            },
            error: function (xhr) {
                console.error("Error:", xhr);
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });

    $("#closeButton").click(function () {
        $("#newModalCenter").modal("hide");
    });
});

//edit faqs
$(document).ready(function () {
    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#editModalCenter").on("show.bs.modal", function (event) {
        var button = $(event.relatedTarget);
        var question = button.data("question");
        var answer = button.data("answer");
        var faqId = button.data("id");

        var modal = $(this);
        modal.find('input[type="text"]').val(question);
        modal.find("textarea").val(answer);
        modal.find("#saveEdit").data("id", faqId);
    });

    function toTitleCase(text) {
        return text.replace(/\w\S*/g, function (word) {
            return word.charAt(0).toUpperCase() + word.slice(1).toLowerCase();
        });
    }

    $("#saveEdit").click(function () {
        var question = $("#editQuestion").val();
        var answer = $("#editAnswer").val();
        var faqId = $(this).data("id");

        question = toTitleCase(question);
        answer = toTitleCase(answer);

        if (!question.endsWith("?")) {
            question += "?";
        }

        if (!question || !answer) {
            alert("Both question and answer fields are required.");
            return;
        }

        var faqItem = {
            questions: question,
            answers: answer,
        };

        $.ajax({
            url: "/admin/faqs/" + faqId,
            type: "PUT",
            contentType: "application/json",
            data: JSON.stringify(faqItem),

            success: function (response) {
                console.log("Response:", response);
                $("#editModalCenter").modal("hide");

                $("#collapse" + faqId)
                    .prev()
                    .find("strong")
                    .text(response.questions);
                $("#collapse" + faqId).html(response.answers);

                location.reload();
            },
            error: function (xhr) {
                console.error("Error:", xhr);
                alert("An error occurred: " + xhr.responseText);
            },
        });
    });

    $("#closeEdit").click(function () {
        $("#editModalCenter").modal("hide");
    });
});

//hide and show faqs
document.addEventListener("DOMContentLoaded", function () {
    const hideModal = document.getElementById("hideModalCenter");
    const showModal = document.getElementById("showModalCenter");
    const deleteModal = document.getElementById("deleteModalCenter");
    let faqIdToHide;
    let faqIdToShow;
    let faqIdToDelete;

    hideModal.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        faqIdToHide = button.getAttribute("data-faq-id");
    });

    showModal.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        faqIdToShow = button.getAttribute("data-faq-id");
    });

    deleteModal.addEventListener("show.bs.modal", function (event) {
        const button = event.relatedTarget;
        faqIdToDelete = button.getAttribute("data-faq-id");
    });

    $.ajaxSetup({
        headers: {
            "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
        },
    });

    $("#saveHideBtn").click(function () {
        if (faqIdToHide) {
            fetch(`/admin/faqs/${faqIdToHide}/hide`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then((response) => {
                    console.log("Response:", response);
                    if (response.ok) {
                        location.reload();
                    } else {
                        return response.json().then((data) => {
                            console.error("Failed to update status:", data);
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });

    $("#saveShowBtn").click(function () {
        if (faqIdToShow) {
            fetch(`/admin/faqs/${faqIdToShow}/show`, {
                method: "PUT",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then((response) => {
                    console.log("Response:", response);
                    if (response.ok) {
                        location.reload();
                    } else {
                        return response.json().then((data) => {
                            console.error("Failed to update status:", data);
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });

    $("#saveDelBtn").click(function () {
        if (faqIdToDelete) {
            fetch(`/admin/faqs/${faqIdToDelete}/delete`, {
                method: "DELETE",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
            })
                .then((response) => {
                    console.log("Response:", response);
                    if (response.ok) {
                        location.reload();
                    } else {
                        return response.json().then((data) => {
                            console.error("Failed to delete FAQ:", data);
                        });
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });
});

//scroll input text message
document.addEventListener("DOMContentLoaded", function() {
    const messagesContainer = document.getElementById('messages-container');
    messagesContainer.addEventListener('wheel', function(event) {
        event.preventDefault();
        messagesContainer.scrollTop += event.deltaY; 
    });

    const messageArea = document.getElementById('message');
    messageArea.addEventListener('wheel', function(event) {
        event.preventDefault();
        messageArea.scrollTop += event.deltaY;
    });
});



//deleted faqs
document.addEventListener('DOMContentLoaded', function () {
    function updateSelectedIds() {
        const selectedIds = [];
        const checkboxes = document.querySelectorAll('.faq-checkbox:checked');
        checkboxes.forEach(checkbox => {
            selectedIds.push(checkbox.value);
        });
        document.getElementById('retrieveFaqIds').value = JSON.stringify(selectedIds);
        document.getElementById('deleteFaqIds').value = JSON.stringify(selectedIds);
    }

    const checkboxes = document.querySelectorAll('.faq-checkbox');
    checkboxes.forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedIds);
    });

    // Retrieve FAQs
    $("#retrieveBtn").click(function () {
        const faqIdsToRetrieve = JSON.parse(document.getElementById('retrieveFaqIds').value || '[]');

        if (faqIdsToRetrieve.length > 0) {
            $('#retrieveModal').modal('show'); 
        } else {
            $('#noCheckboxModal').modal('show'); 
        }
    });

    // Confirm retrieval
    $("#confirmRetrieveBtn").click(function () {
    const faqIdsToRetrieve = JSON.parse(document.getElementById('retrieveFaqIds').value || '[]');
    if (faqIdsToRetrieve.length > 0) {
        fetch('/admin/faqs-deleted/retrieve', {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
            },
            body: JSON.stringify({ faq_ids: faqIdsToRetrieve }),
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                location.reload();
            } else {
                console.error(data.error);
            }
        })
        .catch(error => {
            console.error("Error:", error);
        });
    }
});


    // Delete FAQs
    $("#deleteBtn").click(function () {
        const faqIdsToDelete = JSON.parse(document.getElementById('deleteFaqIds').value || '[]');

        if (faqIdsToDelete.length > 0) {
            $('#PdeleteModalCenter').modal('show'); 
        } else {
            $('#noCheckboxModal').modal('show'); l
        }
    });


    $("#savePDelBtn").click(function () {
        const faqIdsToDelete = JSON.parse(document.getElementById('deleteFaqIds').value || '[]');

        if (faqIdsToDelete.length > 0) {
            faqIdsToDelete.forEach(id => {
                fetch(`/admin/faqs-deleted/destroy/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
                    },
                })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        location.reload();
                    } else {
                        console.error(data.error);
                    }
                })
                .catch(error => {
                    console.error("Error:", error);
                });
            });
        }
    });
});


//chat funtionc


