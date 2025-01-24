function generaListaProdotti(prodotti) {
    let listaProdotti = "";
    for (const prodotto of prodotti) {
        if (prodotto["Taglia"] !== null) {
            taglia = `<p class="fs-4 mb-1">Taglia: ${prodotto["Taglia"]}</p>`
        } else {
            taglia = "";
        }
        
        if (prodotto["Colore"] !== null) {
            colore = `<p class="fs-4 mb-1">Colore: ${prodotto["Colore"]}</p>`
        } else {
            colore = "";
        }
        
        let select = "";
        for (let i = 1; i <= prodotto["Disponibilita"]; i++) {
            select += `<option ${prodotto["Quantita_"] === i ? "selected" : ""} value="${i}">${i}</option>`;
        }
        
        listaProdotti += `
            <li class="d-flex justify-content-around align-items-center p-2 mb-3 w-100" id="${prodotto["Di_Codice_prodotto"]}${prodotto["Codice_prodotto"]}">
                <img src="${prodotto["Nome_immagine"]}" class="object-fit-cover w-25" alt="${prodotto["Nome_prodotto"]}" />
                <div class="d-flex flex-column felx-wrap justify-content-center align-items-start">
                    <h5 class="fs-3 mb-1">${prodotto["Nome_prodotto"]}</h5>
                    <span class="d-flex">
                        <p class="fs-4 mb-1">Quantità: </p>
                        <select class="form-select">
                            ${select}
                        </select>
                    </span>
                    <p class="fs-4 mb-1">Prezzo: ${prodotto["Prezzo"]}€</p>
                    ${taglia}
                    ${colore}
                </div>
                <div class="d-flex flex-column justify-content-around">
                    <a class="icon-link text-danger fs-4" href="#" data-bs-toggle="modal"
                        data-bs-target="#deleteModal">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                            fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                            <path
                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                        </svg>
                    </a>
                </div>
            </li>
            `;
    }

    return listaProdotti;
}

function generaPagina(prodotti) {
    
    const listaProdotti = generaListaProdotti(prodotti);
    let subtotale = 0;
    
    for (const prodotto of prodotti) {
        subtotale += (prodotto["Prezzo"] - (prodotto["Prezzo"] * prodotto["Sconto"])) * prodotto["Quantita_"];
    }
    
    return `
        <section class="overflow-auto">
            <h2 class="fs-1">Carrello</h2>
            <div class="row justify-content-around">
                <div class="col-md-6 d-flex flex-column justify-content-center mb-3">
                    <ul class="list-group">
                        ${listaProdotti ? listaProdotti : '<p class="fs-2 text-primary text-center">Il tuo carrello è vuoto</p>'}
                    </ul>
                </div>
                <div class="col-md-4 h-100 p-3">
                    <h3 class="fs-2 fw-bold">Riepilogo dell'ordine</h3>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <p class="fs-4">Subtotale:</p>
                        <p class="fs-4">${subtotale}€</p>
                    </div>
                    <div class="w-100 border-bottom border-dark mb-3">
                        <p class="fs-4 mb-0">Consegna</p>
                        <div class="form-check d-flex align-items-center ms-3">
                            <input class="form-check-input" type="radio" name="consegna" id="consegnaStandard" value="0" checked />
                            <label class="form-check-label fs-5 ms-1" for="consegnaStandard">
                                Consegna standard (Gratis)
                            </label>
                        </div>
                        <div class="form-check d-flex align-items-center ms-3">
                            <input class="form-check-input" type="radio" name="consegna" id="consegnaExpress" value="10" />
                            <label class="form-check-label fs-5 ms-1" for="consegnaExpress">
                                Consegna express (10.00€)
                            </label>
                        </div>
                    </div>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <p class="fs-4">Totale:</p>
                        <p class="fs-4">${subtotale}€</p>
                    </div>
                    <a href="../php/pagamento.php" class="btn btn-primary w-100 fs-3">Vai al pagamento</a>
                </div>
            </div>
        </section>
    `;
}

