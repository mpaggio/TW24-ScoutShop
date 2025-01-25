<?php
    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";
    
    if (!isUserLoggedIn() || !$_SESSION["venditore"]) {
        header("location: ../home.php");
        die();
    }
    
    $response = array("status" => "error", "message" => "Errore sconosciuto");
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    $codice_prodotto = $data["codiceProdotto"];
    $codice_versione = $data["codiceVersione"];
    
    $result = $dbh->removeProduct($codice_prodotto, $codice_versione);
    if ($result) {
        $response = array("status" => "success", "message" => "Prodotto eliminato con successo");
    } else {
        $response = array("status" => "error", "message" => "Errore durante l'eliminazione del prodotto");
    }
    
    header("Content-type: application/json");
    echo json_encode($response);
?>