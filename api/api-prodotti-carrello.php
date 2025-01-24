<?php

    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);

    if (!isUserLoggedIn()) {
        header("Location: ../php/home.php");
        die();
    }

    $response = ["status" => "error", "message" => "Errore sconosciuto"];
    
    $result = $dbh->getUserProductsInCart($_SESSION["email"]);
    if ($result) {
        
        for($i = 0; $i < count($result); $i++) {
            $result[$i]["Nome_immagine"] = UPLOAD_DIR.$result[$i]["Nome_immagine"];
        }
        
        $response = ["status" => "success", "message" => "Articoli recuperati con successo", "data" => $result];
    } else {
        $response = ["status" => "error", "message" => "Errore nel recupero dei prodotti"];
    }
    
    header("Content-type: application/json");
    echo json_encode($response);
?>