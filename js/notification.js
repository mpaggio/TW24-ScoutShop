function generaNotifiche(notifiche, isVenditore) {
    let result = `
        <section>
            <div class="d-flex justify-content-between align-items-baseline my-0 mx-2">
                <h1 class="mb-0">Notifiche:</h1>
                <button class="bg-transparent border-0 mb-0" aria-label="Segna come letto">Leggi tutto</button>
            </div>
            <ul class="d-block pl-0 list-unstyled mt-4 mb-0 mx-3">
    `;

    for(let i=0; i < notifiche.length; i++){

        let message = isVenditore ? `${notifiche[i]["E_mail_compratore"]} ha effettuato un nuovo ordine (codice: ${notifiche[i]["Codice_ordine"]})!` : `Ordine n° ${notifiche[i]["Codice_ordine"]} effettuato con successo! Clicca per andare alla pagina degli ordini`
        let colorClass = "";
        
        if ((isVenditore && notifiche[i]["LettoVenditoreYN"] === "1") || (!isVenditore && notifiche[i]["LettoCompratoreYN"] === "1")) {
            colorClass = "bg-light";
        }

        let notifica = `
            <li class="mb-3 p-2 ${colorClass}">
                <article>
                    <h2 id="${notifiche[i]["Codice_ordine"]}" class="fw-bold mb-0 fs-6">${message}</h2>
                    <div class="d-flex justify-content-between align-items-center mt-3">
                        <p class="m-0">${notifiche[i]["Data_ordine"]}</p>
                        <a href="" class="text-danger" title="Elimina notifica">
                            <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor" class="bi bi-trash3" viewBox="0 0 16 16">
                                <path d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5M11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47M8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5" />
                            </svg>
                        </a>
                    </div>
                </article>
            </li>
        `;
        result += notifica;
    }

    result += ` 
            </ul>
        </section>
    `;

    return result;
}

function attachEventListenerReadAll(leggiTuttoButton) {
    leggiTuttoButton.addEventListener("click", async function(event){
        event.preventDefault();
        try {
            const response = await fetch('./api/api-notification.php', {
                method: 'POST',
                body: new URLSearchParams({
                    'action': 'leggiTutto'
                })
            });

            const json = await response.json();

            if (json.status === 'success') {
                console.log('Tutte le notifiche sono state segnate come lette');
                window.location.reload();
            } else {
                console.log('Errore nel segnare le notifiche come lette');
            }
        } catch (error) {
            console.error('Errore nella richiesta:', error);
        }
    });
}

function attachEventListenerDeleteNotify(cancellaLinks) {
    cancellaLinks.forEach((link) => {
        link.addEventListener("click", async function(event) {
            event.preventDefault();
            const idNotifica = link.closest("li").querySelector("h2").getAttribute("id");
            try {
                const response = await fetch('./api/api-notification.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        'id_notifica': idNotifica
                    })
                });

                const json = await response.json();

                if (json.status === 'success') {
                    console.log('Notifica eliminata con successo');
                    window.location.reload();
                } else {
                    console.log('Errore nell\'eliminazione della notifica');
                }
            } catch (error) {
                console.error('Errore nella richiesta:', error);
            }
        });
    });
}

function attachEventListenerViewNotify(notifies){
    notifies.forEach((notify) => {
        notify.addEventListener("click", async function(event){
            event.preventDefault();
            const idNotifica = notify.getAttribute("id");
            try {
                const response = await fetch('./api/api-notification.php', {
                    method: 'POST',
                    body: new URLSearchParams({
                        'view': idNotifica
                    })
                });

                const json = await response.json();

                if (json.status === 'success') {
                    console.log('Notifica visualizzata con successo');
                    if (json.venditore) {
                        window.location.href = "./dashboard.php";
                    } else {
                        window.location.href = "./profilo-compratore.php";
                    }
                } else {
                    console.log('Errore nella visualizzazione della notifica');
                }
            } catch (error) {
                console.error('Errore nella richiesta:', error);
            }
        })
    })
}

async function caricaNotifiche() {
    const url = './api/api-notification.php';
    try {
        const response = await fetch(url);
        if (!response.ok) {
            throw new Error(`Response status: ${response.status}`);
        }
        const json = await response.json();
        const notifiche = generaNotifiche(json["notifiche"], json["venditore"]);
        const main = document.querySelector("main");
        const footer = document.querySelector("footer");
        main.innerHTML = notifiche;
        if (json["venditore"]){
            document.body.classList.remove("vh-100", "h-100", "m-0", "d-flex", "flex-column");
            main.classList.remove("container-fluid", "flex-grow-1", "overflow-hidden");
            footer.classList.add("fixed-bottom");
        }
        const leggiTutto = document.querySelector("main > section > div > button");
        const cancella = document.querySelectorAll("main > section > ul > li > article > div > a");
        const liNotifica = document.querySelectorAll("main > section > ul > li > article > h2");
        attachEventListenerReadAll(leggiTutto);
        attachEventListenerDeleteNotify(cancella);
        attachEventListenerViewNotify(liNotifica);
    } catch (error) {
        console.error('Errore nel caricamento dei prodotti: ', error);
    }
}

caricaNotifiche();