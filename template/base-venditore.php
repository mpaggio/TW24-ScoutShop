<!DOCTYPE html>
<html lang="it">

<head>
    <title>Scout Shop - Dashboard Venditore</title>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="../css/unico-style.css">
</head>

<body class="vh-100 h-100 m-0 d-flex flex-column">
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <a class="navbar-brand" href="home-buyer.html">
                        <img src="../img/ScoutShop_Logo6.png" alt="Logo" class="d-inline-block align-text-top" />
                    </a>
                </div>
                <div class="d-flex justify-content-between">
                    <div class="btn-group">
                        <button class="icon-link fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Apri/Chiudi menu profilo utente">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-circle col-md-1"
                                viewBox="0 0 16 16">
                                <title>Profile button</title>
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle">1</span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mt-3">
                            <li><a class="dropdown-item" href="profilo-venditore.html" aria-label="Vai al profilo">Profilo</a></li>
                            <li><a class="dropdown-item" href="notification.html" aria-label="Vai alle notifiche">Notifiche</a></li>
                            <li><hr class="dropdown-divider" aria-hidden="true"></li>
                            <li><a class="dropdown-item" href="home-buyer.html" aria-label="Esci dal profilo">Log out</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </nav>
    </header>
    <main class="container-fluid d-flex flex-column flex-grow-1 overflow-hidden p-3">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary active fs-4" id="articles-tab" data-bs-toggle="tab"
                    data-bs-target="#articles-tab-pane" type="button" role="tab" aria-controls="articles-tab-pane"
                    aria-selected="true">Articoli</button>
            </li>
            <li class="nav-item" role="presentation">
                <button class="nav-link text-primary fs-4" id="orders-tab" data-bs-toggle="tab" data-bs-target="#orders-tab-pane"
                    type="button" role="tab" aria-controls="orders-tab-pane" aria-selected="false">Ordini</button>
            </li>
        </ul>
        <div class="tab-content h-100 overflow-hidden bg-light" id="myTabContent">
            <div class="h-100 tab-pane fade show active h-100 p-4 row justify-content-around" id="articles-tab-pane" role="tabpanel"
                aria-labelledby="articles-tab" tabindex="0">
                <section class="col-md-5 p-2 bg-light text-primary">
                    <h2 class="d-none fs-1"></h2>
                    <div class="d-none border border-dark border-2 p-3">
                        <form class="row justify-content-between" enctype="multipart/form-data">
                            <div class="d-flex justify-content-end">
                                <input class="btn btn-secondary me-3 fs-5" type="reset" value="Chiudi">
                                <input class="btn btn-primary fs-5" type="submit" value="Salva">
                            </div>
                        </form>
                    </div>
                </section>
                <section class="h-100 col-md-5 overflow-auto p-2">
                    <div class="d-flex justify-content-between mb-2">
                        <form class="d-flex flex-grow-1 me-3 fs-4" role="search">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search">
                        </form>
                        <button class="btn btn-primary fs-4">Aggiungi</button>
                    </div>
                    <div class="d-flex flex-wrap justify-content-between w-100">
                        
                    </div>
                </section>
            </div>
            <div class="tab-pane justify-content-center fade h-100 overflow-hidden p-3" id="orders-tab-pane" role="tabpanel"
                aria-labelledby="orders-tab" tabindex="0">
                <div class="container d-flex flex-column h-100 overflow-auto">
                    <ul class="list-group list-group-flush align-items-center border border-dark border-2">
                        
                    </ul>
                </div>
            </div>
        </div>
    </main>
    <footer class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
        <a href="" class="text-decoration-none">Aiuto</a>
        <div class="d-flex flex-wrap flex-column justify-content-end">
            <a href="mailto:orazio.spina@studio.unibo.it" class="text-decoration-none">orazio.spina@studio.unibo.it</a>
            <a href="mailto:marco.paggetti@studio.unibo.it"
                class="text-decoration-none">marco.paggetti@studio.unibo.it</a>
        </div>
    </footer>

    <!-- Modals -->
    <!-- Delete article modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-1" id="deleteModalLabel">Elimina articolo</h1>
                </div>
                <div class="modal-body fs-3">
                    Vuoi eliminare l'articolo "Cintura in pelle" dalla lista?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal" autofocus>No</button>
                    <button type="button" class="btn btn-danger fs-3">Si</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz"
        crossorigin="anonymous"></script>
    <script src="../js/venditore_script.js"></script>
</body>

</html>