function attachEventListeners(select, radio, deleteButtons) {
    select.forEach((selector) => {
        selector.addEventListener('change', async (event) => {
            const url = "../api/api-modifica-carrello.php";
            const [codice_prodotto, ...resto] = event.target.closest('li').id.split("_");
            const codice_versione =  `_${resto.join('_')}`;
            
            try {
                const response = await fetch(url, {
                    method: "POST",
                    body: JSON.stringify({
                        "codice_prodotto": codice_prodotto,
                        "codice_versione": codice_versione,
                        "quantita": event.target.value
                    }),
                });
                
                let json;
                try {
                    // Prova a parsare il JSON
                    json = await response.json();
                } catch (parseError) {
                    console.error("Errore nel parsing della risposta JSON:", parseError);
                    json = null; // Imposta a null se non è parsabile
                }
                
                console.log(`${json["status"]}: ${json["message"]}`);
                caricaCarrello();
            } catch (error) {
                // Errore di rete o altro problema
                console.error("Errore nella richiesta di rete:", error);
            }
        });
    });
    
    radio.forEach((radio) => {
        radio.addEventListener('change', (event) => {
            const totale = document.querySelector("main > section > div> div > div:last-of-type > p:last-of-type");
            const subtotale = document.querySelector("main > section > div> div > div:first-of-type > p:last-of-type");
            const consegna = parseFloat(event.target.value);
            totale.textContent = `${parseFloat(subtotale.textContent) + consegna}€`;
        });
    });
    
    deleteButtons.forEach((button) => {
        button.addEventListener('click', (event) => {
            event.preventDefault();
            console.log("Premuto delete");
            const parentDiv = event.target.closest('li[id]');
            productID = parentDiv.id;
            const deleteButton = deleteModal.querySelector("#deleteModal > div > div > div:last-of-type > button:last-of-type");
            deleteButton.addEventListener('click', (event) => {
                event.preventDefault();
                removeProduct(productID);
            });
        });
    });
}

async function caricaCarrello() {
    const url = "../api/api-prodotti-carrello.php";
    
    try {
        const response = await fetch(url);
        
        let json;
        try {
            // Prova a parsare il JSON
            json = await response.json();
        } catch (parseError) {
            console.error("Errore nel parsing della risposta JSON:", parseError);
            json = null; // Imposta a null se non è parsabile
        }
        
        if (response.ok) {
            if (json["status"] === "success") {
                const main = document.querySelector('main');
                const pagina = generaPagina(json["data"]);
                main.innerHTML = pagina;
                const select = document.querySelectorAll('main select');
                const consegna = document.querySelectorAll('main input[type="radio"]');
                const deleteButton = document.querySelectorAll("main > section > div > div > ul > li > div:last-of-type > a");
                attachEventListeners(select, consegna, deleteButton);
            } else {
                const main = document.querySelector('main');
                const pagina = generaPagina("");
                main.innerHTML = pagina;
            }
        } else {
            console.error("Errore durante il fetch dei dati. Risposta server:", response);
        }
    } catch (error) {
        // Errore di rete o altro problema
        console.error("Errore nella richiesta di rete:", error);
    }
}

async function removeProduct(id, deleteModal) {
    const url = "../api/api-rimuovi-prodotto-carrello.php";
    const [codice_prodotto, ...resto] = id.split("_");
    const codice_versione =  `_${resto.join('_')}`;
    
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify({ 
                "codice_prodotto": codice_prodotto, 
                "codice_versione": codice_versione }),
        });
        
        let json;
        try {
            // Prova a parsare il JSON
            json = await response.json();
        } catch (parseError) {
            console.error("Errore nel parsing della risposta JSON:", parseError);
            json = null; // Imposta a null se non è parsabile
        }
        const deleteModal = document.querySelector("#deleteModal");
        const modal = bootstrap.Modal.getInstance(deleteModal);
        modal.hide();
        console.log(`${json["status"]}: ${json["message"]}`);
        caricaCarrello();
    } catch (error) {
        console.error(error);
    }
}

caricaCarrello();