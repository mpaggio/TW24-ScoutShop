<?php
    require_once("../php/bootstrap.php");
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $data = json_decode(file_get_contents("php://input"), true);
    
    $response = $dbh->getProductFromCode($data["codiceProdotto"], $data["codiceVersione"]);
    
    header("Content-type: application/json");
    echo json_encode($response);
?>