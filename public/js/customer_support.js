let newAnswerEditor;
let editAnswerEditor;

document.addEventListener("DOMContentLoaded", () => {
    const csrfToken = document
        .querySelector('meta[name="csrf-token"]')
        .getAttribute("content");

    ClassicEditor.create(document.querySelector("#answer"))
        .then((editor) => {
            newAnswerEditor = editor;
            editor.editing.view.change((writer) => {
                writer.setStyle(
                    "height",
                    "190px",
                    editor.editing.view.document.getRoot()
                );
                editor.ui.view.element.style.width = "98%";
            });
        })
        .catch((error) => {
            console.error("Error initializing new answer editor:", error);
        });
    window.hideModal = function (modalId) {
        const modalElement = document.getElementById(modalId);
        const modal = bootstrap.Modal.getInstance(modalElement);
        if (modal) {
            modal.hide();
        } else {
            const newModal = new bootstrap.Modal(modalElement);
            newModal.hide();
        }
    };
    ClassicEditor.create(document.querySelector("#editAnswer"))
        .then((editor) => {
            editAnswerEditor = editor;
            editor.editing.view.change((writer) => {
                writer.setStyle(
                    "height",
                    "190px",
                    editor.editing.view.document.getRoot()
                );
                editor.ui.view.element.style.width = "98%";
            });
        })
        .catch((error) => {
            console.error("Error initializing edit answer editor:", error);
        });

    // Save new FAQ
    document.querySelector("#saveButton").addEventListener("click", () => {
        const question = document.querySelector('input[name="question"]').value;
        const answer = newAnswerEditor.getData();

        const faqItem = {
            questions: toTitleCase(question),
            answers: answer,
        };

        if (!faqItem.questions.endsWith("?")) {
            faqItem.questions += "?";
        }

        fetch("/admin/faqs", {
            method: "POST",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(faqItem),
        })
            .then((response) => response.json())
            .then((data) => {
                document.querySelector('input[name="question"]').value = "";
                newAnswerEditor.setData("");

                const modal = bootstrap.Modal.getInstance(
                    document.querySelector("#newModalCenter")
                );
                modal.hide();
                location.reload();
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while saving the FAQ");
            });
    });

    document
        .querySelectorAll('[data-bs-target="#editModalCenter"]')
        .forEach((button) => {
            button.addEventListener("click", () => {
                const question = button.getAttribute("data-question");
                const answer = button.getAttribute("data-answer");
                const faqId = button.getAttribute("data-id");

                document.querySelector("#editQuestion").value = question;
                editAnswerEditor.setData(answer);

                document
                    .querySelector("#editModalCenter")
                    .setAttribute("data-faq-id", faqId);
            });
        });

    document.querySelector("#saveEdit").addEventListener("click", () => {
        const modalElement = document.querySelector("#editModalCenter");
        const faqId = modalElement.getAttribute("data-faq-id");
        const question = document.querySelector("#editQuestion").value;
        const answer = editAnswerEditor.getData();

        const faqItem = {
            questions: toTitleCase(question),
            answers: answer,
        };

        if (!faqItem.questions.endsWith("?")) {
            faqItem.questions += "?";
        }

        fetch(`/admin/faqs/${faqId}`, {
            method: "PUT",
            headers: {
                "Content-Type": "application/json",
                "X-CSRF-TOKEN": csrfToken,
            },
            body: JSON.stringify(faqItem),
        })
            .then((response) => response.json())
            .then((data) => {
                const modal = bootstrap.Modal.getInstance(modalElement);
                modal.hide();
                location.reload();
            })
            .catch((error) => {
                console.error("Error:", error);
                alert("An error occurred while updating the FAQ");
            });
    });
});

function toTitleCase(text) {
    return text.charAt(0).toUpperCase() + text.slice(1).toLowerCase();
}

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
document.addEventListener("DOMContentLoaded", function () {
    const messagesContainer = document.getElementById("messages-container");
    messagesContainer.addEventListener("wheel", function (event) {
        event.preventDefault();
        messagesContainer.scrollTop += event.deltaY;
    });

    const messageArea = document.getElementById("message");
    messageArea.addEventListener("wheel", function (event) {
        event.preventDefault();
        messageArea.scrollTop += event.deltaY;
    });
});

