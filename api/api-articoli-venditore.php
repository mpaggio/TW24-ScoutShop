<?php
    require_once("../php/bootstrap.php");
    
    $articles = $dbh->getProductVersions();
    
    // Immagine - disponibilita - Di_Codice_prodotto - Codice_prodotto - Nome_prodotto
    
    header("Content-type: application/json");
    echo json_encode($articles);
?>