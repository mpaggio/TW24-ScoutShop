<?php

require_once('../php/bootstrap.php');

$datiPersonali = $dbh->getUser("mpaggiojr@gmail.com");
$ordiniPersonali = $dbh->getUserOrders("mpaggiojr@gmail.com", true);

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
        'Nome' => $datiPersonali[0]["Nome"],
        'Cognome' => $datiPersonali[0]["Cognome"], 
        'E_mail' => $datiPersonali[0]["E_mail"],
        'Indirizzo' => $datiPersonali[0]["Indirizzo"],
        'Password' => $datiPersonali[0]["Password"]
    ],
    'ordini' => $structuredOrders
];

header("Content-type: application/json");
echo json_encode($response);

?>