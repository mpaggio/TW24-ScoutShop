const editButton = document.querySelectorAll(
    "main > div > div > section > div > div > div > a:first-of-type"
);
const addButton = document.querySelector("main > div > div > section > div > button");
const formButtons = document.querySelector("main > div > div > section > div > form > div:last-of-type");
const closeButton = document.querySelector("main > div > div > section > div > form > div:last-of-type > input:first-of-type");
const saveButton = document.querySelector("main > div > div > section > div > form > div:last-of-type > input:last-of-type");
const title = document.querySelector('main > div > div section > h1');
const formContainer = document.querySelector("main > div > div > section:first-of-type > div");
const formSection = document.querySelector("main > div > div > section:first-of-type");
const articlePane = document.querySelector("main > div > div:first-of-type");
const form = document.querySelector("main > div > div > section > div > form")

const orderButton = document.querySelector("main > ul > li > button:last-of-type");

// Variabile per verificare se il form è aperto o chiuso
let isOpen = false;

// Apri modal (aggiungere un pulsante per attivarlo, se necessario)
function openModal() {
    if (window.innerWidth < 768) {
        formSection.style.display = "block";
        document.body.classList.add("modal-active");
    }
    title.classList.remove("d-none");
    formContainer.classList.remove("d-none");
    isOpen = true;
}

// Chiudi modal
function closeModalHandler() {
    while (form.childElementCount > 1) {
        form.removeChild(form.firstElementChild);
    }
    if (window.innerWidth < 768) {
        formSection.style.display = "none";
    }
    if (addButton.disabled === true) {
        addButton.disabled = false;
    }
    title.classList.add("d-none");
    formContainer.classList.add("d-none");
    isOpen = false;
}

editButton.forEach((button) => {
    button.addEventListener("click", () => {
        if (isOpen === false) {
            title.innerText = "Modifica prodotto:";
            button.disabled = true;
            let edit_elements = `
                <div class="col-lg-6 mb-3">
                    <label for="productPrice" class="form-label fs-3">Prezzo:</label>
                    <input type="text" class="form-control fs-5" id="productPrice">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="productQuantity" class="form-label fs-3">Disponibilità:</label>
                    <input type="text" class="form-control fs-5" id="productQuantity">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="productDiscount" class="form-label fs-3">Sconto:</label>
                    <input type="text" class="form-control fs-5" value="0" id="productDiscount">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="productImage" class="form-label fs-3">Immagine:</label>
                    <input type="file" class="form-control fs-5" id="productImage">
                </div>
                <div class="col-lg-6 mb-3">
                    <label for="productDescription" class="form-label fs-3">Descrizione:</label>
                    <textarea class="form-control fs-5" id="productDescription"
                        rows="3" cols="10">Valure di default text area</textarea>
                </div>
            `;
            form.insertAdjacentHTML("afterbegin", edit_elements);
            openModal();   
        }
    });
});

addButton.addEventListener("click", () => {
    if (addButton.disabled === false && isOpen === false) {
        addButton.disabled = true;
        title.innerText = "Aggiungi prodotto:";
        let add_elements = `
            <div class="col-lg-6 mb-3">
                <label for="productName" class="form-label fs-3">Nome prodotto:</label>
                <input type="text" class="form-control fs-5" id="productName">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productCategory" class="form-label fs-3">Categoria prodotto:</label>
                <input type="text" class="form-control fs-5" id="productCategory">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productBrand" class="form-label fs-3">Marchio prodotto:</label>
                <input type="text" class="form-control fs-5" id="productBrand">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productColor" class="form-label fs-3">Colore:</label>
                <input type="text" class="form-control fs-5" id="productColor">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productSize" class="form-label fs-3">Taglia:</label>
                <input type="text" class="form-control fs-5" id="productSize">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productPrice" class="form-label fs-3">Prezzo:</label>
                <input type="text" class="form-control fs-5" id="productPrice">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productQuantity" class="form-label fs-3">Disponibilità:</label>
                <input type="text" class="form-control fs-5" id="productQuantity">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productDiscount" class="form-label fs-3">Sconto:</label>
                <input type="text" class="form-control fs-5" value="0" id="productDiscount">
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productDescription" class="form-label fs-3">Descrizione:</label>
                <textarea class="form-control fs-5" id="productDescription"
                    rows="3" cols="10">Valure di default text area</textarea>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productImage" class="form-label fs-3">Immagine:</label>
                <input type="file" class="form-control fs-5" id="productImage">
            </div>
        `;
        form.insertAdjacentHTML("afterbegin", add_elements);
        openModal();
    }
});

closeButton.addEventListener("click", closeModalHandler);

// Aggiungi un evento di resize per gestire il cambiamento della dimensione della finestra
window.addEventListener("resize", function() {
    if (window.innerWidth >= 768) {
        // Modal non visibile su schermi larghi (display: none)
        formSection.style.display = "block";
        document.body.classList.remove("modal-active");
    } else {
        if (formContainer.classList.contains("d-none")) {
            formSection.style.display = "none";
        } else {
            if (articlePane.classList.contains("active")) {
                document.body.classList.add("modal-active");
            }
        }
    }
});

orderButton.addEventListener("click", () => {
    closeModalHandler();
});