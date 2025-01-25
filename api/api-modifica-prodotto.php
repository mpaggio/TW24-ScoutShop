<?php
    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";
    
    if (!isUserLoggedIn() || !$_SESSION["venditore"]) {
        header("location: ../index.php");
        die();
    }
    
    $response = array("status" => "error", "message" => "Errore sconosciuto");
    
    $codice_prodotto = $_POST["codiceProdotto"];
    $codice_versione = $_POST["codiceVersione"];
    $prezzo = $_POST["productPrice"];
    $disponibilita = $_POST["productQuantity"];
    $descrizione = $_POST["productDescription"];
    $sconto = $_POST["productDiscount"];
    
    $result = $dbh->updateProductVersion($codice_prodotto, $codice_versione, $descrizione, $prezzo, $disponibilita, $sconto);
    if ($result) {
        $response = array("status" => "success", "message" => "Prodotto modificato con successo");
    } else {
        $response = array("status" => "error", "message" => "Errore durante la modifica del prodotto");
        http_response_code(400);
    }
    
    header("Content-type: application/json");
    echo json_encode($response);
?>