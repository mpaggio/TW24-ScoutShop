<?php
    require_once("../php/bootstrap.php");
    require_once("../utils/functions.php");
    
    if (isUserLoggedIn()) {
        header("location: ../php/home.php");
        die();
    }
    
    ini_set('display_errors', 1);
    ini_set('display_startup_errors', 1);
    error_reporting(E_ALL);
    
    $email = trim($_POST["loginEmail"]);
    $password = trim($_POST["loginPassword"]);
    if (isset($_POST["sellerCheck"])) {
        $seller = true;
    } else {
        $seller = false;
    }
    
    $result = $dbh->getUser($email, $seller);
    if ($result) {
        if (password_verify($password, $result["Password"])) {
            $_SESSION["email"] = $email;
            $_SESSION["venditore"] = $seller;
            $response = array("status" => "success", "message" => "Login effettuato con successo!");
            http_response_code(200);
        } else {
            $response = array("status" => "error", "message" => "Credenziali non valide!");
            http_response_code(401);
        }
    } else {
        $response = array("status" => "error", "message" => "Credenziali non valide!");
        http_response_code(401);
    }
    
    header("Content-type: application/json");
    echo json_encode($response);
?>