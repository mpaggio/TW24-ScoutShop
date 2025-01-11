const editButton = document.querySelectorAll(
    "main > div > div > section > div > div > div > div > a:first-of-type"
);
const deleteButton = document.querySelectorAll(
    "main > div > div > section > div > div > div > div > a:last-of-type"
);
const addButton = document.querySelector("main > div > div > section > div > button");
const articlesPane = document.querySelector("main > ul > li:first-of-type");
const orderPane = document.querySelector("main > ul > li:last-of-type");
const articleTab = document.querySelector("main > div > div:first-of-type");

editButton.forEach((button) => {
    button.addEventListener("click", () => {
        if (window.innerWidth > 768) {
            document.querySelector("main > div > div > section:first-of-type"). innerHTML = `
                <div class="modal-header mb-2">
                    <h1 class="modal-title fs-5">Modifica prodotto:</h1>
                </div>
                <div class="modal-body border border-dark p-3">
                    <form class="row justify-content-between" action="">
                        <div class="col-lg-6 mb-3">
                            <label for="product-name" class="form-label">Nome prodotto:</label>
                            <input type="text" class="form-control" value="Cintura in pelle" id="product-name">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="product-price" class="form-label">Prezzo:</label>
                            <input type="number" class="form-control" id="product-price">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="product-quantity" class="form-label">Quantità:</label>
                            <input type="number" class="form-control" id="product-quantity">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="product-quantity" class="form-label">Sconto:</label>
                            <input type="number" class="form-control" value="0" id="product-quantity">
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="product-description" class="form-label">Descrizione:</label>
                            <textarea class="form-control" id="product-description"
                                rows="3">Valure di default text area</textarea>
                        </div>
                        <div class="col-lg-6 mb-3">
                            <label for="product-quantity" class="form-label">Immagine:</label>
                            <input type="file" class="form-control" id="product-quantity">
                        </div>
                        <div class="d-flex justify-content-end">
                            <input class="me-3" type="reset" value="Chiudi">
                            <input type="submit" value="Salva">
                        </div>
                    </form>
                </div>
            `;
        }
    })
    console.log("É stato cliccato il bottone modifica");
});

addButton.addEventListener("click", () => {
    if (window.innerWidth > 768) {
        document.querySelector("main > div > div > section:first-of-type").innerHTML = `
            <div class="modal-header mb-2">
                <h1 class="modal-title fs-5" id="addModalLabel">Aggiungi prodotto:</h1>
            </div>
            <div class="modal-body border border-dark p-3">
                <form class="row justify-content-between" action="">
                    <div class="col-lg-6 mb-3">
                        <label for="product-name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" value="Fazzolettone scozzese" id="product-name">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="product-price" class="form-label">Prezzo:</label>
                        <input type="number" class="form-control" id="product-price">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="product-quantity" class="form-label">Quantità:</label>
                        <input type="number" class="form-control" id="product-quantity">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="product-quantity" class="form-label">Sconto:</label>
                        <input type="number" class="form-control" value="0" id="product-quantity">
                    </div>
                    <div class="col-lg-6 mb-3">
                        <label for="product-description" class="form-label">Descrizione:</label>
                        <textarea class="form-control" id="product-description" rows="3">Valore di default della textarea</textarea>
                    </div>
                    <div class="d-flex justify-content-end">
                        <input class="me-3" type="reset" value="Chiudi">
                        <input type="submit" value="Salva">
                    </div>
                </form>
            </div>
        `;
    }
    console.log("É stato cliccato il bottone modifica");
});
