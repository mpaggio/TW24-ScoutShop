function generaDatiUtente(datiPersonali) {
    let profilo = `
        <section class="row justify-content-evenly">
            <article class="col-sm-12 col-md-5 mx-0 mb-3 p-3">
                <header>
                    <h2>Dati personali:</h2>
                </header>
                <form action="get">
                    <label for="nome">Nome:</label>
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <input class="w-100" type="text" id="nome" name="nome" value="${datiPersonali["Nome"]}" />
                    </div>
                    <label for="cognome">Cognome:</label>
                    <div class="d-flex justify-content-between align-items-baseline mb-2">
                        <input class="w-100" type="text" id="cognome" name="cognome" value="${datiPersonali["Cognome"]}" />
                    </div>
                    <label for="indirizzo">Indirizzo:</label>
                    <div class="d-flex justify-content-between align-items-baseline mb-2">   
                        <input class="w-100" type="text" id="indirizzo" name="indirizzo" value="${datiPersonali["Indirizzo"]}" />
                    </div>
                    <button type="reset" aria-label="Cancella modifiche">Cancella</button><button type="submit" aria-label="Salva modifiche">Salva</button>
                </form>
            </article>
    `;

    return profilo;
}

function generaOrdiniUtente(ordini) {

    let ordine = `
            <article class="col-sm-12 col-md-5 mx-0 mb-3 p-3">
                <header>
                    <h2>I tuoi Ordini:</h2>
                </header>
    `;

    for(let codiceOrdine in ordini) {
        let ordineSingolo = ordini[codiceOrdine];
        let totalPrize = 0;
        for(let j=0; j < ordineSingolo["Dettagli"].length; j++) {
            totalPrize += ordineSingolo["Dettagli"][j]["Quantita"]*ordineSingolo["Dettagli"][j]["Prezzo_d_acquisto"];
        }

        let ordineSpecifico = `
                <article>
                    <header>
                        <h3>Ordine n°${ordineSingolo["Codice_ordine"]} - Totale: ${totalPrize}€</h3>
                    </header>
        `;

        for(let c=0; c < ordineSingolo["Dettagli"].length; c++) {
            ordineSpecifico += `
                    <div class="d-flex align-items-center py-2 px-0">
                        <img src="${ordineSingolo["Dettagli"][c]["Nome_immagine"]}" alt="${ordineSingolo["Dettagli"][c]["Nome_prodotto"]}" />
                        <div class="p-1">
                            <h4>${ordineSingolo["Dettagli"][c]["Nome_prodotto"]}</h4>
                            <p>Quantità: ${ordineSingolo["Dettagli"][c]["Quantita"]}</p>
                            <p>Prezzo singolo: ${ordineSingolo["Dettagli"][c]["Prezzo_d_acquisto"]}€</p>
                        </div>    
                    </div>
            `;
        }

        ordineSpecifico += `
                </article>
        `;
        ordine += ordineSpecifico;
                    
    }

    ordine += `
            </article>
        </section>
    `;

    return ordine;
}

function attachEventListenerForm(form) {
    form.addEventListener("submit", async function(event){
        event.preventDefault();
        const form = event.target;
        const formData = new FormData(form);

        try {
            const response = await fetch('./api/api-salva-dati-compratore.php', {
                method: 'POST',
                body: formData
            });

            if (!response.ok) {
                throw new Error(`Response status: ${response.status}`);
            }

            const json = await response.json();
            if (json.status === 'success') {
                alert('Dati salvati correttamente');
            } else {
                console.log('Errore nel salvataggio dei dati');
            }
        } catch (error) {
            console.error('Errore nella richiesta: ', error);
        }
    })
}

async function caricaProfiloCompratore() {
    const url = './api/api-profilo-compratore.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const dati = generaDatiUtente(json["datiPersonali"]);
        const ordini = generaOrdiniUtente(json["ordini"]);
        const main = document.querySelector("main");
        main.classList.add("d-flex", "flex-grow-1", "flex-column");
        main.innerHTML = dati + ordini;
        
        document.body.classList.add("vh-100", "h-100", "m-0", "d-flex", "flex-column");
        main.classList.add("d-flex", "flex-column", "flex-grow-1");
        const form = document.querySelector("section > article > form");
        attachEventListenerForm(form);
    } catch (error) {
        console.error('Errore nel caricamento dei prodotti: ', error);
    }
}

caricaProfiloCompratore();