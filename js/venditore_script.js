const addButton = document.querySelector("main > div > div > section > div > button");
const formButtons = document.querySelector("main > div > div > section > div > form > div:last-of-type");
const closeButton = document.querySelector("main > div > div > section > div > form > div:last-of-type > input:first-of-type");
const saveButton = document.querySelector("main > div > div > section > div > form > div:last-of-type > input:last-of-type");
const title = document.querySelector('main > div > div > section > h2');
const formContainer = document.querySelector("main > div > div > section:first-of-type > div");
const formSection = document.querySelector("main > div > div > section:first-of-type");
const articlePane = document.querySelector("main > div > div:first-of-type");
const form = document.querySelector("main > div > div > section > div > form")
const ordersButton = document.querySelector("main > ul > li:last-of-type > button");
const articlesButton = document.querySelector("main > ul > li:first-of-type > button");
const searchBar = document.querySelector("main > div > div > section > div > form > input");

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
    if (document.body.classList.contains("modal-active")) {
        document.body.classList.remove("modal-active");
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

function attachEventListeners(editButton) {
    editButton.forEach((button) => {
        button.addEventListener("click", () => {
            console.log("Premuto edit");
            if (isOpen === false) {
                title.innerText = "Modifica prodotto: (Cintura in pelle)";
                button.disabled = true;
                let edit_elements = `
                    <div class="col-lg-6 mb-3">
                        <label for="productPrice" class="form-label fs-3">Prezzo:</label>
                        <input type="text" class="form-control fs-5" id="productPrice" name="productPrice" />
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="productQuantity" class="form-label fs-3">Disponibilità:</label>
                        <input type="text" class="form-control fs-5" id="productQuantity" name="productQuantity" />
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="productDiscount" class="form-label fs-3">Sconto:</label>
                        <input type="text" class="form-control fs-5" value="0" id="productDiscount" name="productDiscount" />
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="productImage" class="form-label fs-3">Immagine:</label>
                        <input type="file" class="form-control fs-5" id="productImage" name="productImage" />
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="productDescription" class="form-label fs-3">Descrizione:</label>
                        <textarea class="form-control fs-5" id="productDescription" name="productDescription" rows="3" cols="10">Valure di default text area</textarea>
                    </div>
                `;
                form.insertAdjacentHTML("afterbegin", edit_elements);
                openModal();   
            }
        });
    });
}

addButton.addEventListener("click", () => {
    if (addButton.disabled === false && isOpen === false) {
        addButton.disabled = true;
        title.innerText = "Aggiungi prodotto:";
        let add_elements = `
            <div class="col-lg-6 mb-3">
                <label for="productName" class="form-label fs-3">Nome prodotto:</label>
                <input type="text" class="form-control fs-5" id="productName" name="productName" />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productCategory" class="form-label fs-3">Categoria prodotto:</label>
                <input type="text" class="form-control fs-5" id="productCategory" name="productCategory" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productBrand" class="form-label fs-3">Marchio prodotto:</label>
                <input type="text" class="form-control fs-5" id="productBrand" name="productBrand" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productColor" class="form-label fs-3">Colore:</label>
                <input type="text" class="form-control fs-5" id="productColor" name="productColor" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productSize" class="form-label fs-3">Taglia:</label>
                <input type="text" class="form-control fs-5" id="productSize" name="productSize" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productPrice" class="form-label fs-3">Prezzo:</label>
                <input type="text" class="form-control fs-5" id="productPrice" name="productPrice" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productQuantity" class="form-label fs-3">Disponibilità:</label>
                <input type="text" class="form-control fs-5" id="productQuantity" name="productQuantity" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productDiscount" class="form-label fs-3">Sconto:</label>
                <input type="number" class="form-control fs-5" value="0" min="0" max="100" id="productDiscount" name="productDiscount" required />
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productDescription" class="form-label fs-3">Descrizione:</label>
                <textarea class="form-control fs-5" id="productDescription" name="productDescription" rows="3" cols="10" required></textarea>
            </div>
            <div class="col-lg-6 mb-3">
                <label for="productImage" class="form-label fs-3">Immagine:</label>
                <input type="file" class="form-control fs-5" id="productImage" name="productImage" required />
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

// Funzione per generare la lista di articoli
function generaArticoli(articoli) {
    let result = "";
    
    for(let i = 0; i < articoli.length; i++) {
        let articolo = `
            <div class="d-flex justify-content-around border border-dark border-2 mt-3 w-100 p-2">
                <img src="${articoli[i]["Nome_immagine"]}" class="object-fit-cover w-25" alt="${articoli[i]["Nome_immagine"]}" />
                <div class="d-flex flex-column justify-content-center align-items-start">
                    <h5 class="fs-3">${articoli[i]["Nome_prodotto"]}</h5>
                    <p class="fs-4">
                        Prezzo: ${articoli[i]["Prezzo"]}€ - Pezzi rimasti: ${articoli[i]["Disponibilita"]}
                    </p>
                </div>
                <div class="d-flex flex-column justify-content-around">
                    <a class="icon-link fs-4 text-primary" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path
                                d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd"
                                d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </a>
                    <a class="icon-link fs-4 text-danger" href="#" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path
                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </a>
                </div>
            </div>
        `;
        
        result += articolo;
    }
    return result;
}

// Funzione per generare la lista di ordini
function generaOrdini(ordini) {
    let result = "";

    Object.values(ordini).forEach((ordine) => {
    let dettagliHTML = ordine["Dettagli"]
      .map(
        (dettaglio) =>
          `<span class="ms-1">${dettaglio["Nome"]} (${dettaglio["Quantita"]})</span>`
      )
      .join(" - ");

    let row = `
      <li class="list-group-item w-100">
        <h5 class="fs-2">Ordine no. ${ordine["Codice_ordine"]}</h5>
        <p class="d-flex flex-wrap mb-0 fs-4">
          <span class="fw-bold">${ordine["Email_compratore"]} ha ordinato in data (${ordine["Data_ordine"]}):</span>
          ${dettagliHTML}
        </p>
      </li>
    `;

    result += row;
  });

  return result;
}

async function getArticoli() {
    const url = "../api/api-articoli-venditore.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error("Error! Response status: " + response.status);
        }
        const json = await response.json();
        const articoli = generaArticoli(json);
        const articoliList = document.querySelector("main > div > div > section:last-of-type > div:last-of-type");
        articoliList.innerHTML = articoli;
        const editButton = document.querySelectorAll("main > div > div > section > div > div > div > a:first-of-type");
        attachEventListeners(editButton);
    } catch (error) {
        console.error(error);
    }
}

async function getSearchArticles(text) {
    const url = "../api/api-articoli-venditore.php";
    try {
        const response = await fetch(url, { 
            method: "POST", 
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ "search": text })
        } );
        if (!response.ok) {
            throw new Error("Error! Response status: " + response.status);
        }
        const json = await response.json();
        const articoli = generaArticoli(json);
        const articoliList = document.querySelector("main > div > div > section:last-of-type > div:last-of-type");
        articoliList.innerHTML = articoli;
        const editButton = document.querySelectorAll("main > div > div > section > div > div > div > a:first-of-type");
        attachEventListeners(editButton);
    } catch (error) {
        console.error(error);
    }
}

async function getOrdini() {
    const url = "../api/api-ordini-venditore.php";
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error("Error! Response status: " + response.status);
        }
        const json = await response.json();
        const ordini = generaOrdini(json);
        const ordiniList = document.querySelector("main > div > div > div > ul");
        ordiniList.innerHTML = ordini;
    } catch (error) {
        console.error(error);
    }
}

async function addProduct(formData) {
    const url = "../api/api-aggiungi-prodotto.php";
    try {
        const response = await fetch(url, { 
            method: "POST",
            body: formData,
        });
        if (!response.ok) {
            return false;
        }
        const json = await response.json();
        if (json["status"] === "success") {
            console.log("Prodotto aggiunto con successo!");
            return true;    
        } else {
            console.error("Errore nell'aggiunta del prodotto! " + json["message"]);
            return false;
        }
    } catch (error) {
        console.error(error);
        return false;
    }
}

ordersButton.addEventListener("click", () => {
    closeModalHandler();
    getOrdini();
});

articlesButton.addEventListener("click", () => {
    getArticoli();
});

searchBar.addEventListener("input", () => {
    const searchValue = searchBar.value;
    getSearchArticles(searchValue);
})

saveButton.addEventListener("click", (event) => {
    event.preventDefault();
    const form = document.querySelector("main > div > div > section > div > form")
    const formData = new FormData(form);
    addProduct(formData).then((success) => {
        if (success) {
            title.innerText = "Prodotto aggiunto con successo!";
        } else {
            title.innerText = "Errore nell'aggiunta del prodotto!";
        }
    });
    setTimeout(() => {
        closeModalHandler();
    }, 3000);
});

getArticoli();