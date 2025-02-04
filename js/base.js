const iconProfileButton = document.querySelector("header > nav > div > div:nth-of-type(2) > div > button");
const dropdownMenu = document.querySelector("header > nav > div > div:nth-of-type(2) > div > ul.dropdown-menu");
const searchForm = document.querySelector("header > nav > div > form");
const searchInput = document.getElementById("search-input");
const main = document.querySelector("main");
const notificationSpan = document.querySelector("header > nav > div > div > div > button > span");

function addStyles() {
    document.querySelectorAll("body:not(ul)").forEach(function(element) {
        element.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3))";
    });

    document.querySelectorAll("body > header > nav:first-of-type").forEach(function(element) {
        element.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3))";
    });

    document.querySelectorAll("body > footer").forEach(function(element) {
        element.style.backgroundImage = "linear-gradient(rgba(255, 255, 255, 0.3), rgba(255, 255, 255, 0.3))";
    });
}

function removeStyles() {
    document.querySelectorAll("body:not(ul)").forEach(function(element) {
        element.style.backgroundImage = "";
    });

    document.querySelectorAll("body > header > nav:first-of-type").forEach(function(element) {
        element.style.backgroundImage = "";
    });

    document.querySelectorAll("body > footer").forEach(function(element) {
        element.style.backgroundImage = "";
    });
}

function mostraProdotti(prodottiRicercati, searchValue) {
    let result = `
    <section>
        <h2>Ricerca prodotti: "${searchValue}"</h2>
        <ul class="mt-4 mx-0 mb-2 list-unstyled p-0">
    `;

    for(let i=0; i < prodottiRicercati.length; i++){
        let articolo = `
        <li class="bg-transparent my-3 mx-2">
            <article class="p-3 d-flex flex-column w-100">
                <img class="d-block mx-auto mt-0 mb-2" src="${prodottiRicercati[i]["Nome_immagine"]}" alt="${prodottiRicercati[i]["Nome_prodotto"]}" />
                <a class="text-decoration-none" href="prodotto-singolo.php" aria-label="Vai alla pagina del prodotto singolo">
                    <h3 id="${prodottiRicercati[i]["Di_Codice_prodotto"]}">${prodottiRicercati[i]["Nome_prodotto"]}</h3>
                </a>
                <p>Prezzo: ${prodottiRicercati[i]["Prezzo"]}€</p>
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

iconProfileButton.addEventListener("click", () => {
    if (dropdownMenu.classList.contains('show')) {
        addStyles();
    } else {
        removeStyles();
    }
});

document.addEventListener("click", (event) => {
    if (!dropdownMenu.contains(event.target) && !dropdownMenu.classList.contains("show")) {
        removeStyles();
    }
})


async function getSearchArticles(text) {
    const url = "./api/api-cerca-prodotti.php";
    
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
        const articoli = mostraProdotti(json, text);
        main.innerHTML = articoli;
        const productTitleLink = document.querySelectorAll("main > section > ul > li > article > a");
        attachEventListener(productTitleLink);
    } catch (error) {
        console.error(error);
    }
}


searchForm.addEventListener("submit", function(event) {
    event.preventDefault();
})

searchInput.addEventListener("input", function() {
    const searchValue = searchInput.value.trim();
    if (searchValue.length === 0) {
        window.location.reload();
    } else {
        getSearchArticles(searchValue);
    }
});



async function checkIfLoggedIn() {
    const url = "./api/api-check-login.php";
    try {
        const response = await fetch(url);
        const data = await response.json();
        return data.isLoggedIn;
    } catch (error) {
        console.error('Errore nel controllo del login:', error);
        return false;
    }
}


async function getUnreadNotificationsCount() {
    const url = "./api/api-notification.php";
    try {
        const response = await fetch(url, {
            method: 'POST',
            body: new URLSearchParams({
                'count': "countNotification"
            })
        });
        if (!response.ok) {
            throw new Error("Errore nel recupero delle notifiche");
        }
        const data = await response.json();
        return data.result;
    } catch (error) {
        console.error('Errore nel recupero delle notifiche:', error);
        return 0;
    }
}

async function updateNotificationBadge() {
    const isLoggedIn = await checkIfLoggedIn();
    if (!isLoggedIn) {
        notificationSpan.classList.add('d-none');
        return;
    }

    const unreadCount = await getUnreadNotificationsCount();

    if (unreadCount > 0) {
        notificationSpan.textContent = unreadCount;
        notificationSpan.classList.remove('d-none');
    } else {
        notificationSpan.classList.add('d-none');
    }
}

updateNotificationBadge();