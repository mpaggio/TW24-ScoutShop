<?php

    require_once __DIR__ . "/../php/bootstrap.php";

    $datiPersonali = $dbh->getUser($_SESSION["email"], $_SESSION["venditore"]);
    $ordiniPersonali = $dbh->getUserOrders($_SESSION["email"], !$_SESSION["venditore"]);

    $structuredOrders = [];
        
    foreach($ordiniPersonali as $ordine) {
        $codiceOrdine = $ordine["Codice_ordine"];
        if (!isset($structuredOrders[$codiceOrdine])) {
            $structuredOrders[$codiceOrdine] =[
                "Codice_ordine" => $codiceOrdine,
                "Data_ordine" => $ordine["Data_ordine"],
                "Email_compratore" => $ordine["E_mail_compratore"],
                "Tipo_spedizione" => $ordine["Tipo_spedizione"],
                "Dettagli" => []
            ];
        }

        $structuredOrders[$codiceOrdine]["Dettagli"][] = [
            "Nome_prodotto" => $dbh->getProductNameFromCode($ordine["Di_Codice_prodotto"]), 
            "Di_Codice_prodotto" => $ordine["Di_Codice_prodotto"],
            "Codice_prodotto" => $ordine["Codice_prodotto"], 
            "Quantita" => $ordine["Quantita_"],
            "Prezzo_d_acquisto" => $ordine["Prezzo_d_acquisto"],
            "Nome_immagine" => UPLOAD_DIR.$dbh->getProductVersioneImage($ordine["Di_Codice_prodotto"],$ordine["Codice_prodotto"])
        ];
    }

    $response = [
        'datiPersonali' => [
            'Nome' => $datiPersonali["Nome"],
            'Cognome' => $datiPersonali["Cognome"], 
            'E_mail' => $datiPersonali["E_mail"],
            'Indirizzo' => $datiPersonali["Indirizzo"],
            'Password' => $datiPersonali["Password"]
        ],
        'ordini' => $structuredOrders
    ];

    header("Content-type: application/json");
    echo json_encode($response);

?>