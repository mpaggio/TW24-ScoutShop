<?php
    require_once("../php/bootstrap.php");
    
    function parseVersionCode($versionCode) {
        $parts = explode("_", $versionCode);
        
        $colore = $parts[1] == "0" ? "" : "colore ".$parts[1];
        $taglia = $parts[2] == "0" ? "" : "taglia ".$parts[2];
        
        return trim($colore." ".$taglia);
    }
    
    // Da usare _SESSION["email"] per prendere l'email dell'utente loggato
    $ordini = $dbh->getUserOrders("orazio.spina@studio.unibo.it", 0);
    
    $structuredOrders = [];
    
    foreach($ordini as $ordine) {
        $codiceOrdine = $ordine["Codice_ordine"];
        if (!isset($structuredOrders[$codiceOrdine])) {
            $structuredOrders[$codiceOrdine] =[
                "Codice_ordine" => $codiceOrdine,
                "Data_ordine" => $ordine["Data_ordine"],
                "Email_compratore" => $ordine["E_mail_compratore"],
                "Dettagli" => []
            ];
        }
        
        $structuredOrders[$codiceOrdine]["Dettagli"][] = [
            "Nome" => $ordine["Nome_prodotto"]." ".parseVersionCode($ordine["Codice_prodotto"]),
            "Quantita" => $ordine["Quantita_"]
        ];
    }
    
    header("Content-type: application/json");
    echo json_encode($structuredOrders);
?>