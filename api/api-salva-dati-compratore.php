<?php

require_once('../php/bootstrap.php');

header('Content-Type: application/json');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nome = isset($_POST['nome']) ? $_POST['nome'] : '';
    $cognome = isset($_POST['cognome']) ? $_POST['cognome'] : '';
    $indirizzo = isset($_POST['indirizzo']) ? $_POST['indirizzo'] : '';

    if ($dbh->updateAccount($nome, $cognome,$_SESSION["email"], $indirizzo)) {
        echo json_encode(['status' => 'success']);
    } else {
        echo json_encode(['status' => 'error', 'message' => 'Errore nell\'aggiornamento dei dati']);
    }
} else {
    echo json_encode(['status' => 'error', 'message' => 'Metodo non supportato']);
}

?>