<?php

    require_once __DIR__ . "/../php/bootstrap.php";
    require_once __DIR__ . "/../utils/functions.php";

    if (isset($_POST["Di_Codice_prodotto"]) && isset($_POST["Codice_prodotto"]) && isset($_POST["Quantita"])) {
        $codiceProdotto = $_POST["Di_Codice_prodotto"];
        $codiceVersione = $_POST["Codice_prodotto"];
        $quantita = $_POST["Quantita"];

        if (is_numeric($quantita) && $quantita > 0) {
            $result = $dbh->insertProductInCart($_SESSION["email"], $codiceProdotto, $codiceVersione, $quantita);
            if ($result) {
                header('Content-Type: application/json');
                echo json_encode(["success" => "Prodotto aggiunto al carrello"]);
                exit();
            } else {
                header('Content-Type: application/json');
                echo json_encode(["error" => "Errore nell'inserimento del prodotto nel carrello"]);
                exit();
            }
        } else {
            header('Content-Type: application/json');
            echo json_encode(["error" => "Quantità non valida"]);
            exit();
        }
    }

    if (isset($_GET["Nome_prodotto"])) {
        
        $nomeProdotto = $_GET["Nome_prodotto"];
        $codiceProdotto = $_GET["Di_Codice_prodotto"];
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