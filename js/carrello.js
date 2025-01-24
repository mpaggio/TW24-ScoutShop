

function caricaCarrello() {
    const main = document.querySelector('main');
    main.innerHTML = `
        <section>
            <h2 class="fs-1">Carrello</h2>
            <div class="row justify-content-around">
                <div class="col-md-6 mb-3">
                    <ul class="list-group">
                       <li class="d-flex justify-content-around align-items-center p-2 mb-3 w-100">
                            <img src="./img/ScoutShop_Logo5.png" class="img-fluid rounded-start w-25" alt="Product image" />
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <h5 class="fs-3 mb-1">Fazzolettone a quadri</h5>
                                <span class="d-flex">
                                    <p class="fs-4 mb-1">Quantità: </p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                    </select>
                                </span>
                                <p class="fs-4 mb-1">Prezzo: 45$</p>
                                <p class="fs-4 mb-1">Taglia: XXL</p>
                            </div>
                            <div>
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
                        <li class="d-flex justify-content-around align-items-center p-2 mb-3 w-100">
                            <img src="./img/ScoutShop_Logo5.png" class="img-fluid rounded-start w-25" alt="Product image" />
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <h5 class="fs-3 mb-1">Fazzolettone a quadri</h5>
                                <span class="d-flex">
                                    <p class="fs-4 mb-1">Quantità: </p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                    </select>
                                </span>
                                <p class="fs-4 mb-1">Prezzo: 45$</p>
                                <p class="fs-4 mb-1">Taglia: XXL</p>
                            </div>
                            <div>
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
                        <li class="d-flex justify-content-around align-items-center p-2 mb-3 w-100">
                            <img src="./img/ScoutShop_Logo5.png" class="img-fluid rounded-start w-25" alt="Product image" />
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <h5 class="fs-3 mb-1">Fazzolettone a quadri</h5>
                                <span class="d-flex">
                                    <p class="fs-4 mb-1">Quantità: </p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                    </select>
                                </span>
                                <p class="fs-4 mb-1">Prezzo: 45$</p>
                                <p class="fs-4 mb-1">Taglia: XXL</p>
                            </div>
                            <div>
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
                        <li class="d-flex justify-content-around align-items-center p-2 mb-3 w-100">
                            <img src="./img/ScoutShop_Logo5.png" class="img-fluid rounded-start w-25" alt="Product image" />
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <h5 class="fs-3 mb-1">Fazzolettone a quadri</h5>
                                <span class="d-flex">
                                    <p class="fs-4 mb-1">Quantità: </p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                    </select>
                                </span>
                                <p class="fs-4 mb-1">Prezzo: 45$</p>
                                <p class="fs-4 mb-1">Taglia: XXL</p>
                            </div>
                            <div>
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
                        <li class="d-flex justify-content-around align-items-center p-2 mb-3 w-100">
                            <img src="./img/ScoutShop_Logo5.png" class="img-fluid rounded-start w-25" alt="Product image" />
                            <div class="d-flex flex-column justify-content-center align-items-start">
                                <h5 class="fs-3 mb-1">Fazzolettone a quadri</h5>
                                <span class="d-flex">
                                    <p class="fs-4 mb-1">Quantità: </p>
                                    <select class="form-select" aria-label="Default select example">
                                        <option selected value="1">1</option>
                                        <option value="2">2</option>
                                        <option value="3">3</option>
                                        <option value="3">4</option>
                                        <option value="3">5</option>
                                    </select>
                                </span>
                                <p class="fs-4 mb-1">Prezzo: 45$</p>
                                <p class="fs-4 mb-1">Taglia: XXL</p>
                            </div>
                            <div>
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
                    </ul>
                </div>
                <div class="col-md-4 h-100 p-3">
                    <h3 class="fs-2 fw-bold">Riepilogo dell'ordine</h3>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <p class="fs-4">Subtotale:</p>
                        <p class="fs-4">200.00$</p>
                    </div>
                    <div class="w-100 border-bottom border-dark mb-3">
                        <p class="fs-4 mb-0">Consegna</p>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="consegna" id="consegnaStandard" checked />
                            <label class="form-check-label fs-5" for="consegnaStandard">
                                Consegna standard (Gratis)
                            </label>
                        </div>
                        <div class="form-check ms-3">
                            <input class="form-check-input" type="radio" name="consegna" id="consegnaExpress" />
                            <label class="form-check-label fs-5" for="consegnaExpress">
                                Consegna express (10.00$)
                            </label>
                        </div>
                    </div>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <p class="fs-4">Totale:</p>
                        <p class="fs-4">200.00$</p>
                    </div>
                    <a href="./pagamento.html" class="btn btn-primary w-100 fs-3">Vai al pagamento</a>
                </div>
            </div>
        </section>
    `;
    document.body.innerHTML += `
        <!-- Modals -->
        <!-- Delete article modal -->
        <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
            <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-1" id="deleteModalLabel">Elimina articolo</h1>
                    </div>
                    <div class="modal-body fs-3">
                        Vuoi eliminare l'articolo dal carrello?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal" autofocus>No</button>
                        <button type="button" class="btn btn-danger fs-3">Si</button>
                    </div>
                </div>
            </div>
        </div>
    `;
}

caricaCarrello();