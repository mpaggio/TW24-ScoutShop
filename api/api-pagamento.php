<?php
    
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    if (!isUserLoggedIn()) {
        header("Location: ../login.php");
        die();
    }
    
    $articles = $dbh->getUserProductsInCart($_SESSION["email"]);
    
    foreach ($articles as $article) {
        $dbh->decreaseProductAvailability($article["Di_Codice_prodotto"], $article["Codice_prodotto"], $article["Quantita_"]);
    }
    
    $today = date("Y-m-d");

    $data = json_decode(file_get_contents('php://input'), true);
    
    $result = $dbh->newOrder($today, $_SESSION["email"], "orazio.spina@studio.unibo.it", $data["tipoSpedizione"], $data["dettagliOrdine"]);
    
    $response = [];
    
    if ($result) {
        $response["status"] = "success";
        $response["message"] = "Ordine effettuato con successo!";
    } else {
        $response["status"] = "error";
        $response["message"] = "Errore durante l'ordine!";
    }
    
    $dbh->emptyCart($_SESSION["email"]);
    
    header("Content-Type: application/json");
    echo json_encode($response);
?>