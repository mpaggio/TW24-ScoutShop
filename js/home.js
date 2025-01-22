function generaProdottiCasuali(prodotti) {
    let result = `
    <section>
        <h2>Prodotti casuali</h2>
        <ul class="mt-4 mx-0 mb-2 list-unstyled p-0">
    `;

    for(let i=0; i < prodotti.length; i++){
        let articolo = `
        <li class="bg-transparent my-3 mx-2">
            <article class="p-3 d-flex flex-column w-100">
                <img class="d-block mx-auto mt-0 mb-2" src="${prodotti[i]["Nome_immagine"]}" alt="${prodotti[i]["Nome_prodotto"]}" />
                <a class="text-decoration-none" href="prodotto-singolo.html" aria-label="Vai alla pagina del prodotto singolo">
                    <h3>${prodotti[i]["Nome_prodotto"]}</h3>
                </a>
                <p>Prezzo: ${prodotti[i]["Prezzo"]}€</p>
            </article>
        </li>
        `;
        result += articolo;
    }

    result += `
        </ul>
    </section>
    `;

    console.log(result);
    return result;
}

function generaProdottiPiuVenduti(prodotti) {
    let result = `
    <section>
        <h2>Prodotti più venduti</h2>
        <ul class="mt-4 mx-0 mb-2 list-unstyled p-0">
    `;

    for(let i=0; i < prodotti.length; i++){
        let articolo = `
        <li class="bg-transparent my-3 mx-2">
            <article class="p-3 d-flex flex-column w-100">
                <img class="w-100 d-block mx-auto mt-0 mb-2" src="${prodotti[i]["Nome_immagine"]}" alt="${prodotti[i]["Nome_prodotto"]}" />
                <a class="text-decoration-none" href="prodotto-singolo.html" aria-label="Vai alla pagina del prodotto singolo">
                    <h3>${prodotti[i]["Nome_prodotto"]}</h3>
                </a>
                <p>Prezzo: ${prodotti[i]["Prezzo"]}€</p>
            </article>
        </li>
        `;
        result += articolo;
    }

    result += `
        </ul>
    </section>
    `;
    return result;
}


async function caricaProdotti() {
    const url = '../api/api-prodotti.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const prodottiCasuali = generaProdottiCasuali(json["articoliCasuali"]);
        const prodottiPiuVenduti = generaProdottiPiuVenduti(json["articoliPiuVenduti"]);
        const main = document.querySelector("main");
        main.innerHTML += prodottiPiuVenduti;
        main.innerHTML += prodottiCasuali;
    } catch (error) {
        console.error('Errore nel caricamento dei prodotti: ', error);
    }
}

caricaProdotti();

