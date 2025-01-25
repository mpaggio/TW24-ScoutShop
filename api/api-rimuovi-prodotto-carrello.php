<?php

    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";
    
    if (!isUserLoggedIn()) {
        header("Location: ../home.php");
        die();
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $codice_prodotto = $data["codice_prodotto"];
    $codice_versione = $data["codice_versione"];
    
    $response = ["status" => "error", "message" => "Errore sconosciuto"];
    
    $result = $dbh->removeProductFromCart($_SESSION["email"], $codice_prodotto, $codice_versione);
    
    if ($result === true) {
        http_response_code(200); // Rimozione completata
        $response = array("status" => "success", "message" => "Prodotto rimosso dal carrello.");
    } elseif ($result === false) {
        http_response_code(404); // Nessuna riga trovata
        $response = array("status" => "error", "message" => "Il prodotto non è presente nel carrello.");
    } else {
        http_response_code(500); // Errore interno
        $response = array("status" => "error", "message" => "Errore durante la rimozione del prodotto.");
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);
    
?>