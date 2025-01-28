<?php 
    require_once("./php/bootstrap.php");
    require_once("./utils/functions.php");
    
    if (!isUserLoggedIn()) {
        header("Location: ./login.php");
        exit();
    }
    
    $spedizione = $_GET["spedizione"];
    $costo_spedizione = $dbh->getShippingPrice($spedizione);

?>

<!DOCTYPE html>
<html lang="it">
<head>
    <title>Scout Shop - Pagamento</title>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" type="text/css" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />
    <link rel="stylesheet" type="text/css" href="./css/style.css" />
</head>
<body class="d-flex flex-column min-vh-100 justify-content-center align-items-center">
    <main class="w-100">
        <section>
            <h2 class="fs-1">Pagamento</h2>
            <div class="row justify-content-between">
                <div class="col-md-6 mb-3">
                    <form class="row g-3" id="form">
                        <h3 class="fs-2">Dati di spedizione</h3>
                        <div class="col-md-6">
                            <label for="name" class="form-label fs-3">Nome</label>
                            <input type="text" class="form-control fs-5" id="name" placeholder="Mario" required />
                        </div>
                        <div class="col-md-6">
                            <label for="surname" class="form-label fs-3">Cognome</label>
                            <input type="text" class="form-control fs-5" id="surname" placeholder="Rossi" required />
                        </div>
                        <div class="col-md-12">
                            <label for="address" class="form-label fs-3">Indirizzo</label>
                            <input type="text" class="form-control fs-5" id="address" value="Via dell'università 50, Cesena" required disabled />
                        </div>
                        <h3 class="fs-2">Dati di pagamento</h3>
                        <div class="col-md-12">
                            <label for="cardNumber" class="form-label fs-3">Numero Carta</label>
                            <input type="text" class="form-control fs-5" id="cardNumber" placeholder="xxxx-xxxx-xxxx-xxxx" required />
                        </div>
                        <div class="col-md-7">
                            <label for="expireDate" class="form-label fs-3">Data di scadenza</label>
                            <input type="month" class="form-control fs-5" placeholder="01/27" id="expireDate" required />
                        </div>
                        <div class="col-md-5">
                            <label for="cvv" class="form-label fs-3">CVV</label>
                            <input type="text" class="form-control fs-5" placeholder="123" id="cvv" required />
                        </div>
                        <div class="col-md-12">
                            <label for="ownerName" class="form-label fs-3">Nome proprietario</label>
                            <input type="text" class="form-control fs-5" id="ownerName" placeholder="Nome Cognome" required />
                        </div>
                    </form>
                </div>
                <div class="col-md-5 h-100 p-3 m-0">
                    <h3 class="fs-2 fw-bold">Riepilogo dell'ordine</h3>
                    <div class="d-flex w-100 justify-content-between align-items-center mb-3">
                        <ul class="list-group w-100">
                            
                        </ul>
                    </div>
                    <div class="d-flex w-100 justify-content-between align-items-center border-bottom border-dark mb-3">
                        <p class="fs-5">Spedizione:</p>
                        <p class="fs-5"><?php echo $costo_spedizione ?>€</p>
                    </div>
                    <div class="d-flex w-100 justify-content-between align-items-center">
                        <p class="fs-5">Totale:</p>
                        <p class="fs-5"></p>
                    </div>
                    <a class="btn btn-primary fs-3 w-100" href="#">Paga</a>
                    <div class="col-md-12 text-center fs-4 mt-2"></div>
                </div>
            </div>
        </section>
    </main>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <script src="./js/pagamento.js"></script>
</body>
</html>