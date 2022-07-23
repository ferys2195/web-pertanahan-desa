const btnAppendInputCoordinate = document.getElementById("btn-add-coordinate");
const coordinateContainer = document.getElementById("coordinate-container");
const btnBulkEdit = document.getElementById("btn-bulk-edit");
const formCoordinateInput = document.getElementById("form-coordinate-input");
const bulkCoordinateInput = document.getElementById("bulk-coordinate-input");
const bulkCoordinateTextArea = document.getElementById("bulk-coordinate");
const errorNotifBulkEdit = document.getElementById("error-notif");
const checkIsRegister = document.getElementById("check-register");
const formRegister = document.getElementById("form-register");
const btnAdvance = document.getElementById("btn-advance");
const containerAdvance = document.getElementById("container-advance");
const iconAdvance = document.getElementById("icon-advance");
function createInputCoordinate() {
    const inputCoordinate = /*html*/ `
        <div class="col-md-5">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="input-coordinate-x">X</span>
                <input type="number" name="coordinate_x[]" class="form-control coordinate_x" placeholder="Ex : 7071..." aria-label="Sizing example input" aria-describedby="input-coordinate-x">
            </div>
        </div>
        <div class="col-md-5">
            <div class="input-group input-group-sm mb-3">
                <span class="input-group-text" id="input-coordinate-y">Y</span>
                <input type="number" name="coordinate_y[]" class="form-control coordinate_y" placeholder="Ex : 9751..." aria-label="Sizing example input" aria-describedby="input-coordinate-y">
            </div>
        </div>
        `;

    const rowInput = document.createElement("div");
    rowInput.className = "row g-3";

    const divRemove = document.createElement("div");
    divRemove.className = "col-md-2";

    const btnRemove = document.createElement("button");
    btnRemove.type = "button";
    btnRemove.className = "btn btn-sm btn-outline-danger";
    btnRemove.innerHTML = /*html*/ `<i class="bi bi-trash"></i>`;
    divRemove.appendChild(btnRemove);
    divRemove.addEventListener("click", () => {
        divRemove.parentNode.remove();
    });

    rowInput.innerHTML = inputCoordinate;
    rowInput.appendChild(divRemove);
    return rowInput;
}
btnAppendInputCoordinate.addEventListener("click", () => {
    coordinateContainer.appendChild(createInputCoordinate());
});

btnBulkEdit.addEventListener("click", () => {
    const cX = document.querySelectorAll(".coordinate_x");
    const cY = document.querySelectorAll(".coordinate_y");
    let text = [];
    cX.forEach((x, i) => {
        const y = cY[i];
        const out = `${x.value} ${y.value}`;
        text.push(out);
    });
    bulkCoordinateTextArea.value = text.join("\n");

    if (bulkCoordinateInput.classList.contains("d-none")) {
        bulkCoordinateInput.classList.toggle("d-none");
        formCoordinateInput.classList.toggle("d-none");
    } else {
        bulkCoordinateInput.classList.toggle("d-none");
        formCoordinateInput.classList.toggle("d-none");
    }
});
const exampleFormat = "Example:\n707190 9751555\n707190 9876232";
bulkCoordinateTextArea.setAttribute("placeholder", exampleFormat);
bulkCoordinateTextArea.addEventListener("input", function () {
    // errorNotifBulkEdit.innerText = "";

    // const regex = /[^1234567890 \n]/g;
    // if (bulkCoordinateTextArea.value.match(regex).length > 0) {
    //     errorNotifBulkEdit.innerHTML = `Karakter <strong>${bulkCoordinateTextArea.value
    //         .match(regex)
    //         .toString()}</strong> Tidak Diizinkan`;
    // }

    coordinateContainer.innerHTML = "";
    const result = [];
    const splitText = bulkCoordinateTextArea.value.split("\n");
    splitText.forEach((text) => {
        coordinateContainer.appendChild(createInputCoordinate());
        const coordinate = text.split(" ");
        result.push({ x: coordinate[0], y: coordinate[1] });
    });
    const cX = document.querySelectorAll(".coordinate_x");
    const cY = document.querySelectorAll(".coordinate_y");
    result.forEach((hasil, i) => {
        cX[i].value = hasil.x;
        cY[i].value = hasil.y;
    });
});
checkIsRegister.addEventListener("change", (e) => {
    console.log(e.target.checked);
    if (e.target.checked) formRegister.classList.remove("d-none");
    else formRegister.classList.add("d-none");
});
btnAdvance.addEventListener("click", () => {
    if (containerAdvance.classList.contains("d-none")) {
        iconAdvance.className = "bi bi-chevron-up";
        containerAdvance.classList.remove("d-none");
    } else {
        iconAdvance.className = "bi bi-chevron-down";
        containerAdvance.classList.add("d-none");
    }
});
