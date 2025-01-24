<?php

    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    if (!isUserLoggedIn()) {
        header("Location: ../php/home.php");
        die();
    }
    
    $data = json_decode(file_get_contents('php://input'), true);
    
    $codice_prodotto = $data["codice_prodotto"];
    $codice_versione = $data["codice_versione"];
    $quantita = $data["quantita"];
    
    $response = ["status" => "error", "message" => "Errore sconosciuto"];
    
    $result = $dbh->updateProductQuantityInCart($_SESSION["email"], $codice_prodotto, $codice_versione, $quantita);
    
    if ($result === true) {
        http_response_code(200); // 200 OK
        $response = ["status" => "success", "message" => "Quantità aggiornata con successo"];
    } elseif ($result === false) {
        http_response_code(400); // 400 Bad Request
        $response = ["status" => "error", "message" => "Nessuna modifica effettuata"];
    } else {
        http_response_code(500); // 500 Internal Server Error
        $response = ["status" => "error", "message" => "Errore durante l'aggiornamento della quantità"];
    }
    
    header('Content-Type: application/json');
    echo json_encode($response);

?>