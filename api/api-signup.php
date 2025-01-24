<?php
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    // if (isUserLoggedIn()) {
    //     header("location: ../php/home.php");
    //     die();
    // }
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $nome = trim($_POST["signupName"]);
    $cognome = trim($_POST["signupSurname"]);
    $email = trim($_POST["signupEmail"]);
    $password = trim($_POST["signupPassword"]);
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);
    
    $result = $dbh->createAccount($email, $hashedPassword, $nome, $cognome);
    if ($result) {
        $response = array("status" => "success", "message" => "Account creato con successo!");
    } else {
        $response = array("status" => "error", "message" => "Errore nella creazione dell'account!");
        http_response_code(400);
    }
    
    header("Content-type: application/json");
    echo json_encode($response);
?>