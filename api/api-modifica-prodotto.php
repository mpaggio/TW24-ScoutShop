<?php
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    // if (!isUserLoggedIn() || !isset($_SESSION["venditore"])) {
    //     header("location: ../index.php");
    //     die();
    // }
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
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