const tooltipTriggerList = document.querySelectorAll(
    '[data-bs-toggle="tooltip"]'
);
const tooltipList = [...tooltipTriggerList].map(
    (tooltipTriggerEl) => new bootstrap.Tooltip(tooltipTriggerEl)
);

// Datatable
document.addEventListener("DOMContentLoaded", function () {
    let table = new DataTable("#table-pertanahan", {
        order: [[0, "asc"]],
    });
});

// modal
const exampleModal = document.getElementById("exampleModal");
exampleModal.addEventListener("show.bs.modal", (event) => {
    const button = event.relatedTarget;
    const pertanahan = button.getAttribute("data-detail");
    const detail = JSON.parse(pertanahan);
    const modalTitle = exampleModal.querySelector(".modal-title");
    const modalBodyInput = exampleModal.querySelector(".modal-body input");
    console.log();
    modalTitle.textContent = detail.pemilik.nama;
    modalBodyInput.value = detail.pemilik.alamat;
});
