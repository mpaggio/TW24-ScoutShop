<?php

    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";

    if (!isUserLoggedIn()) {
        header("Location: ../home.php");
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