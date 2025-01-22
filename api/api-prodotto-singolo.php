<?php

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

require_once('../php/bootstrap.php');

if (isset($_GET["Nome_prodotto"])) {
    
    $nomeProdotto = $_GET["Nome_prodotto"];
    $versioniProdotto = $dbh->getSingleProduct($nomeProdotto);

    $structuredProducts = [];

    foreach($versioniProdotto as $versione) {
        $coloreVersione = $versione["Colore"];
        if(!isset($structuredProducts[$coloreVersione])){
            $structuredProducts[$coloreVersione] = [[
                "Nome_categoria" => $versione["Nome_categoria"],
                "Nome_prodotto" => $versione["Nome_prodotto"],
                "Di_Codice_prodotto" => $versione["Di_Codice_prodotto"],
                "Codice_prodotto" => $versione["Codice_prodotto"],
                "Marchio" => $versione["Marchio"],
                "Descrizione" => $versione["Descrizione"],
                "Colore" => $versione["Colore"],
                "Taglia" => $versione["Taglia"],
                "Prezzo" => $versione["Prezzo"],
                "Disponibilita" => $versione["Disponibilita"],
                "Sconto" => $versione["Sconto"],
                "Nome_immagine" => UPLOAD_DIR.$versione["Nome_immagine"]
            ]];
        } else {
            array_push($structuredProducts[$coloreVersione], [
                "Nome_categoria" => $versione["Nome_categoria"],
                "Nome_prodotto" => $versione["Nome_prodotto"],
                "Di_Codice_prodotto" => $versione["Di_Codice_prodotto"],
                "Codice_prodotto" => $versione["Codice_prodotto"],
                "Marchio" => $versione["Marchio"],
                "Descrizione" => $versione["Descrizione"],
                "Colore" => $versione["Colore"],
                "Taglia" => $versione["Taglia"],
                "Prezzo" => $versione["Prezzo"],
                "Disponibilita" => $versione["Disponibilita"],
                "Sconto" => $versione["Sconto"],
                "Nome_immagine" => UPLOAD_DIR.$versione["Nome_immagine"]
            ]);
        }
    }
    
    header('Content-Type: application/json');
    echo json_encode($structuredProducts);
} else {
    header('Content-Type: application/json');
    echo json_encode(["error" => "Non è stato trovato nessun nome prodotto"]);
}

?>