const editButton = document.querySelectorAll(
    "main > div > div > section > div > div > div > div > a:first-of-type"
);
const addButton = document.querySelector("main > div > div > section > div > button");
const closeButton = document.querySelector("main > div > div > section > div > form > div:last-of-type > input:first-of-type");
const title = document.querySelector('main > div > div section > h1');
const formContainer = document.querySelector("main > div > div > section:first-of-type > div ");
const formSection = document.querySelector("main > div > div > section:first-of-type");

// Apri modal (aggiungere un pulsante per attivarlo, se necessario)
function openModal() {
    if (window.innerWidth < 768) {
        formSection.style.display = "block";
        document.body.classList.add("modal-active");
    }
    title.classList.remove("d-none");
    formContainer.classList.remove("d-none");
}

// Chiudi modal
function closeModalHandler() {
    if (window.innerWidth < 768) {
        formSection.style.display = "none";
        document.body.classList.remove("modal-active");
    }
    title.classList.add("d-none");
    formContainer.classList.add("d-none");
}

editButton.forEach((button) => {
    button.addEventListener("click", () => {
        title.innerText = "Modifica prodotto:";
        openModal();
    });
});

addButton.addEventListener("click", () => {
    title.innerText = "Aggiungi prodotto:";
    openModal();
});

closeButton.addEventListener("click", closeModalHandler);

// Opzionale: chiudi cliccando fuori dal modal
document.addEventListener("click", (event) => {
    if (!formSection.contains(event.target) && formContainer.classList.contains("d-none")) {
        console.log("Premuto fuori dal modal");
        closeModalHandler();
    }
});

// Aggiungi un evento di resize per gestire il cambiamento della dimensione della finestra
window.addEventListener("resize", function() {
    if (window.innerWidth > 768) {
        // Modal non visibile su schermi larghi (display: none)
        formSection.style.display = "block";
    } else {
        if (formContainer.classList.contains("d-none")) {
            formSection.style.display = "none";
        }
    }
});
