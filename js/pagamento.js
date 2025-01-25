const form = document.querySelector("#form");
const error = document.querySelector("main > section > div > div > div:last-of-type");
const pagamento = document.querySelector("main > section > div > div > a");
const cardNumber = document.querySelector("main > section > div > div > form > div:nth-of-type(4) > input");
const expireDate = document.querySelector("main > section > div > div > form > div:nth-of-type(5) > input");
const cvv = document.querySelector("main > section > div > div > form > div:nth-of-type(6) > input");

let dettagli_ordine = {};

function generaRiepilogo(articoli) {
    let riepilogo = "";
    
    for (let i = 0; i < articoli.length; i++) {
        riepilogo += `
            <li class="d-flex w-100 justify-content-between align-items-center">
                <p class="fs-5 m-0">${articoli[i]["Nome_prodotto"]} (${articoli[i]["Quantita_"]}) </p>
                <p class="fs-5 m-0">${(articoli[i]["Prezzo"] - (articoli[i]["Prezzo"] * articoli[i]["Sconto"])) * articoli[i]["Quantita_"]}€</p>
            </li>
        `;
    }
    
    return riepilogo;
}

// Funzione per formattare il numero della carta con trattini ogni 4 cifre
cardNumber.addEventListener("input", (event) => {
    let value = event.target.value.replace(/\D/g, ""); // Rimuove tutto tranne i numeri
    if (value.length > 16) value = value.slice(0, 16); // Limita a 16 cifre
    event.target.value = value.replace(/(.{4})(?=.)/g, "$1-"); // Aggiunge trattini ogni 4 cifre
});

// Funzione per limitare il CVV a 3 cifre
cvv.addEventListener("input", (event) => {
    let value = event.target.value.replace(/\D/g, ""); // Rimuove tutto tranne i numeri
    if (value.length > 3) value = value.slice(0, 3); // Limita a 3 cifre
    event.target.value = value;
});

async function fetchArticoli() {
    const url = "./api/api-prodotti-carrello.php";
    
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
                dettagli_ordine = json["data"];
                const lista = document.querySelector("main > section > div > div:last-of-type > div:first-of-type > ul");
                const pagina = generaRiepilogo(json["data"]);
                lista.innerHTML = pagina;
                const totale = document.querySelector("main > section > div > div:last-of-type > div:nth-last-of-type(2) > p:last-of-type");
                const spedizione = document.querySelector("main > section > div > div:last-of-type > div:nth-of-type(2) > p:last-of-type");
                console.log(json["data"]);
                const subtotale = json["data"].reduce((acc, item) => acc + ((item["Prezzo"] - (item["Prezzo"] * item["Sconto"])) * item["Quantita_"]), 0);
                console.log(subtotale);
                totale.innerHTML = `${(subtotale + parseFloat(spedizione.textContent)).toFixed(2)}€`;
            } else {
                console.error("Errore durante il fetch dei dati. Risposta server:", json["message"]);
            }
        } else {
            console.error("Errore durante il fetch dei dati. Risposta server:", response);
        }
    } catch (error) {
        // Errore di rete o altro problema
        console.error("Errore nella richiesta di rete:", error);
    }
}

async function eseguiOrdine(data) {
    const url = "./api/api-pagamento.php";
    
    try {
        const response = await fetch(url, {
            method: "POST",
            headers: { "Content-Type": "application/json" },
            body: JSON.stringify(data)
        });
        
        let json;
        try {
            json = await response.json();
        } catch (parseError) {
            console.error("Errore nel parsing della risposta JSON:", parseError);
            json = null;
        }
        
        if (response.ok) {
            if (json["status"] === "success") {
                error.innerHTML = `<p class="text-success">${json["message"]}</p>`;
                setTimeout(() => {
                    window.location.href = "./home.php";
                }, 3000);
            } else {
                error.innerHTML = `<p class="text-danger">${json["message"]}</p>`;
                setTimeout(() => {
                    error.innerHTML = "";
                }, 3000);
            }
        } else {
            error.innerHTML = `<p class="text-danger">${response}</p>`;
            setTimeout(() => {
                error.innerHTML = "";
            }, 3000);
        }
        
    } catch (error) {
        console.error("Errore nella richiesta di rete:", error);
    }
} 

pagamento.addEventListener("click", function (event) {
    event.preventDefault(); // Previeni il comportamento di default del link
    // Controlla se il form è valido prima di inviarlo
    if (form.checkValidity()) {
        const formData = new FormData();
        const urlParams = new URLSearchParams(window.location.search);
        const spedizione = urlParams.get("spedizione");
        data = {
            "tipoSpedizione": spedizione,
            "dettagliOrdine": dettagli_ordine
        }
        
        eseguiOrdine(data);
    } else {
        error.innerHTML = `<p class="text-danger">Compila correttamente tutti i campi</p>`;
        setTimeout(() => {
            error.innerHTML = "";
        }, 3000);
    }
});

fetchArticoli();