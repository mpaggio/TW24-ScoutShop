let json;
let color = 0;
let taglia = 0;
let versione;

async function isUserLoggedIn() {
    try {
        const response = await fetch('./api/api-check-login.php');

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const data = await response.json();
        return data.isLoggedIn;
    } catch (error) {
        console.error('Errore:', error);
    }
}

async function inviaDatiProdotto() {
    const loggedIn = await isUserLoggedIn();
    console.log(loggedIn);
    if (!loggedIn) {
        window.location.href = "./login.php";
        return;
    }

    const codiceProdotto = versione[0]["Di_Codice_prodotto"];
    const quantita = document.getElementById("quantita").value;
    const urlApi = "./api/api-prodotto-singolo.php";

    let codiceVersione = "_" + color + "_" + taglia;

    const data = new URLSearchParams();
    data.append('Di_Codice_prodotto', codiceProdotto);
    data.append('Codice_prodotto', codiceVersione);
    data.append('Quantita', quantita);

    try {
        const response = await fetch(urlApi, {
            method: 'POST',
            headers: {'Content-Type': 'application/x-www-form-urlencoded'},
            body: data.toString()
        });

        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }

        const responseData = await response.json();
        console.log('Risposta:', responseData);
    } catch (error) {
        console.error('Errore:', error);
    }
}

function trovaIndiceTaglia(prodotto, taglia) {
    let index = 0;
    prodotto.forEach((versione, indice) => {
        if(versione["Taglia"] === taglia){
            index = indice;
        }
    })
    return index;
}

function generaPaginaProdottoSingolo($prodotto) {

    let index;

    if (color === 0) {
        versione = Object.values($prodotto)[color];
    } else {
        versione = $prodotto[color];
    }

    if (color === 0 && versione[0]["Colore"] !== null){
        color = versione[0]["Colore"];
    } 

    if(taglia === 0 && versione[0]["Taglia"] !== null) {
        taglia = versione[0]["Taglia"];
    }

    if (taglia === 0) {
        index = 0;
    } else {
        index = trovaIndiceTaglia(versione,taglia);
    }
    
    let result = `
        <section>
            <article class="mb-5 text-center bg-transparent border-0 justify-content-around align-items-center d-flex flex-wrap w-100 mx-0 mt-0">
                <img src="${versione[0]["Nome_immagine"]}" alt="${versione[0]["Nome_prodotto"]}" />
                <aside>
                    <h2>${versione[0]["Nome_prodotto"]}</h2>
                    <p><span>Marchio:</span>${versione[0]["Marchio"]}</p>
                    <p><span>Prezzo:</span>${versione[index]["Prezzo"]}€</p>
                    <form>
    `;

    if (versione[0]["Taglia"] !== null) {
    
        result += `
            <label for="taglia">
                <span>Taglia:</span>
                <select name="taglia" id="taglia">
        `;
    

        for($i = 0; $i < versione.length; $i++){
            if ($i === index) {
                result += `
                    <option value="${versione[$i]["Taglia"]}" selected>${versione[$i]["Taglia"]}</option>
                `;
            } else {
                result += `
                    <option value="${versione[$i]["Taglia"]}">${versione[$i]["Taglia"]}</option>
                `;
            }
        }

        result += `
            </select>
                </label>
        `;

    }

    if (versione[0]["Colore"] !== null) {

        result += `
            <label for="colore">
                <span>Colore:</span>
                <select name="colore" id="colore">
        `;

        Object.keys($prodotto).forEach((versione) => {

            if (color === versione) {
                result += `
                    <option value="${versione}" selected>${versione}</option>
                `;    
            } else {
                result += `
                    <option value="${versione}">${versione}</option>
                `;
            }
        });

        result += `
                </select>
            </label>
        `;
    }
                      
    result += `
                        <fieldset> 
                            <legend>Seleziona la quantità</legend>
                            <label for="quantita">
                                <span>Quantità:</span>
                            </label>
                            <button type="button" aria-label="Decrementa quantita">−</button>
                            <input type="number" name="quantita" id="quantita" min="1" max="${versione[0]["Disponibilita"]}" value="1" />
                            <button type="button" aria-label="Incrementa quantita">+</button>
                        </fieldset>
                        <input type="submit" value="Aggiungi al carrello" />
                    </form>
                </aside>
            </article>
            <section class="p-3">
                <h3>Descrizione</h3>
                <p>${versione[0]["Descrizione"]}</p>
            </section>
        </section>
    `;
                            
    return result;
}

