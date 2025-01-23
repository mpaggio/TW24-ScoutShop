const categoria = new URLSearchParams(window.location.search).get("Categoria");

function generaProdottiDiCategoria(prodotti) {

    console.log(prodotti);

    let result = `
    <section>
        <h2>Prodotti (${categoria})</h2>
        <ul class="mt-4 mx-0 mb-2 list-unstyled p-0">
    `;

    for(let i=0; i < prodotti.length; i++){
        let articolo = `
        <li class="bg-transparent my-3 mx-2">
            <article class="p-3 d-flex flex-column w-100">
                <img class="d-block mx-auto mt-0 mb-2" src="${prodotti[i]["Nome_immagine"]}" alt="${prodotti[i]["Nome_prodotto"]}" />
                <a class="text-decoration-none" href="prodotto-singolo.php" aria-label="Vai alla pagina del prodotto singolo">
                    <h3 id="${prodotti[i]["Di_Codice_prodotto"]}">${prodotti[i]["Nome_prodotto"]}</h3>
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


function attachEventListener(productTitleLink) {
    productTitleLink.forEach((link) => {
        link.addEventListener("click", (event) => {
            event.preventDefault();
            const codiceProdotto = link.querySelector("h3").getAttribute("id");
            const nomeProdotto = link.querySelector("h3").innerText;
            window.location.href = `prodotto-singolo.php?Di_Codice_prodotto=${encodeURIComponent(codiceProdotto)}&Nome_prodotto=${encodeURIComponent(nomeProdotto)}`;
        });
    });
}


async function caricaProdottiCategoria() {
    const url = `../api/api-prodotti-categoria.php?Categoria=${encodeURIComponent(categoria)}`;
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const prodottiPerCategoria = generaProdottiDiCategoria(json);
        const main = document.querySelector("main");
        main.innerHTML += prodottiPerCategoria;
        const productTitleLink = document.querySelectorAll("main > section > ul > li > article > a");
        attachEventListener(productTitleLink);
    } catch (error) {
        console.error('Errore nel caricamento dei prodotti: ', error);
    }
}

caricaProdottiCategoria();

