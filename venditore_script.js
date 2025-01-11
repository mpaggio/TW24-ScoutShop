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

addButton.addEventListener("click", () => {
    if (window.innerWidth > 768) {
        document.querySelector("main > div > div").innerHTML += `
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="addModalLabel">Aggiungi prodotto:</h1>
            </div>
            <div class="modal-body">
                <form action="">
                    <div class="mb-3">
                        <label for="product-name" class="form-label">Nome:</label>
                        <input type="text" class="form-control" id="product-name">
                    </div>
                    <div class="mb-3">
                        <label for="product-price" class="form-label">Prezzo:</label>
                        <input type="text" class="form-control" id="product-price">
                    </div>
                    <div class="mb-3">
                        <label for="product-quantity" class="form-label">Quantità:</label>
                        <input type="text" class="form-control" id="product-quantity">
                    </div>
                    <div class="mb-3">
                        <label for="product-quantity" class="form-label">Sconto:</label>
                        <input type="text" class="form-control" id="product-quantity">
                    </div>
                    <div class="mb-3">
                        <label for="product-quantity" class="form-label">Immagine:</label>
                        <input type="file" class="form-control" id="product-quantity">
                    </div>
                    <div class="mb-3">
                        <label for="product-description" class="form-label">Descrizione:</label>
                        <textarea class="form-control" id="product-description" rows="3"></textarea>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn" data-bs-dismiss="modal">Chiudi</button>
                <button type="button" class="btn">Salva</button>
            </div>
        `;
    }
    console.log("É stato cliccato il bottone modifica");
});