function attachEventListenerMinus(button, input) {
    button.addEventListener("click", () => {
        let currentValue = parseInt(input.value);

        if (currentValue > 1) {
            input.value = currentValue - 1;
        }
    });
}

function attachEventListenerPlus(button, input) {
    button.addEventListener("click", () => {
        let currentValue = parseInt(input.value);

        let maxValue = parseInt(input.getAttribute("max"));

        if (currentValue < maxValue) {
            input.value = currentValue + 1;
        }
    });
}

function attachEventListenerColor(select){
    select.addEventListener("change", function(event) {
        color = event.target.value;
        const prodottoSingolo = generaPaginaProdottoSingolo(json);
        const main = document.querySelector("main");
        main.innerHTML = prodottoSingolo;
        const buttonMinus = document.querySelector("main > section > article > aside > form > fieldset > button:first-of-type");
        const buttonPlus = document.querySelector("main > section > article > aside > form > fieldset > button:last-of-type");
        const input = document.querySelector("main > section > article > aside > form > fieldset > input");
        const selectColor = document.querySelector("#colore");
        const selectSize = document.querySelector("#taglia");
        const form = document.querySelector("main > section > article > aside > form");
        attachEventListenerMinus(buttonMinus, input);
        attachEventListenerPlus(buttonPlus, input);
        if (selectColor != null) {
            attachEventListenerColor(selectColor);
        }
        if (selectSize != null) {
            attachEventListenerSize(selectSize);
        }
        attachEventListenerForm(form);
    })
}

function attachEventListenerSize(select){
    select.addEventListener("change", function(event) {
        taglia = event.target.value;
        const prodottoSingolo = generaPaginaProdottoSingolo(json);
        const main = document.querySelector("main");
        main.innerHTML = prodottoSingolo;
        const buttonMinus = document.querySelector("main > section > article > aside > form > fieldset > button:first-of-type");
        const buttonPlus = document.querySelector("main > section > article > aside > form > fieldset > button:last-of-type");
        const input = document.querySelector("main > section > article > aside > form > fieldset > input");
        const selectColor = document.querySelector("#colore");
        const selectSize = document.querySelector("#taglia");
        const form = document.querySelector("main > section > article > aside > form");
        attachEventListenerMinus(buttonMinus, input);
        attachEventListenerPlus(buttonPlus, input);
        if (selectColor != null) {
            attachEventListenerColor(selectColor);
        }
        if (selectSize != null) {
            attachEventListenerSize(selectSize);
        }
        attachEventListenerForm(form);
    })
}

function attachEventListenerForm(form) {
    form.addEventListener("submit", function(event){
        event.preventDefault();
        inviaDatiProdotto();
    })
}

async function caricaProdottoSingolo() {
    
    const urlParamsNomeProdotto = new URLSearchParams(window.location.search).get("Nome_prodotto");
    const urlParamsCodiceProdotto = new URLSearchParams(window.location.search).get("Di_Codice_prodotto");
    const url = "./api/api-prodotto-singolo.php?" + "Di_Codice_prodotto=" + encodeURIComponent(urlParamsCodiceProdotto) + "&Nome_prodotto=" + encodeURIComponent(urlParamsNomeProdotto);
    

    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        json = await response.json();
        const prodottoSingolo = generaPaginaProdottoSingolo(json);
        const main = document.querySelector("main");
        main.innerHTML = prodottoSingolo;
        const buttonMinus = document.querySelector("main > section > article > aside > form > fieldset > button:first-of-type");
        const buttonPlus = document.querySelector("main > section > article > aside > form > fieldset > button:last-of-type");
        const input = document.querySelector("main > section > article > aside > form > fieldset > input");
        const selectColor = document.querySelector("#colore");
        const selectSize = document.querySelector("#taglia");
        const form = document.querySelector("main > section > article > aside > form");
        attachEventListenerMinus(buttonMinus, input);
        attachEventListenerPlus(buttonPlus, input);
        if (selectColor != null) {
            attachEventListenerColor(selectColor);
        }
        if (selectSize != null) {
            attachEventListenerSize(selectSize);
        }
        attachEventListenerForm(form);

    }   catch (error) {
        console.error('Errore nel caricamento dei prodotti: ', error);
    }
};

caricaProdottoSingolo();