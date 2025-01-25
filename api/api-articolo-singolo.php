<?php
    require_once __DIR__ . "/../php/bootstrap.php";
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    $response = $dbh->getProductFromCode($data["codiceProdotto"], $data["codiceVersione"]);
    
    header("Content-type: application/json");
    echo json_encode($response);
?>