//deleted faqs
document.addEventListener("DOMContentLoaded", function () {
    function updateSelectedIds() {
        const selectedIds = [];
        const checkboxes = document.querySelectorAll(".faq-checkbox:checked");
        checkboxes.forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });
        document.getElementById("retrieveFaqIds").value =
            JSON.stringify(selectedIds);
        document.getElementById("deleteFaqIds").value =
            JSON.stringify(selectedIds);
    }

    const checkboxes = document.querySelectorAll(".faq-checkbox");
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", updateSelectedIds);
    });

    // Retrieve FAQs
    $("#retrieveBtn").click(function () {
        const faqIdsToRetrieve = JSON.parse(
            document.getElementById("retrieveFaqIds").value || "[]"
        );

        if (faqIdsToRetrieve.length > 0) {
            $("#retrieveModal").modal("show");
        } else {
            $("#noCheckboxModal").modal("show");
        }
    });

    // Confirm retrieval
    $("#confirmRetrieveBtn").click(function () {
        const faqIdsToRetrieve = JSON.parse(
            document.getElementById("retrieveFaqIds").value || "[]"
        );
        if (faqIdsToRetrieve.length > 0) {
            fetch("/admin/faqs-deleted/retrieve", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify({ faq_ids: faqIdsToRetrieve }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        location.reload();
                    } else {
                        console.error(data.error);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });

    // Delete FAQs
    $("#deleteBtn").click(function () {
        const faqIdsToDelete = JSON.parse(
            document.getElementById("deleteFaqIds").value || "[]"
        );

        if (faqIdsToDelete.length > 0) {
            $("#PdeleteModalCenter").modal("show");
        } else {
            $("#noCheckboxModal").modal("show");
            l;
        }
    });

    $("#savePDelBtn").click(function () {
        const faqIdsToDelete = JSON.parse(
            document.getElementById("deleteFaqIds").value || "[]"
        );

        if (faqIdsToDelete.length > 0) {
            faqIdsToDelete.forEach((id) => {
                fetch(`/admin/faqs-deleted/destroy/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            location.reload();
                        } else {
                            console.error(data.error);
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            });
        }
    });
});

//chat funtionc

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
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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
                "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr("content"),
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

//scroll input text message
document.addEventListener("DOMContentLoaded", function () {
    const messagesContainer = document.getElementById("messages-container");
    messagesContainer.addEventListener("wheel", function (event) {
        event.preventDefault();
        messagesContainer.scrollTop += event.deltaY;
    });

    const messageArea = document.getElementById("message");
    messageArea.addEventListener("wheel", function (event) {
        event.preventDefault();
        messageArea.scrollTop += event.deltaY;
    });
});

//deleted faqs
document.addEventListener("DOMContentLoaded", function () {
    function updateSelectedIds() {
        const selectedIds = [];
        const checkboxes = document.querySelectorAll(".faq-checkbox:checked");
        checkboxes.forEach((checkbox) => {
            selectedIds.push(checkbox.value);
        });
        document.getElementById("retrieveFaqIds").value =
            JSON.stringify(selectedIds);
        document.getElementById("deleteFaqIds").value =
            JSON.stringify(selectedIds);
    }

    const checkboxes = document.querySelectorAll(".faq-checkbox");
    checkboxes.forEach((checkbox) => {
        checkbox.addEventListener("change", updateSelectedIds);
    });

    // Retrieve FAQs
    $("#retrieveBtn").click(function () {
        const faqIdsToRetrieve = JSON.parse(
            document.getElementById("retrieveFaqIds").value || "[]"
        );

        if (faqIdsToRetrieve.length > 0) {
            $("#retrieveModal").modal("show");
        } else {
            $("#noCheckboxModal").modal("show");
        }
    });

    // Confirm retrieval
    $("#confirmRetrieveBtn").click(function () {
        const faqIdsToRetrieve = JSON.parse(
            document.getElementById("retrieveFaqIds").value || "[]"
        );
        if (faqIdsToRetrieve.length > 0) {
            fetch("/admin/faqs-deleted/retrieve", {
                method: "POST",
                headers: {
                    "Content-Type": "application/json",
                    "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                        "content"
                    ),
                },
                body: JSON.stringify({ faq_ids: faqIdsToRetrieve }),
            })
                .then((response) => response.json())
                .then((data) => {
                    if (data.success) {
                        location.reload();
                    } else {
                        console.error(data.error);
                    }
                })
                .catch((error) => {
                    console.error("Error:", error);
                });
        }
    });

    // Delete FAQs
    $("#deleteBtn").click(function () {
        const faqIdsToDelete = JSON.parse(
            document.getElementById("deleteFaqIds").value || "[]"
        );

        if (faqIdsToDelete.length > 0) {
            $("#PdeleteModalCenter").modal("show");
        } else {
            $("#noCheckboxModal").modal("show");
            l;
        }
    });

    $("#savePDelBtn").click(function () {
        const faqIdsToDelete = JSON.parse(
            document.getElementById("deleteFaqIds").value || "[]"
        );

        if (faqIdsToDelete.length > 0) {
            faqIdsToDelete.forEach((id) => {
                fetch(`/admin/faqs-deleted/destroy/${id}`, {
                    method: "DELETE",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": $('meta[name="csrf-token"]').attr(
                            "content"
                        ),
                    },
                })
                    .then((response) => response.json())
                    .then((data) => {
                        if (data.success) {
                            location.reload();
                        } else {
                            console.error(data.error);
                        }
                    })
                    .catch((error) => {
                        console.error("Error:", error);
                    });
            });
        }
    });
});
