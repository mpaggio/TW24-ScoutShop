<!DOCTYPE html>
<html lang="it">
<head>
    <title><?php echo $templateParams["titolo"]; ?></title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="container-fluid">
                <div class="d-flex align-items-center">
                    <!-- Burger icon -->
                    <button class="icon-link fs-4 me-4" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar" aria-label="Apri menu di navigazione laterale">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-list d-flex col-md-1" viewBox="0 0 16 16">
                            <title>Menu</title>
                            <path d="M1 3h14a1 1 0 1 1 0 2H1a1 1 0 1 1 0-2zm0 4h14a1 1 0 1 1 0 2H1a1 1 0 1 1 0-2zm0 4h14a1 1 0 1 1 0 2H1a1 1 0 1 1 0-2z" />
                        </svg>
                    </button>
                    <!-- Lateral offcanvas -->
                    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
                        <div class="offcanvas-header">
                            <h2 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h2>
                            <button type="button" data-bs-dismiss="offcanvas" aria-label="Chiudi menu di navigazione laterale" class="ms-auto">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="none" stroke="currentColor" class="bi bi-x-lg" viewBox="0 0 16 16">
                                    <title>Chiudi</title>
                                    <path d="M2 2l12 12M14 2L2 14" stroke-width="2" />
                                </svg>
                            </button>
                        </div>
                        <div class="offcanvas-body accordion accordion-flush" id="accordionFlushExample">
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <a class="accordion-button collapsed" href="./home.php" aria-label="Vai alla home">Home</a>
                                </h2>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo" aria-label="Apri/Chiudi lista abbigliamento">
                                    Abbigliamento
                                        <svg class="bi bi-chevron-down ms-auto svg-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 9.293l5.646-4.647a.5.5 0 0 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5a.5.5 0 0 1 0-.708z" stroke-width="2" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="flush-collapseTwo" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="accordion accordion-flush">
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Felpe" aria-label="Vai alla pagina con articoli felpe">Felpe</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Giacche" aria-label="Vai alla pagina con articoli giacche">Giacche</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Magliette" aria-label="Vai alla pagina con articoli magliette">Magliette</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Ponci" aria-label="Vai alla pagina con articoli ponci">Ponci</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseTwo" aria-label="Apri/Chiudi lista attrezzatura">
                                    Attrezzatura
                                        <svg class="bi bi-chevron-down ms-auto svg-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 9.293l5.646-4.647a.5.5 0 0 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5a.5.5 0 0 1 0-.708z" stroke-width="2" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="flush-collapseThree" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="accordion accordion-flush">
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Borracce" aria-label="Vai alla pagina con articoli borracce">Borracce</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Cucina" aria-label="Vai alla pagina con articoli cucina">Cucina</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Illuminazione" aria-label="Vai alla pagina con articoli illuminazione">Illuminazione</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Materassini" aria-label="Vai alla pagina con articoli materassini">Materassini</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Sacchi%20a%20pelo" aria-label="Vai alla pagina con articoli sacchi a pelo">Sacchi a pelo</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Tende" aria-label="Vai alla pagina con articoli tende">Tende</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Zaini" aria-label="Vai alla pagina con articoli zaini">Zaini</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFour" aria-expanded="false" aria-controls="flush-collapseThree" aria-label="Apri/Chiudi lista divisa">
                                    Divisa
                                        <svg class="bi bi-chevron-down ms-auto svg-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 9.293l5.646-4.647a.5.5 0 0 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5a.5.5 0 0 1 0-.708z" stroke-width="2" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="flush-collapseFour" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="accordion accordion-flush">
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Calzettoni" aria-label="Vai alla pagina con articoli calzettoni">Calzettoni</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Camicie" aria-label="Vai alla pagina con articoli camicie">Camicie</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Cinture" aria-label="Vai alla pagina con articoli cinture">Cinture</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Distintivi" aria-label="Vai alla pagina con articoli distintivi">Distintivi</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Fazzolettoni" aria-label="Vai alla pagina con articoli fazzolettoni">Fazzolettoni</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Pantaloncini" aria-label="Vai alla pagina con articoli pantaloncini">Pantaloncini</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseFive" aria-expanded="false" aria-controls="flush-collapseFive" aria-label="Apri/Chiudi lista editoria">
                                    Editoria
                                        <svg class="bi bi-chevron-down ms-auto svg-chevron" xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" viewBox="0 0 16 16">
                                            <path d="M1.646 4.646a.5.5 0 0 1 .708 0L8 9.293l5.646-4.647a.5.5 0 0 1 .708.708l-6 5a.5.5 0 0 1-.708 0l-6-5a.5.5 0 0 1 0-.708z" stroke-width="2" />
                                        </svg>
                                    </button>
                                </h2>
                                <div id="flush-collapseFive" class="accordion-collapse collapse" data-bs-parent="#accordionFlushExample">
                                    <div class="accordion-body">
                                        <div class="accordion accordion-flush">
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Cartine" aria-label="Vai alla pagina con articoli cartine">Cartine</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Manuali%20Scout" aria-label="Vai alla pagina con articoli manuali scout">Manuali Scout</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Spiritualità%20Scout" aria-label="Vai alla pagina con articoli spiritualità scout">Spiritualità Scout</a>
                                            </div>
                                            <div class="accordion-item">
                                                <a href="./prodotti-categoria.php?Categoria=Tecniche%20Scout" aria-label="Vai alla pagina con articoli tecniche scout">Tecniche Scout</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="accordion-item">
                                <h2 class="accordion-header">
                                    <a class="accordion-button collapsed" href="./help.php" aria-label="Vai alla pagina supporto/aiuto">
                                        Aiuto
                                        <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" fill="currentColor" class="bi bi-question-circle ms-1" viewBox="0 0 16 16">
                                            <path d="M8 15A7 7 0 1 1 8 1a7 7 0 0 1 0 14m0 1A8 8 0 1 0 8 0a8 8 0 0 0 0 16" />
                                            <path d="M5.255 5.786a.237.237 0 0 0 .241.247h.825c.138 0 .248-.113.266-.25.09-.656.54-1.134 1.342-1.134.686 0 1.314.343 1.314 1.168 0 .635-.374.927-.965 1.371-.673.489-1.206 1.06-1.168 1.987l.003.217a.25.25 0 0 0 .25.246h.811a.25.25 0 0 0 .25-.25v-.105c0-.718.273-.927 1.01-1.486.609-.463 1.244-.977 1.244-2.056 0-1.511-1.276-2.241-2.673-2.241-1.267 0-2.655.59-2.75 2.286m1.557 5.763c0 .533.425.927 1.01.927.609 0 1.028-.394 1.028-.927 0-.552-.42-.94-1.029-.94-.584 0-1.009.388-1.009.94" />
                                        </svg>
                                    </a>
                                </h2>
                            </div>
                        </div>
                    </div>
                    <a class="navbar-brand" href="home.php">
                        <img src="./img/ScoutShop_Logo6.png" alt="Logo" class="d-inline-block align-text-top" />
                    </a>
                </div>
                <div class="d-flex justify-content-between">
                    <a class="icon-link fs-4 me-4" href="./carrello.php" aria-label="Vai al carrello">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-cart3 d-flex col-md-1"
                            viewBox="0 0 16 16">
                            <title>Cart button</title>
                            <path
                                d="M0 1.5A.5.5 0 0 1 .5 1H2a.5.5 0 0 1 .485.379L2.89 3H14.5a.5.5 0 0 1 .49.598l-1 5a.5.5 0 0 1-.465.401l-9.397.472L4.415 11H13a.5.5 0 0 1 0 1H4a.5.5 0 0 1-.491-.408L2.01 3.607 1.61 2H.5a.5.5 0 0 1-.5-.5M3.102 4l.84 4.479 9.144-.459L13.89 4zM5 12a2 2 0 1 0 0 4 2 2 0 0 0 0-4m7 0a2 2 0 1 0 0 4 2 2 0 0 0 0-4m-7 1a1 1 0 1 1 0 2 1 1 0 0 1 0-2m7 0a1 1 0 1 1 0 2 1 1 0 0 1 0-2" />
                        </svg>
                    </a>
                    <div class="btn-group">
                        <button class="icon-link fs-4" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Apri/Chiudi menu profilo utente">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="white" class="bi bi-person-circle col-md-1"
                                viewBox="0 0 16 16">
                                <title>Profile button</title>
                                <path d="M11 6a3 3 0 1 1-6 0 3 3 0 0 1 6 0" />
                                <path fill-rule="evenodd"
                                    d="M0 8a8 8 0 1 1 16 0A8 8 0 0 1 0 8m8-7a7 7 0 0 0-5.468 11.37C3.242 11.226 4.805 10 8 10s4.757 1.225 5.468 2.37A7 7 0 0 0 8 1" />
                            </svg>
                            <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle d-flex align-items-center justify-content-center"></span>
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end mt-3">
                            <li><a class="dropdown-item" href="./profilo-compratore.php" aria-label="Vai al profilo">Profilo</a></li>
                            <li><a class="dropdown-item" href="./notification.php" aria-label="Vai alle notifiche">Notifiche</a></li>
                            <li><hr class="dropdown-divider" aria-hidden="true"></li>
                            <?php
                                if (isset($_SESSION["email"])) {
                                    echo '<li><a class="dropdown-item" href="./api/api-logout.php" aria-label="Esci dal profilo">Log out</a></li>';
                                } else {
                                    echo '<li><a class="dropdown-item" href="./login.php" aria-label="Esci dal profilo">Log in</a></li>';
                                }
                            ?>
                            
                        </ul>
                    </div>
                </div>
                <form class="d-flex flex-grow-1" role="search">
                    <label for="search-input" class="visually-hidden">Campo di ricerca</label>
                    <input id="search-input" class="form-control" type="search" placeholder="Search" aria-label="Campo di ricerca" />
                </form>
            </div>
        </nav>
        <nav>
            <ul>
                <li class="nav-item">
                    <div class="dropdown">
                        <a class="btn fs-6 text-decoration-none dropdown-toggle" href="home.php" aria-label="Vai alla home">
                            Home
                        </a>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn fs-6 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Apri/Chiudi lista abbigliamento">
                            Abbigliamento
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Felpe" aria-label="Vai alla pagina con articoli felpe">Felpe</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Giacche" aria-label="Vai alla pagina con articoli giacche">Giacche</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Magliette" aria-label="Vai alla pagina con articoli magliette">Magliette</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Ponci" aria-label="Vai alla pagina con articoli ponci">Ponci</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn fs-6 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Apri/Chiudi lista attrezzatura">
                            Attrezzatura
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Borracce" aria-label="Vai alla pagina con articoli borracce">Borracce</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Cucina" aria-label="Vai alla pagina con articoli cucina">Cucina</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Illuminazione" aria-label="Vai alla pagina con articoli illuminazione">Illuminazione</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Materassini" aria-label="Vai alla pagina con articoli materassini">Materassini</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Sacchi%20a%20pelo" aria-label="Vai alla pagina con articoli sacchi a pelo">Sacchi a pelo</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Tende" aria-label="Vai alla pagina con articoli tende">Tende</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Zaini" aria-label="Vai alla pagina con articoli zaini">Zaini</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn fs-6 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Apri/Chiudi lista divisa">
                            Divisa
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Calzettoni" aria-label="Vai alla pagina con articoli calzettoni">Calzettoni</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Camicie" aria-label="Vai alla pagina con articoli camicie">Camicie</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Cinture" aria-label="Vai alla pagina con articoli cinture">Cinture</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Distintivi" aria-label="Vai alla pagina con articoli distintivi">Distintivi</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Fazzolettoni" aria-label="Vai alla pagina con articoli fazzolettoni">Fazzolettoni</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Pantaloncini" aria-label="Vai alla pagina con articoli pantaloncini">Pantaloncini</a></li>
                        </ul>
                    </div>
                </li>
                <li class="nav-item">
                    <div class="dropdown">
                        <button class="btn fs-6 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" aria-label="Apri/Chiudi lista editoria">
                            Editoria
                        </button>
                        <ul class="dropdown-menu dropdown-menu-end">
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Cartine" aria-label="Vai alla pagina con articoli cartine">Cartine</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Manuali%20Scout" aria-label="Vai alla pagina con articoli manuali scout">Manuali Scout</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Spiritualità%20Scout" aria-label="Vai alla pagina con articoli spiritualità scout">Spiritualità Scout</a></li>
                            <li><a class="dropdown-item" href="./prodotti-categoria.php?Categoria=Tecniche%20Scout" aria-label="Vai alla pagina con articoli tecniche scout">Tecniche Scout</a></li>
                        </ul>
                    </div>
                </li>
            </ul>
        </nav>
    </header>
    <main>
        
    </main>
    <footer class="container-fluid d-flex flex-wrap justify-content-between align-items-center fixed-bottom">
        <a href="./help.php" class="text-decoration-none" aria-label="Vai alla pagina di supporto/aiuto ">Aiuto</a>
        <div class="d-flex flex-wrap flex-column justify-content-end">
            <a href="mailto:orazio.spina@studio.unibo.it" class="text-decoration-none" aria-label="Invia una mail a Orazio Spina">orazio.spina@studio.unibo.it</a>
            <a href="mailto:marco.paggetti@studio.unibo.it" class="text-decoration-none" aria-label="Invia una mail a Marco Paggetti">marco.paggetti@studio.unibo.it</a>
        </div>
    </footer>
    
    <!-- Modals -->
    <!-- Delete article modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="deleteModalLabel">
        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-1" id="deleteModalLabel">Elimina articolo</h1>
                </div>
                <div class="modal-body fs-3">
                    <p>Vuoi eliminare l'articolo dal carrello?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary fs-3" data-bs-dismiss="modal">No</button>
                    <button type="button" class="btn btn-danger fs-3">Si</button>
                </div>
            </div>
        </div>
    </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/base.js"></script>

    <?php
    if(isset($templateParams["js"])):
        foreach($templateParams["js"] as $script):
    ?>
    <script src="<?php echo $script; ?>"></script>
    <?php
        endforeach;
    endif;
    ?>
    
</body>
</html>